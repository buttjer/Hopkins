<?php

class Test extends Contr {
  function load() {
    return $this->access();
  }
  
  function index() {
    $data = array(
      'yay' => 'muharharharh'
    );
    
    $this->render($data, 'test');
  }
  
  function access() {
    return true;
  }
  
  function text($yay) {
    $data = array(
      'yay' => $yay
    );
    
    $this->render($data, 'test');
  }
}
