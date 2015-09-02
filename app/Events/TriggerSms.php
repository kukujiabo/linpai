<?php namespace App\Events;

use App\Events\Event;
use Illuminate\Queue\SerializesModels;
use App\Models\RegisterVerify;
use App\Models\Message;

class TriggerSms extends Event {

	use SerializesModels;

  protected $url = "https://api.submail.cn/message/xsend.json";

  protected $appid = "10444";

  protected $signature = "06ae547fab9dc520900b4b32a11486e7";

  protected $pro_register = "N3ZKu1";

  protected $mobile = "";

  protected $type = "";

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($mobile, $type)
	{
    $this->type = $type;

    $this->mobile = $mobile;
	}

  private function registerSms ($mobile) 
  {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $this->url);

    curl_setopt($ch, CURLOPT_POST, 1);

    $vcode = rand(100000, 999999);

    $post_data = array(
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'project' => $this->pro_register,

      'vars' => "{ \"verify_code\": \"{$vcode}\"}",

      'to' => $mobile
    
    );

    /*
     *
     */
    $verify = RegisterVerify::where('mobile', '=', $mobile)

      ->where('active', '=', 1)

      ->first();

    if (!empty($verify->active)) {

      $verify->active = 0;
    
      $verify->save();
    
    }

    /*
     * 纪录验证码
     */
    RegisterVerify::create([
    
      'mobile' => $mobile,

      'verify_code' => $vcode,

      'success' => 0,

      'deliver_at' => date('Y-m-d H:i:s'),

      'active' => 1
    
    ]);

    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);

    curl_setopt($ch, CURLOPT_HEADER, false);

    $file_contents = curl_exec($ch);

    curl_close($ch);

    $result = json_decode($file_contents);

    $opts = [ 'mobile' => $mobile, 'deliver_at' => date('Y-m-d H:i:s') ];

    foreach ($result as $key => $val) {

      $opts[$key] = $val;

    }

    Message::create($opts);

    return $file_contents;
  
  }

  public function execSend() 
  {
    switch ($this->type) {
    
      case 'register':

        return $this->registerSms($this->mobile);

        break;
      
      default:

        break;
    
    }
  
  }

}
