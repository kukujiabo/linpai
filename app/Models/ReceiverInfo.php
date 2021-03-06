<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReceiverInfo extends Model {

	//
  protected $fillable = [
    'receiver', 
    'province', 
    'city', 
    'district', 
    'address',
    'post_code',
    'mobile', 
    'phone', 
    'uid',
    'oid',
    'last_used'
  ];

}
