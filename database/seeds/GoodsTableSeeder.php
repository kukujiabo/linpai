<?php
    
use Illuminate\Database\Seeder;
use App\Models\Good;


class GoodsTableSeeder extends Seeder {

  public function run () 
  {

    DB::table('goods')->delete();

    Good::create([
    
      'name' => '上海临时行驶车号牌',

      'code' => 'below-three',

      'intro' => '每台车累计仅可办理3次上海临时牌照',

      'pic' => 'imgs/goods/fraly.jpg',

      'active' => 1
    
    
    ]);

    Good::create([
    
      'name' => '外省临时行驶车号牌',

      'code' => 'beyond-three',

      'intro' => '省市随机；上海临牌累计已满3次者购买外省临牌',

      'pic' => 'imgs/goods/bujiadi.jpg',

      'active' => 1
    
    ]);



  }


}

