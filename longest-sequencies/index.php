<?php

function findLongestConsecutiveSequence($numbers) {
  $count = 1;
  $output = 1;

  foreach ($numbers as $number) {
    $nextValue = $number + 1;

    if (in_array($nextValue, $numbers)) {
      $count = 1;
      do {
        $count += 1;
        $nextValue += 1;
      } while (in_array($nextValue, $numbers));

      $output = max($output, $count);
    } else {
      $count = 1;
    }
  }

  echo $output;
}

findLongestConsecutiveSequence([100, 4, 200, 1, 3, 2])

?>