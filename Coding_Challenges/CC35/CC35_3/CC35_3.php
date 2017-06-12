<?php
// Global Variables
$cities = array();
$totalCities = 10;
$order = array();
$keys = array_keys($order);
$totalPermutations;
$count = 0;
$recordDistance;
$bestEver;
$height = 400;
$width = 600;

// Utility Functions
function swap($a,$i,$j){
  $arr = $a;
  $temp = $arr[$i];
  $arr[$i] = $arr[$j];
  $arr[$j] = $temp;
  return $arr;
}
function dist($x0,$y0,$x1,$y1){
  $a = abs($y0-$y1)**2;
  $b = abs($x0-$x1)**2;
  return sqrt($a+$b);
}
function factorial($n){
  if ($n == 1) {
    return 1;
  } else {
    return $n * factorial($n - 1);
  }
}
function calcDistance($points,$order){
  $keys = array_keys($order);
  $sum = 0;
  for($i = 0; $i < count($order)-1;$i++){
    $cityAIndex = $order[$keys[$i]];
    $cityA = $points[$keys[$cityAIndex]];
    $cityBIndex = $order[$keys[$i+1]];
    $cityB = $points[$keys[$cityBIndex]];
    $d = dist($cityA["x"],$cityA["y"],$cityB["x"],$cityB["y"]);
    $sum += $d;
  }
  return $sum;
}
function nextOrder(){
  $keys = array_keys($order);
  $count++;
  // STEP 1 of the algorithm
  // https://www.quora.com/How-would-you-explain-an-algorithm-that-generates-permutations-using-lexicographic-ordering
  $largestI = 9;
  for($i = 0; $i < count($keys)-1; $i++){
    $v0 = $vals[$keys[$i]];
    $v1 = $vals[$keys[$i+1]];
    if($v0<$v1){
      $largestI = $i;
    }
  }
  if($largestI == -1){
    return false;
  }

  // STEP 2
  $largestJ = 9;
  for($j = 0; $j < count($keys)-1; $j++){
    $v0 = $vals[$keys[$largestI]];
    $v1 = $vals[$keys[$j]];
    if($v0<$v1){
      $largestJ = $j;
    }
  }

  // STEP 3
  $vals = swap($vals,$largestI,$largestJ);

  // STEP 4: reverse from largestI + 1 to the end
  $endArray = array_reverse(array_splice($vals,$largestI+1));
  $vals = array_merge($vals,$endArray);
  $s = '';
  foreach($vals as $val){
    $s .= $val;
  }
}

// Main Program
for($i = 0;$i<$totalCities;$i++){
  $v = array("x"=>rand(0,$width),"y"=>rand(0,$height));
  $cities[] = $v;
  $order[] = $i;
}
$d = calcDistance($cities,$order);
$recordDistance = $d;
$bestEver = array_slice($order,0);
$totalPermutations = factorial($totalCities);
var_dump($totalPermutations);
for($aoeu = 0;$aoeu<10;$aoeu++){
  $d = calcDistance($cities,$order);
  if($d < $recordDistance){
    $recordDistance = $d;
    $bestEver = array_slice($bestEver,0);
  }
  $percent = 100 * ($count / $totalPermutations);
  echo (floor($percent*100)/100+0.01)."\% \n";
  nextOrder();
}
?>
