<?php

// Must require the main.php
set_include_path(dirname(__FILE__)."/../");
require_once('main.php');
require_once('./helpers/calculator.php');

// Register the class with Cerium
registerClass('math', 'Handles basic math functions.');

// Register the function math_with Cerium
registerFunction('math', 'add', 2, 0, 'Add two numbers together.');
registerFunction('math', 'subtract', 2, 0, 'Subtract two numbers.');
registerFunction('math', 'multiply', 2, 0, 'Multiply two numbers together.');
registerFunction('math', 'divide', 2, 0, 'Divide two numbers.');
registerFunction('math', 'isGreater', 2, 0, 'Returns if the first number is greater.');
registerFunction('math', 'isLess', 2, 0, 'Returns if the first number is less.');
registerFunction('math', 'evaluate', 1, 0, 'Evaluate mixed-operator expressions.');

// Basic addition function
function math_add($arguments) {
  $output = intval($arguments[0]) + intval($arguments[1]);
  return $output;
}

// Basic subtraction function
function math_subtract($arguments) {
  $output = intval($arguments[0]) - intval($arguments[1]);
  return $output;
}

// Basic multiplication function
function math_multiply($arguments) {
  $output = intval($arguments[0]) * intval($arguments[1]);
  return $output;
}

// Basic division function
function math_divide($arguments) {
  $output = intval($arguments[0]) / intval($arguments[1]);
  return $output;
}

// Basic integer value comparison
function math_isGreater($arguments) {
  $number1 = intval($arguments[0]);
  $number2 = intval($arguments[1]);
  $allowEqual = false;
  if(isset($arguments[2])) {
    $allowEqual = $arguments[2];
  }
  if($allowEqual) {
    return strval($number1 >= $number2);
  } else {
    return strval($number1 > $number2);
  }
}

// Basic integer value comparison
function math_isLess($arguments) {
  $number1 = intval($arguments[0]);
  $number2 = intval($arguments[1]);
  $allowEqual = false;
  if(isset($arguments[2])) {
    $allowEqual = $arguments[2];
  }
  if($allowEqual) {
    return strval($number1 <= $number2);
  } else {
    return strval($number1 < $number2);
  }
}

// Allows for multi-operator expressions
function math_evaluate($arguments) {
  $expression = $arguments[0];
  $expression = str_replace(' ', '', $expression);
  $calc = new calculator();
  $result = $calc->calculate($expression);
  return $result;
}

?>
