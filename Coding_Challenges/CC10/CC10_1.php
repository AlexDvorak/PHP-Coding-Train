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
$height = 600;
$width = 600;
$cols = floor($width/$w);
$rows = floor($height/$w);

function index($i, $j) {
  if ($i < 0 || $j < 0 || $i > $cols - 1 || $j > $rows - 1) {
    return -1;
  }
  return $i + $j * $cols;
}

// Classes
class Cell{
  function __construct($i,$j){
    $this->i = $i;
    $this->j = $j;
    $this->walls = new jsarray(true,true,true,true);
    $this->visited = false;
  }
}

function removeWalls($a, $b) {
  $x = $a->i - $b->i;
  if ($x === 1) {
    $a->walls(3,false);
    $b->walls(1,false);
  } else if ($x === -1) {
    $a->walls(1,false);
    $b->walls(3,false);
  }
  $y = $a->j - $b->j;
  if ($y === 1) {
    $a->walls(0,false);
    $b->walls(2,false);
  } else if ($y === -1) {
    $a->walls(2,false);
    $b->walls(0,false);
  }
}

// Setup
for($j = 0;$j < $rows;$j++){
  for($i = 0;$i < $cols;$i++){
    $cell = new Cell($i,$j);
    $grid->push($cell);
  }
}
$current = $grid(0,NULL);

// Main Code

?>
