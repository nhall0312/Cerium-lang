<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('output', 'Handles basic output to the terminal.');

// Register the functions with Cerium
registerFunction('output', 'print', 1, 1, 'Output a message to the console.');
registerFunction('output', 'error', 1, 1, 'Output an error to the console.');

// Basic function output_to log to console
function output_print($arguments) {
  $message = $arguments[0];
  $newline = true;
  if(isset($arguments[1])) {
    $newline = filter_var($arguments[1], FILTER_VALIDATE_BOOLEAN);
  }
  if($newline) {
    $message = $message."\n";
  }
  echo($message);
  return true;
}

// Basic function output_to log an error
function output_error($arguments) {
  $message = $arguments[0];
  $newline = true;
  if(isset($arguments[1])) {
    $newline = filter_var($arguments[1], FILTER_VALIDATE_BOOLEAN);
  }
  if($newline) {
    $message = $message."\n";
  }
  echo('[ERROR]: '.$message);
  return true;
}

?>
