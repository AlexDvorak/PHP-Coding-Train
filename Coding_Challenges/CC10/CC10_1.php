<?php
// Daniel Shiffman
// http://codingtra.in
// http://patreon.com/codingtrain
//
// Videos
// https://youtu.be/HyK_Q5rrcr4
// https://youtu.be/D8UgRyRnvXU
// https://youtu.be/8Ju_uxJ9v44
// https://youtu.be/_p5IH0L63wo
//
// Depth-first search
// Recursive backtracker
// https://en.wikipedia.org/wiki/Maze_generation_algorithm
// Global Variables

include("../../translationutils/jsarray.php");
$cols;
$rows;
$w = 20;
$grid = new jsarray();
$current;
$stack = new jsarray();
$height = 300;
$width = 300;
$cols = floor($width/$w);
$rows = floor($height/$w);

function index($i, $j) {
  global $cols;
  global $rows;
  if ($i < 0 || $j < 0 || $i > $cols - 1 || $j > $rows - 1) {
    return -1;
  }
  return $i + $j * $cols;
}

// Setup
for($j = 0;$j < $rows;$j++){
  for($i = 0;$i < $cols;$i++){
    $cell = new Cell($i,$j);
    $grid->push($cell);
  }
}

// Classes
class Cell{
  function __construct(int $i,int $j){
    $this->i = $i;
    $this->j = $j;
    $this->walls = new jsarray(true,true,true,true);
    $this->visited = false;
  }
  function checkNeighbors(){
    $neighbors = new jsarray();
    global $grid;
    $top = $grid(index($this->i,$this->j-1),NULL);
    $right = $grid(index($this->i+1,$this->j),NULL);
    $bottom = $grid(index($this->i,$this->j+1),NULL);
    $left = $grid(index($this->i-1,$this->j),NULL);
    if ($top && !$top->visited) {
      $neighbors->push($top);
    }
    if ($right && !$right->visited) {
      $neighbors->push($right);
    }
    if ($bottom && !$bottom->visited) {
      $neighbors->push($bottom);
    }
    if ($left && !$left->visited) {
      $neighbors->push($left);
    }

    if ($neighbors->length > 0) {
      $r = floor(rand(0, $neighbors->length));
      return $neighbors((string) $r,NULL);
    } else {
      return NULL;
    }
  }
  function wall($indx,$exchange){
    if($exchange === NULL){
      if($indx > -1 && $indx != NULL){
        $b = new jsarray($this->walls);
        return $b($indx,NULL);
      }
    } else {
      if($indx > -1 && $indx != NULL){
        $b = new jsarray($this->walls);
        $b($indx,$exchange);
        $this->walls = $b;
      }
    }
  }
  function visit(){
    $this->visited = true;
  }
}
function removeWalls(Cell $a,Cell $b) {
  $x = $a->i - $b->i;
  if ($x === 1) {
    $a->wall(3,false);
    $b->wall(1,false);
  } else if ($x === -1) {
    $a->wall(1,false);
    $b->wall(3,false);
  }
  $y = $a->j - $b->j;
  if ($y === 1) {
    $a->wall(0,false);
    $b->wall(2,false);
  } else if ($y === -1) {
    $a->wall(2,false);
    $b->wall(0,false);
  }
}
$current = new Cell(0,0);

// Main Code
for ($p=0;$p<50;$p++){
  $current->visit();
  $next = $current->checkNeighbors();
  if($next){
    $next->visited = true;
    $stack->push($current);
    removeWalls($current,$next);
    $current = $next;
  } else if($stack->length > 0){
    $current = $stack->pop();
  }
}
$counter = 0;
foreach($grid->vals as $cell){
  if($counter === $w){
    echo "\n";
    if($cell->visited === true){
      echo "&";
    } else {
      echo "*";
    }
    $counter = 0;
  } else {
    if($cell->visited === true){
      echo "&";
    } else {
      echo "*";
    }
  }
  $counter++;
}
?>
