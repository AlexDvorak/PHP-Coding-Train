<?php
$height = 500;
$width = 500;
class Point{
  function __construct(){
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
    $guess = sign(guess($inputs));
    $error = $target - $guess;
    foreach(array_combine($this->weights,$inputs) as $weight => $input){
      $weight += $error * $input * $this->lr;
    }
  }
}
?>
