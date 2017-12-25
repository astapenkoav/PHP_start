<?php

//объявляем массив
$arr = array("A1", 1=>array("ax", 11.37, 2=> array("z", "x", "c"), "aaa", "bbb"),
             "A2", "3"=> array(10, 20 , 2=> array(36.6, "y", 12.5), 15),
             "A22", "A3",
             "A0", "7"=> array("eee", "aaa", 12, 25.3),
             5, 1, 3  );

// функция сортировки
function multiSort (&$array)
{
    if (is_array($array)) //если элемент является массивом,
    array_multisort($array); //то применяем к нему сортировку
    foreach ($array as &$a) //задаем параметры цикла для вложенных элементов
    {
        if (is_array($a)) { //если вложенный элемент является массивом,
            multiSort($a); //то применяем рекурсивно нашу функцию сортировки к этому массиву
        }
    }
}

// фуфнкция удаления нецелочисленных элементов
function unsetFloat (&$array)
{
    $unset_index = array(); //объявляем пустой массив
    foreach ($array as $i=>&$a) { //задаем параметры цикла для вложенных элементов
        if (is_array($a)) { //если вложенный элемент является массивом,
            unsetFloat($a);  //то применяем рекурсивно нашу функцию к этому массиву
        } elseif (is_float($a)){ //если элемент не является массивом,
            $unset_index[] = $i; //то записываем индекс этого элемента в наш пустой массив
        }
    }
    foreach ($unset_index as $index){ //задаем параметры цикла для массива, содержащего индексы нецелочисленных элементов
        unset($array[$index]); //удаляем эти элементы
    }
}

/*
 * функция одновременной сортировки и очистки
function unsetFloat_2 (&$array)
{
    array_multisort($array);

    $unset_index = array();
    foreach ($array as $i=>&$a) {
        if (is_array($a)) {
            unsetFloat_2($a);
        }elseif (is_float($a)){
            $unset_index[] = $i;
        }
    }

    foreach ($unset_index as $index){
        unset($array[$index]);
    }
}*/

//вывод массивов
print "<pre>";
print '<p style="font-weight: bold">Массив до сортировки</p>';
print_r($arr); //вывод начального массива
multiSort($arr); //применяем функцию сортировки
print '<p style="font-weight: bold">Массив после сортировки: </p>';
print_r($arr); //выводим массив после сортировки
print "</pre>";
unsetFloat($arr); //применяем функцию удаления нецелочисленных элементов
print "<pre>";
print '<p style="font-weight: bold">Массив после очистки: </p>';
print_r($arr); //выводим массив после удаления нецелочисленных элементов
print "</pre>";
