<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('array', 'Handles arrays: key and lists.');

// Register the functions with Cerium
registerFunction('array', 'toString', 1, 99999, 'Converts an array into a string.');
registerFunction('array', 'create', 0, 0, 'Creates an array.');
registerFunction('array', 'add', 1, 1, 'Adds an object to an array. Optional: Prove a key.');

function array_toString($arguments) {
  $arr = implode(', ', $arguments[0]);
  return $arr;
}

function array_create() {
  $array = array();
  return $array();
}

function array_add($arguments) {
  // TODO: Finish method
}

?>
