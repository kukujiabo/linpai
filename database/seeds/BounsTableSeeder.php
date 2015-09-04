<?php

use Illuminate\Database\Seeder;
use App\Models\Boun;
use App\User;


class BounsTableSeeder extends Seeder {

  public function run () {
  
    DB::table('bouns')->delete();

    $users = User::all();

    for ($i = 1; $i < 20; $i++) {

      foreach ($users as $user) {
      
        Boun::create([
        
          'note' => (20 + $i % 2 * 10),

          'type' => 1 % $i,
          
          'uid' => $user->id,

          'oid' => 1,

          'code' => $this->seed(8),

          'active' => 1
        
        ]);
      
      }

    }
  
  }

  private function seed($length)
  {

    $pattern = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    $output = '';

    for ($a = 0; $a < $length; $a++ ) {
    
      $output .= $pattern{rand(0, 61)};
    
    }
  
    return $output;

  }

}
