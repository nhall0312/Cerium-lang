<?php

set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

function builtin_version() {
  global $version;
  echo(" \n");
  echo("Cerium version ".$version."\n");
  echo(" \n");
}

function builtin_update() {
  echo(" \n");
  echo("Cerium version 0.1.0\n");
  echo(" \n");
}

function builtin_help() {
  echo(" \n");
  echo("Commands:\n");
  echo("classes: Lists installed classes.\n");
  echo("functions: Lists available functions.\n");
  echo("help: Lists commands.\n");
  echo("update: Updates the language.\n");
  echo("version: Outputs the version.\n");
  echo(" \n");
}

function builtin_functions() {
  global $functions;
  echo(" \n");
  foreach($functions as $f) {
    echo($f[0].".".$f[1].": ".$f[4]."\n");
  }
  echo("\n");
}

function builtin_classes() {
  global $classes;
  echo(" \n");
  foreach($classes as $name => $description) {
    echo($name.": ".$description."\n");
  }
  echo("\n");
}

?>
