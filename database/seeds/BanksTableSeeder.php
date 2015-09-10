<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankTableSeeder extends Seeder {

  public function run () 
  {
  
    DB::table('banks')->delete();
  
    Bank::create([

      'name' => '中国工商银行',

      'code' => 'ICBCBTC',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '中国农业银行',

      'code' => 'ABC',

      'active' => 1
    
    ]);
  
    Bank::create([

      'name' => '中国建设银行',

      'code' => 'CCB',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '上海浦东发展银行',

      'code' => 'SPDB',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '中国银行',

      'code' => 'BOCB2C',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '招商银行',

      'code' => 'CMB',

      'active' => 1
    
    ]);
  
    Bank::create([

      'name' => '兴业银行',

      'code' => 'CIB',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '广发银行',

      'code' => 'GDB',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '上海银行',

      'code' => 'SHBANK',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '平安银行',

      'code' => 'SPABANK',

      'active' => 1
    
    ]);

    Bank::create([

      'name' => '中国邮政储蓄银行',

      'code' => 'POSTGC',

      'active' => 1
    
    ]);
    
  }

}
