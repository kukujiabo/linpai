<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPrice extends Model {

	//
  protected $fillable = [
  
    'oid' ,'orig_price' ,'cut_fee' ,'extra_fee', 'final_price', 'active'
  
  ];

}
