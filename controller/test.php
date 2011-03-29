<?php

class Test extends Contr {
  function load() {
    return $this->access();
  }
  
  function index() {
    $data = array(
      'yay' => 'muharharharh'
    );
    
    $this->render('test', $data);
  }
  
  function access() {
    return true;
  }
  
  function text($yay) {
    $data = array(
      'yay' => $yay
    );
    
    $this->render('test', $data);
  }
}
