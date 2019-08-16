<?php

// Formatting of a conditional:
// if(condition -> call)

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');
require_once('./helpers/variables.php');

function checkConditional($line) {
  $line = str_replace('if (', '', $line);
  $line = substr($line, 0, -1);
  $arr = explode(' => ', $line);
  if(isFunction($arr[0]) && filter_var(evaluateFunction($arr[0]), FILTER_VALIDATE_BOOLEAN)) {
    evaluateFunction($arr[1]);
  } else if(!isFunction($arr[0]) && filter_var(replaceVariables($arr[0]), FILTER_VALIDATE_BOOLEAN)) {
    evaluateFunction($arr[1]);
  }
}

function checkFalseConditional($line) {
  $line = str_replace('!if (', '', $line);
  $line = substr($line, 0, -1);
  $arr = explode(' => ', $line);
  if(isFunction($arr[0]) && !filter_var(evaluateFunction($arr[0]), FILTER_VALIDATE_BOOLEAN)) {
    evaluateFunction($arr[1]);
  } else if(!isFunction($arr[0]) && !filter_var(replaceVariables($arr[0]), FILTER_VALIDATE_BOOLEAN)) {
    evaluateFunction($arr[1]);
  }
}

?>
