<?php

function printFactorKNumbers($numbers, $k) {
  $frequencies = [];

  foreach ($numbers as $number) {
    if (isset($frequencies[$number])) {
      $frequencies[$number] += 1;
    } else {
      $frequencies[$number] = 1;
    }
  }

  arsort($frequencies);

  $output = array_slice(array_keys($frequencies), 0, $k);

  print_r($output);
}

printFactorKNumbers([1,1,1,2,2,1000, 4, 4, 4, 4, 4], 1)


?>