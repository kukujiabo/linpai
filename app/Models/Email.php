<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Email extends Model {

	//
  protected $fillable = ['title', 'code', 'to', 'from', 'cc', 'subject', 'mail_type', 'status', 'deliver_at'];

}
