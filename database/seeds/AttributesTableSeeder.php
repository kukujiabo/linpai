<?php

use Illuminate\Database\Seeder;
use App\Models\Attribute;

class AttributesTableSeeder extends Seeder {

  public function run () 
  {

    DB::table('attributes')->delete();

    /*价格*/
    Attribute::create([
    
      'name' => '价格',

      'code' => 'price',

      'intro' => '商品的价格',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

    /*主图*/
    Attribute::create([
    
      'name' => '主图',

      'code' => 'main_pic',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

    /**/
    Attribute::create([
    
      'name' => '副图1',

      'code' => 'sub_pic',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

    Attribute::create([

      'name' => '身份证正面扫描件',

      'spec' => 'file_upload',

      'code' => 'identity_face',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

    Attribute::create([

      'name' => '身份证背面扫描件',

      'spec' => 'file_upload',

      'code' => 'identity_back',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);


    Attribute::create([

      'name' => '交强险副本扫描件',

      'spec' => 'file_upload',

      'code' => 'trans_ensurance',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

    Attribute::create([

      'name' => '车辆购买发票',

      'spec' => 'file_upload',

      'code' => 'car_check',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);


    Attribute::create([

      'name' => '合格证扫描件',

      'spec' => 'file_upload',

      'code' => 'validate_paper',

      'intro' => '',

      'parent' => 0,

      'class' => 0,

      'important' => 0,

      'active' => 1
    
    ]);

  }

}
