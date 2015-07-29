<?php

use Illuminate\Database\Seeder;
use App\Models\City;

class CitiesTableSeeder extends Seeder {

  public function run ()
  {
  
    DB::table('cities')->delete();

    City::create([
    
      'cname' => '上海',

      'ename' => 'ShangHai',

      'code' => 1,

      'country_id' => 1,

      'province_id' => 1,

      'post_code' => 200001,

      'active' => 1
    
    ]);
  
  }

}
