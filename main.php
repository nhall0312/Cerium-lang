<?php

require_once('./helpers/uuids.php');
require_once('./helpers/builtin.php');
require_once('./helpers/variables.php');
require_once('./helpers/conditionals.php');

$version = '0.1.0';
$updateURL = '';

$specialCommands = array('version', 'update', 'functions', 'classes', 'help');

$functions = array();

$disabledFunctions = array();

$classes = array();

function registerFunction($class, $name, $reqArgs = 0, $otherArgs = 0, $description = 'Default description') {
  global $functions;
  $uid = gen_uuid();
  $arr = array($uid => array($class, $name, $reqArgs, $otherArgs, $description));
  $functions = array_merge($arr, $functions);
}

function registerClass($class, $description) {
  global $classes;
  $arr = array($class => $description);
  $classes = array_merge($arr, $classes);
  ksort($classes);
}

function removeWhitespace($str) {
  $str = ltrim($str);
  return($str);
}

function getArguments($string, $start = '(', $end = ')'){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return explode(', ', str_replace('"', '', substr($string, $ini, $len)));
}

// Import the class files
function importClasses() {
  $files = scandir('./classes/');
  foreach($files as $file) {
    if(strpos($file, '.php') !== false) {
      include('./classes/'.$file);
    }
  }
}

// The Cerium script to execute
if(isset($argv[1])) {
  $scriptName = $argv[1];
} else {
  exit("\nProper usage: cerium {file|command}\nFor help, type 'cerium help'\n\n");
}

if(in_array($scriptName, $specialCommands)) {
  $f = 'builtin_'.$scriptName;
  $f();
  die();
}

importClasses();

// The content of the Cerium script
$script = file_get_contents($scriptName);

$lines = explode(PHP_EOL, $script);

parseLines($lines);

function parseLines($lines, $ignoreInstructions = false, $callImports = false) {
  $repeat = 1;
  $delay = 0;

  if($callImports) {
    importClasses();
  }

  foreach($lines as $line) {

    /*if(strpos($line, 'output.say') !== false) {
      $arguments = getArguments($line);
      say($arguments[0]);
    }*/

    // Ignore comments
    if(strpos(removeWhitespace($line), '//') === 0) {
      continue;
    }

    // Handle instructions
    if((strpos(removeWhitespace($line), '##') === 0) && (!$ignoreInstructions)) {
      $arr = explode(' ', $line);
      $instruction = $arr[1];
      $parameter = $arr[2];
      if($instruction == "REPEAT") {
        $intVal = intval($parameter);
        $repeat = $intVal;
      } else if($instruction == "DELAY") {
        $intVal = intval($parameter);
        $delay = $intVal;
      }
    }

    // Handle conditional
    if(strpos(removeWhitespace($line), 'if') === 0) {
      checkConditional($line);
      continue;
    } else if(strpos(removeWhitespace($line), '!if') === 0) {
      checkFalseConditional($line);
      continue;
    }

    // Evaluate variables
    if(strpos(removeWhitespace($line), '$') === 0) {
      $e = explode(' ', $line);
      $variableName = $e[0];
      $variableValue = str_replace($e[0].' = ', '', $line);
      if(isFunction($variableValue)) {
        $variableValue = evaluateFunction($variableValue);
      }
      setVariable($variableName, $variableValue);
      continue;
    }

    // Check if the line is a function
    if(isFunction(removeWhitespace($line))) {
      evaluateFunction($line);
    }

  }
  if($repeat != 1) {
    while($repeat > 1) {
      usleep($delay * 1000);
      parseLines($lines, true, false);
      $repeat--;
    }
  }
}

function isFunction($str) {
  global $functions;
  global $classes;
  $isFunction = false;
  foreach($classes as $key => $val) {
    if(strpos($str, $key) === 0) {
      foreach($functions as $f) {
        if(strpos($str, $key.'.'.$f[1]) !== false) {
          $isFunction = true;
          break;
        }
      }
    }
  }
  return $isFunction;
}

function evaluateFunction($line) {
  global $functions;
  $return = NULL;
  foreach($functions as $f) {
    if(strpos($line, $f[0].'.'.$f[1]) !== false) {
      if($f[2] + $f[3] > 0) {
        $arguments = getArguments(replaceVariables($line));
        foreach($arguments as $key => $val) {
          if(isFunction($val)) {
            $arguments[$key] = evaluateFunction($val);
          }
        }
        $argCount = count($arguments);
      }
      else if(!isset($argCount)) {
        $argCount = 0;
      }
      if($argCount >= $f[2] && $argCount <= ($f[2] + $f[3])) {
        $func = $f[0].'_'.$f[1];
        if($f[2] >= 1 || $f[3] >= 1) {
          $return = $func($arguments);
        } else {
          $return = $func();
        }
      }
      break;
    }
  }
  return $return;
}

?>
