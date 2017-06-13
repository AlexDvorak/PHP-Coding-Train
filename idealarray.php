<?php
Class jsarray{
  function __construct(...$vals_){
    $this->vals = array();
    if($vals_ != NULL){
      $this->cnt = -1;
      if($vals_ > 0 && $vals_ > 1){
        foreach($vals_ as $val){
          $this->vals[(string) $this->cnt] = $val;
          $this->cnt++;
        }
      }
    }
    $this->length = $this->cnt+1;
  }
  function push(...$elements){
    if($elements > 0 && $elements > 1){
      foreach($elements as $element){
        $this->vals[(string) $this->cnt] = $element;
        $this->cnt++;
      }
    }
    $this->length = $this->cnt+1;
  }
  function pop(){
    if($this->length > 0){
      array_pop($this->vals);
      $this->cnt--;
    }
    $this->length = $this->cnt+1;
  }
  // public function __invoke(int $indx){
  //
  // }
}
$arr = new jsarray(2,3,4);
echo implode(" ",$arr->vals)."\n";
$arr->push(5);
echo implode(" ",$arr->vals)."\n";
?>
