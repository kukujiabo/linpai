<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Boun extends Model {

  protected $fillable = [ 'note', 'type', 'uid', 'oid', 'code', 'active' ]; 
	//
  //
  public static function generateOrderCode ($length = 8) {
  
    $pattern = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $output = '';

    for ($a = 0; $a < $length; $a++ ) {
    
      $output .= $pattern{rand(0, 61)};
    
    }
  
    return $output;
  
  }

}
