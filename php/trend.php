|<?php
   /**
    * Trend function is from http://phpsnips.com/snippet.php?id=45 
    */

function trend($list, $type) { 
  if (!is_array($list)) { 
    return false; 
  }
  switch($type) { 
  case 'mean': 
    $count = count($list); 
    $sum = array_sum($list); 
    $total = $sum / $count; 
  break; 
  case 'median': 
    rsort($list); 
    $middle = round(count($list) / 2); 
    $total = $list[$middle-1]; 
  break; 
  case 'mode': 
    $v = array_count_values($list); 
    arsort($v); 
    foreach($v as $k => $v) {
      $total = $k; 
      break; 
    } 
  break; 
  case 'range': 
    sort($list); 
    $small = $list[0]; 
    rsort($list); 
    $large = $list[0]; 
    $total = $large - $small; 
  break; 
  case 'low':
    $total = min($list);
  break;
  case 'high':
    $total = max($list);
  break;
  case 'log10_buckets':
    $values=array(
                  '0 to 10'         => array(), 
                  '11 to 100'       => array(),
                  '101 to 1000'     => array(),
                  '1001 or greater' => array(),
                  );
    rsort($list);
    foreach($list as $number){
      if ($number <= 10){
        array_push($values['0 to 10'], $number);
      } else if ($number <= 100) {
        array_push($values['11 to 100'], $number);
      } else if ($number <= 1000) {
        array_push($values['101 to 1000'], $number);
      } else {
        array_push($values['1001 or greater'], $number);
      }
      $total = sprintf(
                       "<10: %s\n11-100: %s\n101-1000: %s\n>1000: %s",
                       implode(', ', $values['0 to 10']),
                       implode(', ', $values['11 to 100']),
                       implode(', ', $values['101 to 1000']), 
                       implode(', ', $values['1001 or greater'])
                       );
    }
  break;
 }
  return $total; 
}

function trends_for($list) {
  return sprintf(
                 "%.2s\nmean: %.2f\nmedian: %.2f\nmode: %.2f\nrange: %.2f\nlow: %.2f\nhigh: %.2f\n%s", 
                 implode(' ,', $list), 
                 trend($list, 'mean'), 
                 trend($list, 'median'), 
                 trend($list, 'mode'), 
                 trend($list, 'range'),
                 trend($list, 'low'),
                 trend($list, 'high'),
                 trend($list, 'log10_buckets')
                 );
}