<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

$variables = array();

function setVariable($variable, $value) {
  global $variables;
  $variables[$variable] = $value;
  $keys = array_map('strlen', array_keys($variables));
  array_multisort($keys, SORT_DESC, $variables);
}

function replaceVariables($line) {
  global $variables;
  foreach($variables as $key => $value) {
    $line = str_replace($key, $value, $line);
  }
  return $line;
}

?>
