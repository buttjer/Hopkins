<?php

function db() {
  try {
    return new Mongo();
  }
  catch(MongoConnectionException $e) {
    die('Could not connect. Check to make sure MongoDB is running.');
  }
}

$key = "213124%*4!#$;\.k~'(_@%*4!#$;\.k~'(_@%*4!#$;\.k~'(_@";