<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ImageCata extends Model {

  protected $fillable = ['type', 'name', 'store_path', 'comment', 'active', 'ext_1'];

}
