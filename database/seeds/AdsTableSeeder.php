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

      'url' => '/imgs/carousel/51BANNER-01.jpg',

      'seq' => 1,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_2',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/51BANNER-02.jpg',

      'seq' => 2,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_3',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/51BANNER-03.jpg',

      'seq' => 3,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_4',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/51BANNER-04.jpg',

      'seq' => 3,

      'active' => 1
    
    ]);

  }

}
