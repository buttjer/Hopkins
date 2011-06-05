<?php

class Hello extends Contr {
  
  private $data;
  
  function index() {
    $data['hello'] = 'Hello World';
    $this->render($data, 'hello');
  }
  
}