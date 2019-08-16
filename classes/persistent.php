<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');
require_once('./helpers/variables.php');

// Register the class with Cerium
registerClass('persistent', 'Handles persistent variables across sessions.');

// Register the functions with Cerium
registerFunction('persistent', 'makePersistent', 1, 0, 'Saves a variable as persistent.');
registerFunction('persistent', 'loadPersistent', 0, 0, 'Loads persistent variables.');

function makePersistent($varName) {
  global $scriptName;
  global $variables;
  $value = $variables["$".$varName];
  $str = file_get_contents('../data/'.$scriptName.'.json');
  $json = json_decode($str, true);
  $json['variables'][$varName] = $value;
  $json_string = json_encode($array, JSON_PRETTY_PRINT);
  file_put_contents('../data/'.$scriptName.'.json', $json_string);
}

function loadPersistent() {
  global $scriptName;
  global $variables;
  $str = file_get_contents('../data/'.$scriptName.'.json');
  $json = json_decode($str, true);
  foreach($json['variables'] as $key => $value) {
    $variables[$key] = $value;
  }
}


?>
