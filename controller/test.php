<?php

class Test extends Contr {
  function index() {
    $data = array(
      'yay' => 'muharharharh'
    );
    
    $this->render('test', $data);
  }
  
  function access() {
    return false;
  }
  
  function text($yay) {
    $data = array(
      'yay' => $yay
    );
    
    $this->render('test', $data);
  }
}
