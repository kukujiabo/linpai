<?php

use Illuminate\Database\Seeder;
use App\Models\Advertise;

class AdsTableSeeder extends Seeder {

  public function run ()
  {
    DB::table('advertises')->delete();

    Advertise::create([
    
      'code' => 'banner_1',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/race1.png',

      'seq' => 1,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_2',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/race2.png',

      'seq' => 2,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_3',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/race3.png',

      'seq' => 3,

      'active' => 1
    
    ]);
  }

}
