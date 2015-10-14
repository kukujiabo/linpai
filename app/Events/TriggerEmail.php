<?php namespace App\Events;

use App\Events\Event;
use App\Models\Email;
use Auth;

use Illuminate\Queue\SerializesModels;

class TriggerEmail extends Event {

	use SerializesModels;

  protected $url = "http://api.submail.cn/mail/xsend.json";

  protected $appid = "10657";

  protected $signature = "7399a424e640ebe28630dd8c6746c4b3";

  protected $pro_register = "Sk2FJ2";

  protected $pro_friend_use = "dDHmO";

  protected $pro_payed = "ynVEV1";

  protected $pro_deliver = "CBh3B2";

  protected $pro_invite = "5BVmK4";

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
    $this->to = $to;

    $this->mail_type = $mailType;

    $this->info = $info;
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

  private function friendUse ()
  {
    $user = User::all();

    $vars = [ 'friend' => $this->info['friend'], 'user' => $user->name ];
  
    $post_data = [

      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_friend_use,

      'vars' => json_encode($vars)

    ];

    return $this->send('post', $post_data);
  
  }

  private function payedMail ()
  {
    $user = Auth::user();

    $post_data = [
    
      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_payed,

      'vars' => "{ \"recommend\": \"{$this->info['recommend']}\", \"order_code\": \"{$this->info['order_code']}\", \"order_date\": \"{$this->info['order_date']}\", \"user\": \"{$user->name}\" }"

    ];

    return $this->send('post', $post_data);

  }

  private function deliverMail ()
  {
    $post_data = [

      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_deliver,

      'vars' => json_encode($this->info)

    ];
    
    $this->send('post', $post_data);

  }

  private function inviteMail ()
  {

    $post_data = [

      'appid' => $this->appid,

      'signature' => $this->signature,

      'to' => $this->to,

      'project' => $this->pro_invite,

      'vars' => "{\"friend\": \"{$this->info['friend']}\", \"recommend\": \"{$this->info['recommend']}\"}"
    
    ];

    return $this->send('post', $post_data);
  
  }

  public function execSend()
  {
    
    switch ($this->mail_type) {

      case 'register' :

        return $this->registerMail();

      case 'friend_use' :

        return $this->friendUse();

      case 'payed' :

        return $this->payedMail();

      case 'deliver' :

        return $this->deliverMail();

      case 'invite':

        return $this->inviteMail();

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
