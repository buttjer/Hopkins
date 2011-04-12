<?php

function menu() {
  return array(
    "weblog" => array(
      "path" => "/",
      "title" => "Weblog",
      "status" => false
      ),
    "projects" => array(
      "path" => "/projects",
      "title" => "Projects",
      "status" => false
      ),
    "people" => array(
      "path" => "/people",
      "title" => "People",
      "status" => false
      )
  );
}