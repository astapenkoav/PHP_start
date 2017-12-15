<?php

print "<p style='font-weight: bold'>Массив до сортировки: </p>";
$arr = array("A1",
             "1"=>array(
                     "ax",
                     "11.37",
                     "2"=> array(
                             "z",
                             "x",
                             "c"
                     ),
                     "aaa",
                     "bbb"
             ),
             "A2",
             "3"=> array(
                     10,
                     20,
                     "2"=> array(
                             "36.6",
                             "y",
                             "12.5"
                     ),
                     15
             ),
             "A22",
             "A3",
             "A0",
             "7"=> array(
                     "eee",
                     "aaa",
                     12,
                     "25.3"
             ),
             5,
             1,
             3
);

print "<pre>";
print_r($arr);
print "</pre>";

print "<p style='font-weight: bold'>Массив после сортировки: </p>";

array_multisort($arr['1']['2']);
array_multisort($arr['3']['2']);
array_multisort($arr['1']);
array_multisort($arr['3']);
array_multisort($arr['7']);
array_multisort($arr, SORT_STRING);

print "<pre>";
print_r($arr);
print "</pre>";

function array_del ($b) {
    if (!is_numeric($b)) {
        $b = null;
    } else {
        return 0;
    }
}

print "<p style='font-weight: bold'>Массив после чистки: </p>";
array_walk_recursive($arr, 'array_del');

print "<pre>";
print_r($arr);
print "</pre>";