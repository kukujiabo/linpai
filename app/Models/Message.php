<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {

	//
  protected $fillable = [
    'mobile', 
    'uid', 
    'content', 
    'success', 
    'status', 
    'send_id', 
    'type',
    'sms_credit',
    'error_code', 
    'deliver_at'
  ];

}
