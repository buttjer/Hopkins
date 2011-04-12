<?php

class Blog extends Contr {
  
  private $data;
  
  function load() {
    $this->helper('markdown');
    $this->helper('menu');
    $menu = menu();
    $menu['weblog']['status'] = true;
    $this->data['menu'] = $menu;
    return true;
  }
  
  function index() {
    $data = $this->data;
    $db = db();
    $col  = $db->bb->content;
    $res = $col->find();
    foreach ($res as $key => $doc) {
      $doc['text'] = Markdown($doc['text']);
      $data['entries'][$doc['date']] = $doc;
      $data['entries'][$doc['date']]['id'] = $key;
    }
    krsort($data['entries']);
    
    $this->render($data, 'page', 'blog');
  }
  
  function feed() {
    $db = db();
    $col  = $db->bb->content;
    $res = $col->find();
    foreach ($res as $key => $doc) {
      $doc['text'] = Markdown($doc['text']);
      $data['entries'][$doc['date']] = $doc;
      $data['entries'][$doc['date']]['id'] = $key;
    }
    krsort($data['entries']);
    $this->render($data, 'blog-feed');
  }
  
  function entry($id = NULL) {
    $data = $this->data;
    
    if (isset($id)) {
      $db = db();
      $col  = $db->bb->content;
      $mid = new MongoId($id);
      $doc = $col->findone(array('_id' => $mid));
      if (isset($doc)) {
        $doc['text'] = Markdown($doc['text']);
        $data['entries'][$doc['date']] = $doc;
        $data['entries'][$doc['date']]['id'] = $id;
        $this->render($data, 'page', 'blog');
      } else {
        //TODO 404
      }
    }
  }
  
}