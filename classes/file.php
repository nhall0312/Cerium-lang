<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('file', 'Handles general file management.');

// Register the functions with Cerium
registerFunction('file', 'read', 1, 0, 'Returns the contents of the file at the given path.');

function file_read($arguments) {
  $file = $arguments[0];
  $contents = file_get_contents($file);
  return $contents;
}

?>
