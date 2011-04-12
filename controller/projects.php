<?php

class Projects extends Contr {
  
  private $data;
  
  function load() {
    $this->helper('menu');
    $menu = menu();
    $menu['projects']['status'] = true;
    $this->data['menu'] = $menu;
    return true;
  }
  
  function index() {
    $data = $this->data;
    $this->render($data, 'page', 'projects');
  }
  
}