<?php

use Illuminate\Database\Seeder;
use App\Models\Country;

class CountriesTableSeeder extends Seeder {

  public function run ()
  {
  
    DB::table('countries')->delete();

    Country::create([

      'cname' => '中国',

      'ename' => 'China',

      'code' => 1,

      'active' => 1

    ]);
  
  
  }

}
