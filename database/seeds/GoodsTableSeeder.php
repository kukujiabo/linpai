<?php
    
use Illuminate\Database\Seeder;
use App\Models\Good;


class GoodsTableSeeder extends Seeder {

  public function run () 
  {

    DB::table('goods')->delete();

    Good::create([
    
      'name' => '三个月以内的临牌',

      'code' => 'below-three',

      'intro' => '三个月以内的是上海的临时牌照。',

      'pic' => 'imgs/goods/fraly.jpg',

      'active' => 1
    
    
    ]);

    Good::create([
    
      'name' => '三个月以上的临牌',

      'code' => 'beyond-three',

      'intro' => '三个月上内的是非上海地区的临时牌照。',

      'pic' => 'imgs/goods/bujiadi.jpg',

      'active' => 1
    
    ]);



  }


}

