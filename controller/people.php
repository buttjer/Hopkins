<?php

class People extends Contr {
  
  private $data;
  
  function load() {
    $this->helper('menu');
    $menu = menu();
    $menu['people']['status'] = true;
    $this->data['menu'] = $menu;
    return true;
  }
  
  function index() {
    $data = $this->data;
    $this->render($data, 'page', 'people');
  }
  
}