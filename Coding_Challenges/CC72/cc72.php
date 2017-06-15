<?php
include("../../translationutils/jsarray.php");
$height = 500;
$width = 500;
class Point{
  function __construct(){
    global $height;
    global $width;
    $this->x = rand(0,$width);
    $this->y = rand(0,$height);
    if($this->x > $this->y){
      $this->label = 1;
    } else {
      $this->label = -1;
    }
  }
}
// The activation function
function sign($n){
  if($n >= 0){
    return 1;
  } else {
    return -1;
  }
}
class Perceptron{
  // Constructor
  function __construct(){
    // Initialize the weights randomly
    $this->weights = array(rand(-1000,1000)/1000,rand(-1000,1000)/1000);
    $this->lr = 0.1;
  }
  function guess($inputs){
    $sum = 0;
    foreach(array_combine($this->weights,$inputs) as $weight => $input){
      $sum += $input*$weight;
    }
    return sign($sum);
  }
  function train($inputs,$target){
    $guess = sign($this->guess($inputs));
    $error = $target - $guess;
    foreach(array_combine($this->weights,$inputs) as $weight => $input){
      $weight += $error * $input * $this->lr;
    }
  }
}

// Main Code
$brain = new Perceptron();
$points = new jsarray();
for($i = 0;$i<10;$i++){
  $points->push(new Point());
}
$trainingindex = 0;
for($i = 0;$i<1;$i++){
  $training = $points($trainingindex,NULL);
  $inputs = new jsarray($training->x,$training->y);
  $target = $training->label;
  $brain->train($inputs->vals,$target);
  $trainingindex++;
  if($trainingindex == $points->length) {
    $trainingindex = 0;
  }
}
?>
