<?php

class Admin extends Contr {
  
  private $data = array(
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
  
  function load() {
    if($this->access()) {
       return true;
    } else {
       $this->location('login/destination/admin');
       return false;
    }
  }

  function index() {
    
    $data = $this->data;
    
    $this->render($data, 'admin');
    
  }
  
  function access() {
    global $global;
    session_start();
    if (isset($_SESSION['user'])) {
      $col = $global['db']->bb->content;
      $id = new MongoId($_SESSION['user']);
      $doc = $col->findone(array('_id' => $id, 'type' => 'profile'));
      if(is_array($doc)) {
         return true;
      }
    }
    return false;
  }
  
  function settings() {
    
    global $global;
    
    $data = $this->data;
    $col = $global['db']->bb->settings;
    
    $data['title'][] = 'settings';
    
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
    
    $this->render($data, 'admin', 'admin-settings');
    
  }
  
  function content($type = NULL, $action = NULL, $id = NULL) {
    
    global $global;
      
    $data = $this->data;
    $data['title'][] = 'content';
    if(isset($type)) {
      $data['title'][] = $type;
    }
    $data['type'] = $type;
    
    $col  = $global['db']->bb->settings;
    
    $res = $col->find();
    
    foreach ($res as $doc) {
      if ($doc['name'] == 'content') {
        foreach ($doc as $key => $item) {
          if (is_array($item)) {
            $data['contenttypes'][$key] = 'admin/content/' . $key;
            $form[$key] = $item;
          }
        }
      }
    }
    
    $data['actions'] = array();
    if (isset($type)) {
      $data['actions']['add'] = 'admin/content/' . $type . '/entry';
    }
    
    if (isset($action)) {
      $data['actions']['add'] = 'admin/content/' . $type . '/entry';
    }
    
    switch ($action) {
      default:
      case 'list':
        $data['entries'] = array();
        $col  = $global['db']->bb->content;
        
        if($type) {
          $res = $col->find(array('type' => $type));
        } else {
          $res = $col->find();
        }
        
        foreach ($res as $key => $doc) {
          $data['entries'][$key] = $doc;
        }
        $this->render($data, 'admin', 'admin-content', 'admin-content-list');
        break;
      case 'entry':
        $col  = $global['db']->bb->content;
        if ($_POST) {
          if (isset($_POST['content']) && is_array($_POST['content'])) {
            
            if(isset($_POST['content']['password']) && $_POST['content']['password']) {
              $_POST['content']['password'] = crypt($_POST['content']['password'], constant('KEY'));
            }
            if(isset($_POST['content']['_id'])) {
              $id = new MongoId($_POST['content']['_id']);
              unset($_POST['content']['_id']);
              if(isset($_POST['content']['password']) && !$_POST['content']['password']) {
                $mid = new MongoId($id);
                $doc = $col->findone(array('_id' => $mid));
                $_POST['content']['password'] = $doc['password'];
              }
              $col->update(array('_id' => $id), $_POST['content']);
            } else {
              unset($_POST['content']['_id']);
              $col->insert($_POST['content'], true);
            }
          }
        }
        $data['title'][] = 'entry';
        $data['content'] = $form[$type];
        if(isset($id)) {
          $mid = new MongoId($id);
          $doc = $col->findone(array('_id' => $mid));
          foreach($data['content'] as $key => $item) {
            if(!isset($doc[$key]) || $item['type'] == 'password') {
              $value = '';
            } else {
              $value = $doc[$key];
            }
            $data['content'][$key]['value'] = $value;
          }
          $data['content']['_id'] = $id;
        }
        
        $this->render($data, 'admin', 'admin-content', 'admin-content-save');
        break;
      case 'remove':
        if ($_POST) {
          $id = new MongoId($_POST['content']['_id']);
          $col  = $global['db']->bb->content;
          $col->remove(array('_id' => $id), array('justOne' => true, 'safe' => true));
          $this->location('admin/content');
        }
        $data['content']['_id'] = $id;
        $this->render($data, 'admin', 'admin-content', 'admin-content-remove');
        break;
    }
    
  }

}
