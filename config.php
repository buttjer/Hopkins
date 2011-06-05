<?php
// timezone
date_default_timezone_set('Europe/Berlin');

// set constants
define('KEY', "213124%*4!#$;\.k~'(_@%*4!#$;\.k~'(_@%*4!#$;\.k~'(_@");

// db connect
function db() {
  try {
    return new Mongo();
  }
  catch(MongoConnectionException $e) {
    die('Could not connect. Check to make sure MongoDB is running.');
  }
}

$db = db();

// load and set page globals
$global = array();
$global['db'] = $db->bb;
$col  = $global['db']->settings;
$res = $col->find();
$global['index'] = 'hello';
foreach ($res as $doc) {
  if ($doc['name'] == 'global') {
    foreach ($doc as $key => $item) {
      $global[$key] = $item;
    }
  }
}
$global['basepath'] = substr($_SERVER['SCRIPT_NAME'], 0, strlen($_SERVER['SCRIPT_NAME'])-9);
$global['path'] = substr($_SERVER['REQUEST_URI'], strlen($global['basepath']));