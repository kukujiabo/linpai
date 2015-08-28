<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model {

	//
  protected $fillable = [
  
    'code', 'rid', 'uid', 'cid', 'gid', 'sum', 'num', 'comment', 'status', 'active'
  
  ];

}
