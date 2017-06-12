<?php
// Global Variables
$cities = array();
$totalCities = 5;
$recordDistance;
$bestEver;
$height = 400;
$width = 300;

// Utility Functions
function dist($x0,$y0,$x1,$y1){
  $a = abs($y0-$y1)**2;
  $b = abs($x0-$x1)**2;
  return sqrt($a+$b);
}
function calcDistance($points){
  $sum = 0;
  $keys = array_keys($points);
  for($i = 0; $i < count($keys)-1; $i++){
    $x0 = $points[$keys[$i]]["x"];
    $y0 = $points[$keys[$i]]["y"];
    $x1 = $points[$keys[$i+1]]["x"];
    $y1 = $points[$keys[$i+1]]["y"];
    $sum += dist($x0,$y0,$x1,$y1);
  }
  return $sum;
}
function swap($a,$i,$j){
  $arr = $a;
  $temp = $arr[$i];
  $arr[$i] = $arr[$j];
  $arr[$j] = $temp;
  return $arr;
}

// Main Code
for($i = 0; $i < $totalCities;$i++){
  $cities[] = array("x"=>rand(0,$width),"y"=>rand(0,$height));
}
$d = calcDistance($cities);
$recordDistance = $d;
$bestever = array_slice($cities,0);
$i = rand(0,$totalCities-1);
$j = rand(0,$totalCities-1);
#var_dump($cities);
$cities = swap($cities,$i,$j);
var_dump($recordDistance);
$d = calcDistance($cities);
if($d < $recordDistance){
  $recordDistance = $d;
  $bestever = array_slice($cities,0);
}
?>
