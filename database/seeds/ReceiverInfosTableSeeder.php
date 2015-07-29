<?php

use Illuminate\Database\Seeder as Seeder;
use App\Models\ReceiverInfo;
use App\User;

class ReceiverInfosTableSeeder extends Seeder {

  public function run ()
  {
  
    DB::table('receiver_infos')->delete();

    $users = User::all();

    foreach ($users as $user) {

      ReceiverInfo::create([
        
        'uid' => $user->id,
      
        'name' => '客户 ' . $user->id,

        'contact' => $user->mobile,

        'country' => 1,

        'province' => 1,

        'city' => 1,

        'district' => 1,

        'road' => 1,

        'addr_num' => '北京东路688号 科技京城西楼15d',

        'address' => '上海 上海市 黄浦区 北京东路' . $user->id . '号',

        'comment' => '请在周一到周五送货！',

        'ext_0' => '',

        'active' => 1
      
      ]);

    }
  
  }

}
