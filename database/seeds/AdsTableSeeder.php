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

      'url' => '/imgs/carousel/banner_1.jpg',

      'seq' => 1,

      'active' => 1,

      'link' => '/text/bouninfo'
    
    ]);

    Advertise::create([
    
      'code' => 'banner_2',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/banner_2.jpg',

      'seq' => 2,

      'active' => 1,

      'link' => '/home#buy'
    
    ]);

    Advertise::create([
    
      'code' => 'banner_3',

      'type' => 'index_banner',

      'url' => '/imgs/carousel/banner_3.jpg',

      'seq' => 3,

      'active' => 1,

      'link' => '/home#buy'
    
    ]);

  }

}
