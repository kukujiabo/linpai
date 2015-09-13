<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder {

  public function run () 
  {

    DB::table('admins')->delete();

    Admin::create([
    
      'admin_name' => 'adm001',

      'password' => md5('buypaizhao@51'),

      'rank' =>  0,

      'active' => 1
    
    ]);
    
  }

}
