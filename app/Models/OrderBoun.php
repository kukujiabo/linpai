<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderBoun extends Model {

	//
  protected $fillable = [
  
    'oid', 'uid', 'rewarded', 'bcode', 'btype', 'success', 'owner_id'
  
  ];

}
