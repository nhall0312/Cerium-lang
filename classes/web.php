<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');

// Register the class with Cerium
registerClass('web', 'Handles basic web functions.');

// Register the functions with Cerium
registerFunction('web', 'query', 1, 0, 'Queries a given URL.');
registerFunction('web', 'display', 2, 99999, 'Displays a given object on a web server.'); // Note: The 99999 is a work around until a better argument parser can be written.
registerFunction('web', 'close', 1, 0, 'Closes the web server on the given port.');

$displayCommand = 'php -S {{host}} {{path}}';
$closeCommand = 'lsof -ti :{{port}} -s TCP:LISTEN | xargs kill';

function web_query($arguments) {
  $url = $arguments[0];
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($ch, CURLOPT_ENCODING, "gzip,deflate");
  $response = curl_exec($ch);
  curl_close($ch);
  return $response;
}

function web_display($arguments) {
  $host = $arguments[0];
  $display = '';
  $i = 1;
  while($i < count($arguments)) {
    $display .= $arguments[$i];
  }
  //TODO: Finish this
}

function web_close($arguments) {
  //TODO: Finish this
}

?>
