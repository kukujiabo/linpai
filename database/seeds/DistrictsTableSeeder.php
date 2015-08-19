<?php

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictsTableSeeder extends Seeder {

  public function run ()
  {
  
    DB::table('districts')->delete();

    District::create([
    
      'cname' => '黄浦区',

      'ename' => 'HuangPu District',
  
      'code' => 1,

      'city_id' => 1,

      'active' => 1
    
    ]);
  
    District::create([
    
      'cname' => '浦东新区',

      'ename' => 'HuangPu District',
  
      'code' => 2,

      'city_id' => 1,

      'active' => 1
    
    ]);
  
  
  }

}
