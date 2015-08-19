<?php

use App\Models\CarAttribs;
use App\Models\Car;
use App\Models\Attributes;
use Illuminate\Database\Seeder;

class CarAttribsTableSeeder extends Seeder {

  public function run () 
  {
  
    DB::table('car_attribs')->delete();

    $car = Car::all(); 


  
  }

}
