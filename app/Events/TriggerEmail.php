<?php namespace App\Events;

use App\Events\Event;
use App\Models\Email;

use Illuminate\Queue\SerializesModels;

class TriggerEmail extends Event {

	use SerializesModels;

  protected $url = "http://api.submail.cn/mail/xsend.json";

  protected $appid = "10657";

  protected $signature = "7399a424e640ebe28630dd8c6746c4b3";

  protected $pro_register = "5g59Q";

  protected $pro_friend_use = "bAn8G2";

  protected $pro_payed = "ZHVDq2";

  protected $info;

  protected $to = "";

  protected $mail_type = "register";

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($to, $mailType, $info = null)
	{
		//
    $this->to = $to;

    $this->mailType = $mailType;

    $this->mobile = $info;

	}

  private function registerMail ()
  {

    $post_data = [
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_register,

      'vars' => "{ \"mobile\": \"{$this->info['mobile']}\"}"

    ];

    return $this->send('post', $post_data);
  
  }

  private function friendUser ()
  {
  
    $post_data = [

      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_friend_use

    ];

    return $this->send('post', $post_data);
  
  }

  private function payedMail ()
  {
    $post_data = [
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_payed,

      'vars' => "{ \"boun\": \"{$this->info['boun']}\", \"order_code\": \"{$this->info['order_code']}\" }"

    ];
  
  
  }

  public function execSend()
  {
    
    switch ($this->mailType) {

      case 'register' :

        return $this->registerMail();

      case 'friend_use' :

        return $this->friendUser();

      case 'payed' :

        return $this->payedMail();

    }
  
  }

  private function send ($method = 'post', $data = null) 
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

    $opts = ['to' => $this->to, 'mail_type' => $this->mail_type, 'deliver_at' => date('Y-m-d H:i:s') ];

    foreach ($res as $key => $val) {
    
      $opts[$key] = $val;
    
    }

    Email::create($opts);

    return $res;

  }

}