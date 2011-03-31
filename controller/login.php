<?php

class Login extends Contr {
  
  function session() {
    session_start();
    unset($_SESSION['user']);
    $data = array();
    
    if ($_POST) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      if ($username == "admin" && crypt($password, $key) == "21OZ4/WxREgV.") {
        $_SESSION['user'] = 1;
      }
      else {
        $data["error"] = "username or password incorrect";
      }
    }
    
    if (!isset($_SESSION['user'])) {
      $this->render($data, 'login');
      return false;
    } 
    else {
      return true;
    }
  }

  function index() {
    if($this->session()) {
      $this->location('');
    }
  }
  
  function destination($path) {
    if($this->session()) {
      $this->location($path);
    }
  }
  
}