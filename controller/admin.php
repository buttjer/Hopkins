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
        )
    );
    
    $db = db();
    $col  = $db->bb->settings;
    
    
    if ($_POST) {
      $col->drop();
      if (isset($_POST['settings']) && is_array($_POST['settings'])) {
        foreach ($_POST['settings'] as $id => $set) {
          $id = new MongoId($id);
          $col->insert($set, true);
        }
      }
    }
    
    $res = $col->find();
    
    foreach ($res as $key => $doc) {
      $data['settings'][$key] = $doc;
    }
    
    $this->render($data, 'admin', 'settings');
    
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
    
    $this->render($data, 'admin');
    
  }

}
