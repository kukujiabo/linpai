<?php

use App\Models\OrderBoun;
use App\User;

class OrderBounsTableSeeder extends Seeder {

  public function run ()
  {

    DB::table('bouns')->delete();

    $users = User::all();

    foreach ($users as $user) {
    
      Boun::create([

        'note' => 20,

        'code' => bcrypt(time() + $uid);

        'type' => 1,
      
        'uid' => $user->id,

        'active' => 1
      
      ]);
    
    }
  
  }

} 
