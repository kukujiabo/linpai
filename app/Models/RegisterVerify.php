<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterVerify extends Model {

	//
  protected $fillable = ['mobile', 'deliver_at', 'verify_code', 'success', 'active'];

}
