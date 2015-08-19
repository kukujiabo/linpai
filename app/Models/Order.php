<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	//
  protected $fillable = [
  
    'code', 'uid', 'gid', 'sum', 'num', 'comment', 'status', 'active'
  
  ];

}
