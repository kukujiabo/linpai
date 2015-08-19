<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderInfo extends Model {

	//
  protected $fillable = [
  
    'oid', 'rid', 'cid', 'discount', 'active', 'ext_0', 'ext_1'
  
  ];

}
