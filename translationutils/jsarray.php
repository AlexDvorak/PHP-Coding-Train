<?php
Class jsarray{
  function __construct(...$vals_){
    $this->vals = array();
    $this->cnt = -1;
    if($vals_ != NULL){
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
    if($elements != NULL && $elements > 0){
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
  function __invoke(int $indx,$exchange,...$vals0){
    if($indx != NULL && $indx > -1){
      return $this->vals[(string) ($indx-1)];
    } else if($exchange != NULL && $indx > -1) {
      $this->vals[(string) ($indx-1)] = $exchange;
    } else if($vals0 != NULL){
      $this->vals = array();
      $this->cnt = -1;
      $this->cnt = -1;
      if($vals_ > 0 && $vals_ > 1){
        foreach($vals_ as $val){
          $this->vals[(string) $this->cnt] = $val;
          $this->cnt++;
        }
      }
    }
  }
  function concat(self ...$arrays){
    if($arrays > 0 && $arrays != NULL){
      $finalarr = $this;
      foreach($arrays as $array){
        $finalarr->vals = array_merge_recursive($finalarr->vals,$array->vals);
      }
      $finalarr->length = count($finalarr->vals);
      $finalarr->cnt = $finalarr->length-1;
      return $finalarr;
    }
  }
  function reverse(){
    $this->vals = array_reverse($this->vals);
  }
}
// one $ for every line of this file
?>
