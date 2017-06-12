<?php
$vals = array(0,1,2,3,4,5,6,7,8,9);
$keys = array_keys($vals);
function swap($a,$i,$j){
  $arr = $a;
  $temp = $arr[$i];
  $arr[$i] = $arr[$j];
  $arr[$j] = $temp;
  return $arr;
}
for(;;){

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
    break;
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
?>
