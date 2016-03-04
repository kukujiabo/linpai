<?php


for ($i = 0; $i < 100; $i++) {
  $data = getRand();
  echo $data . ' ';
}

function getRand () {
  $pattern = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $output  = '';
  for ($a = 0; $a < 8; $a++ ) {
    $output .= $pattern{rand(0, 61)};
  }
  return strtolower($output); 
}
