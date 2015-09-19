<?php

use Illuminate\Database\Seeder;
use App\Models\Advertise;

class AdsTab;eSeeder extends Seeder {

  public function run ()
  {
    DB::table('advertises')->delete();

    Advertise::create([
    
      'code' => 'banner_1',

      'type' => 'index_banner',

      'url' => '',

      'seq' => 1,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_2',

      'type' => 'index_banner',

      'url' => '',

      'seq' => 2,

      'active' => 1
    
    ]);

    Advertise::create([
    
      'code' => 'banner_3',

      'type' => 'index_banner',

      'url' => '',

      'seq' => 3,

      'active' => 1
    
    ]);
  }

}
