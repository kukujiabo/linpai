<?php

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvincesTableSeeder extends Seeder {

  public function run ()
  {
  
    DB::table('provinces')->delete();

    Province::create([

      'cname' => '上海',

      'ename' => 'ShangHai',

      'code' => 1,

      'country_code' => 1,

      'active' => 1

    ]);
  
  }

}
