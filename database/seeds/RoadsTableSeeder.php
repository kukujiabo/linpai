<?php 

use Illuminate\Database\Seeder;
use App\Models\Road;

class RoadsTableSeeder extends Seeder {

  public function run ()
  {

    DB::table('roads')->delete();
  
    Road::create([
    
      'cname' => '北京东路',

      'ename' => 'North Beijing Rd',

      'code' => 1,

      'post_code' => 200011,

      'city_id' => 1,

      'district_id' => 1,

      'active' => 1
    
    ]);
  
  }

}
