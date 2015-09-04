<?php namespace App\Events;

use App\Events\Event;
use App\Models\Boun;
use Illuminate\Queue\SerializesModels;

class TriggerBounGenerator extends Event {

	use SerializesModels;

  protected $user;

  protected $type;

	/**
	 * Create a new event instance.
	 *
	 * @return void
	 */
	public function __construct($user, $type)
	{
		//
    $this->user = $user;

    $this->type = $type;

	}

  /*
   * 添加推荐码
   */
  private function generateRecommend()
  {
    $boun = Boun::where('uid', '=', $this->user->id);

    if (empty($boun->id)) {

      return Boun::create([
      
        'note' => 30,
      
        'type' => 0,
      
        'uid' => $this->user->id,

        'code' => $this->generateCode(),

        'active' => 1

      ]);

    } else {
    
      return $boun; 
    
    }
  
  }

  /*
   * 添加优惠券
   */
  private function generateDiscount()
  {
    return Boun::create([
    
      'note' => 30,

      'type' => 1,

      'uid' => $this->user->id,

      'code' => $this->generateCode(),

      'active' => 1
    
    ]);
  
  }


  private function generateCode ($length = 8)
  {
  
    $pattern = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $output = '';

    for ($a = 0; $a < $length; $a++ ) {
    
      $output .= $pattern{rand(0, 61)};
    
    }
  
    return $output;
  
  }

  public function generate ()
  {
    switch ($this->type)
    {
      case 'recommend':

        return $this->generateRecommend();

        break;

      case 'discount':

        break;
  
    }

  }

}
