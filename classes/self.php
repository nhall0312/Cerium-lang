<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');
require_once('./helpers/builtin.php');

// Register the class with Cerium
registerClass('self', 'Retrieves information about Cerium.');

// Register the function math_with Cerium
registerFunction('self', 'getFunctions', 0, 0, 'Returns all of the functions registered.');

function self_getFunctions() {
  return builtin_functions();
}

?>
