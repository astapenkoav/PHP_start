<?php
header('Content-Type: text/html; charset=utf-8');

require 'text.php';

$text_paragraph = explode("
", $text);  // делим текст на абзацы по разделителю "перенос строки"

define ('DATA_PER_PAGE', 15); //задаем количество данных, выводимых на одну страницу
$data_count=count($text_paragraph); //определяем количество данных

//Если данных нет, выводим сообщение об их отсутствии
if (!$data_count)
    die("Извините, данные для отображения на данный момент отсутствуют");
$pages_count = ceil($data_count/DATA_PER_PAGE); //количество страниц с округлением до целого в верхнюю сторону

$current_page = isset($_GET['page'])?$_GET['page']:1; //в случае запроса с параметром page он запишется в $current_page
                                                   //иначе если запрошен адрес без параметров, то будет $current_page=1
$current_page=intval($current_page); //Преобразуем полученные данные $current_page к целому чису, а строки (типа try_hack) к 0
//проверим существование страницы, если ее нет, даем сообщение о несуществующей странице
if ($current_page<1 || $current_page>$pages_count) die("Запрошенная Вами страница не найдена");

//получаем данные из массива
//определяем номер первого элемента для вывода из массива
$first_element = ($current_page-1)*DATA_PER_PAGE;
//извлекаем только нужные элементы из массива $x, начиная с вычисленного $first_element в количестве DATA_PER_PAGE
$page_data = array_slice($text_paragraph, $first_element, DATA_PER_PAGE);

//выводим данные на страницу
echo '<h3 style="color:blue">1. Обеспечить вывод текста по страницам по k абзацев на каждой странице.</h3>';
foreach ($page_data as $element)
{
  echo '<div>';
  echo '<p>'.$element.'</p>';
  echo '</div>';
}

//формируем ссылки для перехода по страницам
$str = 3;//количество страниц (+/- к текущей) для ссылок
//Вычисляем начальную и конечную страницы для ссылок
$start = $current_page-$str;
if ($start<1)
    $start = 1;//если номер страницы оказался меньше 1 присваиваем 1
$end = $current_page+$str;
if ($end>$pages_count)
    $end = $pages_count;//если номер страницы оказался больше $pages_count, присваиваем $pages_count

for ($i = $start; $i<=$end; $i++)
{
  if ($i == $current_page)
    echo $i.'&nbsp;&nbsp;';
  else
    echo '<a href="ksr2_page.php?page='.$i.'">'.$i.'</a>&nbsp;&nbsp;';
}