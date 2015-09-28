<?php

use illuminate\database\seeder;
use App\models\MassInfo;

class MassInfoTableSeeder extends Seeder {

  public function run () 
  {

    DB::table('mass_infos')->delete();

    MassInfo::create([
    
      'title' => '公司联系电话',

      'content' => '4000602620',

      'code' => 'company_phone_number'
    
    ]);


  }

}
