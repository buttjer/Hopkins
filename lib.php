<?php

class Lib {
  
  public $options;
  protected $routes;
  
  function __construct($options = array()) {
    $this->options = array(
      'root' => dirname(__FILE__)
    );
    
    foreach ($options as $key => $value) {
      $this->options[$key] = $value;
    }
    
    $path = scandir(realpath($this->options['root'] . '/controller/'));
    foreach ($path as $dir) {
      if ($dir != '.' && $dir != '..') {
        $dir = substr($dir, 0, strpos($dir, '.'));
        $this->register($dir);
      }
    }

    set_error_handler(array($this, 'handle_error'));
  }
  
  function handle_error($errno, $errstr, $errfile, $errline) {
    if (!(error_reporting() & $errno)) {
      return;
    }

    print "Unknown error type: [$errno] $errstr in file $errfile on line $errline<br />\n";
    return true;
  }

  function show_404() {
    header("HTTP/1.0 404 Not Found");
    $this->render('404');
    die();
  }
  
  function register($route) {
    $this->routes[$route] = $route;
  }
  
  function run() {
    
    global $global;  
    header("Content-type: text/html; charset={utf-8}");
    if (!$global['path']) {
      include(realpath($this->options['root'] . '/controller/'. $global['index'] . '.php'));
      $reflection = new ReflectionClass($global['index']);     
      return $reflection->newInstance($this->options, NULL);
    }
    else {
      $path = explode('/', $global['path']);
      foreach ($this->routes as $route => $class) {
        if ($route == $path[0]) {
          $args = array_slice($path, 1);
          
          include(realpath($this->options['root'] . '/controller/'. $class . '.php'));
          $reflection = new ReflectionClass($class);
          return $reflection->newInstance($this->options, $args);
        }
      }
    }
    
    return $this->show_404();
  }
}

class Contr {
  public $options;
  
  function __construct($opt, $args = array()) {
    $this->options = $opt;
    
    if ($this->load()) {
      if (!empty($args)) {
        if (method_exists($this, $args[0])) {
          $ref = new ReflectionMethod(get_class($this), $args[0]);
          unset($args[0]);
          return $ref->invokeArgs($this, $args);
        }
      }
      else {
        return $this->index();
      }
    }
    else {
      $this->show_403();
    }
    
    $this->show_404();
  }
  
  function helper($name) {
    include(realpath($this->options['root'] . '/helper/'. $name . '.php'));
  }
  
  function load() {
    return true;
  }
  
  function index() {
    $this->show_404();
  }
  
  function show_404() {
    $this->render('404');
    die();
  }
  
  function show_403() {
    $this->render('403');
    die();
  }
  
  function render() {
    $args = func_get_args();
    
    if (count($args) <= 1) {
      $files[] = $args[0];
    } 
    else {
      $data = $args[0];
      extract($data);
      unset($args[0]);
      $files = $args;
    }
    
    foreach ($files as $file) {
      $view[] = realpath($this->options['root'] . '/views/' . $file . '.php');
    }
    
    ob_start();
    include($view[0]);
    print ob_get_clean();
  }
  
  function location($path = '') {
    global $global;
    header('Location: '. $global["basepath"] . $path);
    return true;
  }
  
}
