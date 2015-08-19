<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model {

	//
  protected $fillable = [
    'uid',
    'owner',
    'brand',
    'factory_code',
    'reco_code',
    'dir_identity_face',
    'dir_identity_back',
    'dir_trans_ensurance',
    'dir_car_check',
    'dir_validate_paper'
  ];

}
