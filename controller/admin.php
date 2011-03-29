<?php

class Admin extends Contr {

  function index() {
    
    $data = array();
    
    if($this->access()) {
      $this->render('admin', $data);
    } else {
      $this->location('login/destination/admin');
    }
    
  }
  
  function access() {
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['user'] == 1) {
      return true;
    } else {
      return false;
    }
  }
  
}
