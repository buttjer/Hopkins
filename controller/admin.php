<?php

class Admin extends Contr {
  
  function load() {
    if($this->access()) {
       return true;
    } else {
       $this->location('login/destination/admin');
       return false;
    }
  }

  function index() {
    $data = array(
      "title" => array(
        "ADMIN"
        ),
      "nav" => array(
        "Dashbord" => "admin",
        "Settings" => "admin/settings",
        "Content" => "admin/content",
        "Logout" => "login/destination/admin"
        )
    );
    
    $db = $this->db();
    
    $this->render($data, 'admin');
    
  }
  
  function access() {
    session_start();
    if (isset($_SESSION['user']) && $_SESSION['user'] == 1) {
      return true;
    } else {
      return false;
    }
  }
  
  function settings() {
    
    $data = array(
      "title" => array(
        "ADMIN",
        "Settings"
        ),
      "nav" => array(
        "Dashbord" => "admin",
        "Settings" => "admin/settings",
        "Content" => "admin/content",
        "Logout" => "login/destination/admin"
        ),
      "content" => "bawm"
    );
    
    $db = $this->db();
    
    $this->render($data, 'admin', 'settings', 'contenttypes');
    
  }
  
  function content() {
    
    $data = array(
      "title" => array(
        "ADMIN",
        "Content"
      ),
      "nav" => array(
        "Dashbord" => "admin",
        "Settings" => "admin/settings",
        "Content" => "admin/content",
        "Logout" => "login/destination/admin"
      )
    );
    
    $db = $this->db();
    
    $this->render($data, 'admin');
    
  }

}
