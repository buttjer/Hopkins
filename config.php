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

// load and set page globals
$global = array();
$global['db'] = db();
$col  = $global['db']->bb->settings;
$res = $col->find();
foreach ($res as $doc) {
  if ($doc['name'] == 'global') {
    foreach ($doc as $key => $item) {
      $global[$key] = $item;
    }
  }
}