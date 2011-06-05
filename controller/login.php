<?php

class Login extends Contr {
  
  function session() {
    global $global;
    session_start();
    unset($_SESSION['user']);
    $data = array();
    
    if ($_POST) {
      $username = $_POST['username'];
      $password = $_POST['password'];
      $col = $global['db']->content;
      $doc = $col->findone(array('username' => $username));
      if (crypt($password, constant('KEY')) == $doc['password']) {
        $_SESSION['user'] = (string)$doc['_id'];
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