<?php

class Test extends Contr {
  function load() {
    $this->helper('markdown');
    
    return true;
  }
  
  function index() {
    $data = array(
      'yay' => markdown('_muharharharh_')
    );
    
    $this->render($data, 'test');
  }
  
  function text($yay) {
    $data = array(
      'yay' => $yay
    );
    
    $this->render($data, 'test');
  }
}
