<?php

class Lib {
  
  protected $options;
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
    
    header("Content-type: text/html; charset={utf-8}");
    
    if (!isset($_SERVER['PATH_INFO']) || $_SERVER['PATH_INFO'] == '/') {
      $reflection = new ReflectionClass('Ind');
      return $reflection->newInstance($this->options);
    }
    else {
      $path = explode('/', $_SERVER['PATH_INFO']);
      
      foreach ($this->routes as $route => $class) {
        if ($route == $path[1]) {
          $args = array_slice($path, 2);
          
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
  protected $options;
  
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
    
    if(count($args) <= 1) {
      $files[] = $args[0];
    } else {
      $data = $args[0];
      extract($data);
      unset($data);
      unset($args[0]);
      $files = $args;
    }
    
    foreach($files as $key => $file) {
      $view[] = realpath($this->options['root'] . '/views/' . $file . '.php');
    }
    
    ob_start();
    include($view[0]);
    print ob_get_clean();
  }
  
  function location($path = '') {
    header('Location: '. $_SERVER["SCRIPT_NAME"] . '/' . $path);
    return true;
  }
  
  function db() {
    try {
      return new Mongo();
    }
    catch(MongoConnectionException $e) {
      die('Could not connect. Check to make sure MongoDB is running.');
    }
  }
}

class Ind extends Contr {
  function index() {
    $this->render('index');
  }
}
