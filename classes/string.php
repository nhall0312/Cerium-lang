<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('string', 'Handles basic string functions.');

// Register the functions with Cerium
registerFunction('string', 'areEqual', 2, 1, 'Returns whether two strings are equal.');
registerFunction('string', 'getLength', 1, 0, 'Returns the length of the string.');
registerFunction('string', 'getLowerCase', 1, 0, 'Returns the string as lowercase.');
registerFunction('string', 'getUpperCase', 1, 0, 'Returns the string as uppercase.');

function string_areEqual($arguments) {
  $string1 = $arguments[0];
  $string2 = $arguments[1];
  $operator = 'equal';
  if(isset($arguments[2])) {
    $operator = strtolower($arguements[2]);
  }
  if($operator == 'equal') {
    return ($string1 == $string2) ? 'true' : 'false';
  } else if($operator == 'identical') {
    return ($string1 === $string2) ? 'true' : 'false';
  }
}

function string_getLength($arguments) {
  $str = $arguments[0];
  return strlen($str);
}

function string_getLowerCase($arguments) {
  $str = $arguments[0];
  return strtolower($str);
}

function string_getUpperCase($arguments) {
  $str = $arguments[0];
  return strtoupper($str);
}

?>
