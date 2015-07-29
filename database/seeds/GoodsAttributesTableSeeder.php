<?php 

use Illuminate\Database\Seeder;
use App\Models\GoodAttribute;
use App\Models\Good;
use App\Models\Attribute;

class GoodsAttributesTableSeeder extends Seeder {

  public function run () 
  {
  
    DB::table('good_attribs')->delete();

    $goods = Good::all();

    $attribs = Attribute::all();


    foreach ($goods as $good) {
    
      foreach ($attribs as $attrib) {

        GoodAttribute::create([
        
          'gid' => $good->id,

          'aid' => $attrib->id,

          'value' => '',

          'active' => 1
        
        ]);

      }
    
    }
  
  }

}
