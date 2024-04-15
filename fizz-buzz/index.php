<?php

function printNumbers($number) {
  if (!is_integer($number) || $number <= 0) {
    return throw new Exception('Number is not valid.');
  }

  $output = [];
  for ($index = 1; $index <= $number; $index++) {
    $currentValue = '';

    if ($index % 3 === 0) {
      $currentValue = 'Fizz';
    }

    if ($index % 5 === 0) {
      $currentValue .= 'Buzz';
    }


    $currentValue = $currentValue === '' ? (string) $index : $currentValue;

    array_push($output, $currentValue);
  }

  print_r($output);
}

printNumbers(15);

?>