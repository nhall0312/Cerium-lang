<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('time', 'Handles basic time functions.');

// Register the functions with Cerium
registerFunction('time', 'getTime', 0, 0, 'Returns Linux epoch time.');
registerFunction('time', 'pause', 1, 0, 'Sleeps for given milliseconds');

function time_getTime() {
  return time();
}

function time_pause($arguments) {
  $timeToPause = intval($arguments[0]);
  usleep($timeToPause * 1000);
  return true;
}

?>
