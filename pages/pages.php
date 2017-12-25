<?php

define('MESSAGE_PER_PAGE', 9);

function controller()
{
    if ($error = model($data, $number, $pagesCount))
    {
        var_dump($error);
    }
    else
    {
        view($data, $number, $pagesCount);
    }
}
function model(&$data, &$number, &$pagesCount)
{
    require "pages/text.php";  //подключаем файл с текстом
    $data = explode(PHP_EOL, $text);  //делим текст на абзацы

    $number = empty($_GET['number'])?1:intval($_GET['number']);
    $pagesCount = getPagesCount($data);
    if (!checkNumber($number, $pagesCount))
        return 'Страница не существует';
    $data = getPageData($data, $number);
    return '';
}
function getPagesCount($data)
{
    return ceil(count($data)/MESSAGE_PER_PAGE);
}
function checkNumber($number, $pagesCount)
{
    return ($number>0 && $number<=$pagesCount);
}
function getPageData($data, $number)
{
    return array_slice($data, ($number-1)*MESSAGE_PER_PAGE,MESSAGE_PER_PAGE);
}

function view($data, $number, $pagesCount)
{
    viewHeader();
    viewData($data);
    viewPagination($number, $pagesCount);
    viewFooter();
}
function viewHeader()
{

}
function viewData($data)
{
    echo '<div class="container">';
    foreach ($data as $item)
    {
        echo '<p>';
        firstLetterBold($item);
        echo '</p>';
        countWords($item);
        echo '<br>';
    }
    echo '</div>';
}
function viewPagination($number, $pagesCount)
{
    echo '<div class="container col-lg-4">';
    for ($i=1; $i<=$pagesCount; $i++)
    {
        if ($i!=$number)
        {
            echo "<a href=\"index.php?number=$i\">$i</a> ";
        }
        else
        {
            echo $i.' ';
        }
    }
    echo '</div>';
}
function viewFooter()
{

}
function countWords($paragraph)
{
    $abc = chr(168).chr(184);
    for ( $i = 192; $i < 256; $i++ )
    {
        $abc .= chr($i);
    }
    $char=iconv( 'cp1251', 'utf-8', $abc);
    echo '<span style="font-style: italic">';
    echo 'Количество символов в азбаце: '.mb_strlen(strip_tags($paragraph), 'utf-8').'; ';  // считаем и выводим количество символов в абзаце
    echo 'Количество слов в абзаце: '.str_word_count(strip_tags($paragraph),0,$char);  // считаем и выводим количество слов в абзаце
    echo '</span><br>';
}
function firstLetterBold ($paragraph)
{
    $pattern = array('/HTML|PHP|ASP(.NET)?|JAVA/i', '/(^|[.!?]\s+)(<.*>)?([0-9,A-Z,a-z,А-Я,а-я,Ёё])/Uu');
    $replace = array('<span style="color:blue;">$0</span>','$1$2<b>$3</b>');
    echo $paragraph = preg_replace($pattern, $replace, $paragraph);
}
controller();
