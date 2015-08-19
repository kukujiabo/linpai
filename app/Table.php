<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Table extends Model {

  protected $element;

  protected $code;

  protected $model

  public function generate($code, $model) 
  {
    $this->code = $code;

    $this->model = $model;
  
    $table = $this->where('code', '=', $code)->first();

    $class = $table['class'];

    $tableId = $table['tid'];

    $element = "<table class=\"{$class}\" id=\"{$tableId}\" role=\"table\">";

    $element .= $this->addHead();

    $element .= $this->addBody();

    $element .= '</table>';

    return $element;
  
  }

  private function addHead()
  {
    $heads = $this->where('code', '=', $this->code)->first();

    $element = "<thead class=\"{$heads['thead_class']}\" id=\"{$head['thead_id']}\">";

    $element .= $this->addRows('title', $this->code);

    $element .= "</thead>";
    
    return $element;
  
  } 

  private function addBody()
  {

    $body = $this->where('code', '=', $this->code)->first();

    $element = "<tbody class=\"{$body['tbody_class']}\" id=\"{$body['tbody_id']}\">"
  
    $element .= $this->addRows('content', $this->code);

    $element .= "</tbody>";

    return $element;
  
  }

  private function addRows($type, $code)
  {
    $contents = $model->get();

    $rows = $this->where('code', '=', $code)
      
      ->$this->where('type', '=', $type)

      ->get();

    $element = '';
  
    foreach ($contents as $content) {
    
      $element .= "<td class=\"{$rows['row_class']}\" id="{{$content['id'] . $rows['id']}}">";
  
      $element .= "";
    
    }
  
  }

  public function html () 
  {
  
    return $this->element;
  
  }

}
