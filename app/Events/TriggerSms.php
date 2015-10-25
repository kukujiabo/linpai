<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\RegisterVerify;
use App\Models\Message;
use App\Models\ResetPassword;

class TriggerSms extends Event {

	use SerializesModels;

  protected $url = "http://api.submail.cn/message/xsend.json";

  protected $appid = "10444";

  protected $signature = "06ae547fab9dc520900b4b32a11486e7";

  protected $pro_register = "N3ZKu1";

  protected $pro_friend_use = "f4dI42";

  protected $pro_payed = "bBX4r1";

  protected $pro_reset = "vcVfe4";

  protected $pro_deliver = "IhV8c4";

  protected $pro_invite = "ciMfc1";

  protected $pro_unpay = "oPXhK3";

  protected $info;

  protected $mobile = "";

  protected $sms_type = "register";

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($mobile, $sms_type, $info = null)
	{
    $this->sms_type = $sms_type;

    $this->mobile = $mobile;

    $this->info = $info;

	}

  private function resetSms () 
  {
    $token = ResetPassword::where('mobile', '=', $this->mobile)->where('active', '=', 1)->first();

    if (!empty($token->id)) {

      $token->active = 0;

      $token->save();

    }

    $newToken = rand(100000, 999999);

    $resetPasswd = new ResetPassword();

    $resetPasswd->mobile = $this->mobile;

    $resetPasswd->token = $newToken;

    $resetPasswd->deliver_at = date('Y-m-d H:i:s');

    $res = $resetPasswd->save();

    if ($res) {

      $post_data = array(
      
        'appid' => $this->appid,

        'signature' => $this->signature,

        'project' => $this->pro_reset,

        'vars' => "{ \"token\": \"{$resetPasswd->token}\"}",

        'to' => $this->mobile
      
      );

      return $this->send('post', $this->mobile, $post_data);

    }

    return null;

  }

  private function registerSms ($mobile) 
  {
    /*
     * 获取之前的验证条目
     */
    $verify = RegisterVerify::where('mobile', '=', $mobile)

      ->where('active', '=', 1)

      ->first();

    /*
     * 如果之前存在验证条目，则将其置为无效
     */
    if (!empty($verify->active)) {

      $verify->active = 0;
    
      $verify->save();
    
    }

    /*
     * 生成验证码
     */
    $vcode = rand(100000, 999999);

    $post_data = array(
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_register,

      'vars' => "{ \"verify_code\": \"{$vcode}\"}",

      'to' => $mobile
    
    );

    /*
     * 纪录验证码
     */
    $rv = RegisterVerify::create([
    
      'mobile' => $mobile,

      'verify_code' => $vcode,

      'success' => 0,

      'deliver_at' => date('Y-m-d H:i:s'),

      'active' => 1
    
    ]);

    /*
     * todo: 如果纪录失败
     */
    if (empty($rv)) {
    
    
    }

    /*
     * 短信发送
     */
    return $this->send('post', $mobile, $post_data);

  }

  private function inviteSms()
  {
    $post_data = array(
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_invite,

      'vars' => "{\"friend\": \"{$this->info['friend']}\", \"recommend\": \"{$this->info['recommend']}\"}",

      'to' => $this->mobile
    
    );

    $this->send('post', $this->mobile, $post_data);

  }

  private function friendUse() 
  {
    $post_data = array(
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_friend_use,

      'vars' => "{ \"fee\": \"30\"}",

      'to' => $this->mobile
    
    );

    return $this->send('post', $this->mobile, $post_data);

  }

  private function unpayNotify ()
  {

    $post_data = array (
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_deliver,

      'vars' => json_encode($this->info);

      'to' => $this->mobile
    
    );

    return $this->send('post', $this->mobile, $post_data);

  }

  private function deliverSms ()
  {
    $post_data = array (
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_deliver,

      'vars' => "{\"order_code\": \"{$this->info['order_code']}\", \"company\": \"{$this->info['company']}\", \"deliver_code\": \"{$this->info['deliver_code']}\", \"url\": \"{$this->info['url']}\"}",

      'to' => $this->mobile

    );

    $this->send('post', $this->mobile, $post_data);

  }


  private function payedSms () 
  {
    $vars = "{ \"order_code\": \"{$this->info['order_code']}\", \"recommend\": \"{$this->info['boun']}\", \"fee\": \"{$this->info['fee']}\"}";

    $post_data = [

      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_payed,

      'vars' => $vars,

      'to' => $this->mobile
    
    ];

    return $this->send('post', $this->mobile, $post_data);

  }

  public function execSend() 
  {
    switch ($this->sms_type) {
    
      case 'register':

        return $this->registerSms($this->mobile);

        break;

      case 'payed':

        return $this->payedSms();

      case 'friend_use':

        return $this->friendUse();

      case 'reset_passwd':

        return $this->resetSms();

      case 'deliver':

        return $this->deliverSms();

      case 'invite':

        return $this->inviteSms();
      
      default:

        break;
    
    }
  
  }

  private function send($method = 'post', $mobile, $data = null)
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $this->url);

    curl_setopt($ch, CURLOPT_POST, 1);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    curl_setopt($ch, CURLOPT_HEADER, false);

    $file_contents = curl_exec($ch);

    curl_close($ch);

    $res = json_decode($file_contents);

    $opts = ['mobile' => $this->mobile, 'sms_type' => $this->sms_type, 'deliver_at' => date('Y-m-d H:i:s') ];

    foreach ($res as $key => $val) {
    
      $opts[$key] = $val;
    
    }

    Message::create($opts);

    return $res;

  }

}
