<?php
header('Content-Type: text/html; charset=utf-8');

$s = 'Zend Framework 2 is an open source framework for developing web applications and services using PHP 5.3+. Zend Framework 2 uses 100% object-oriented code and utilises most of the new features of PHP 5.3, namely namespaces, late static binding, lambda functions and closures.
Zend Framework 2 evolved from Zend Framework 1, a successful PHP framework with over 15 million downloads.
The component structure of Zend Framework 2 is unique; each component is designed with few dependencies on other components. ZF2 follows the SOLID object oriented design principle. This loosely coupled architecture allows developers to use whichever components they want. We call this a "use-at-will" design. We support Pyrus and Composer as installation and dependency tracking mechanisms for the framework as a whole and for each component, further enhancing this design.
We use PHPUnit to test our code and Travis CI as a Continuous Integration service.
While they can be used separately, Zend Framework 2 components in the standard library form a powerful and extensible web application framework when combined. Also, it offers a robust, high performance MVC implementation, a database abstraction that is simple to use, and a forms component that implements HTML5 form rendering, validation, and filtering so that developers can consolidate all of these operations using one easy-to-use, object oriented interface. Other components, such as Zend\Authentication and Zend\Permissions\Acl, provide user authentication and authorization against all common credential stores.';

//считаем сколько раз слово Zend повторяется в тексте
echo 'Слово <span style="font-weight: bold">Zend</span> в тексте встречается: '.substr_count($s, 'Zend').' раз<br>';
//делим текст на абзацы по разделителю "\r\n" и помещаем абзацы в массив
$s_para = explode("\r\n", $s);
//считаем количество абзацев в тексте и выводим
echo 'Количество абзацев в тексте: '.count($s_para).'<br>';
//считаем количество символов в тексте и выводим
echo 'Количество символов с пробелами: '.strlen($s).'<br>';
//убираем из текста пробелы
$s_no_spaces = str_replace(' ', '', $s);
//считаем количество символов в тексте без пробелов и выводим
echo 'Количество символов без пробелов: '.strlen($s_no_spaces).'<br>';
//разбиваем текст на слова с помощью регулярного выражения и помещаем слова в массив
$s_words = preg_split("/[\s,-\\/ \\\\]+/", $s);
//считаем количество слов, которое равно количеству элементов массива
echo 'Количество слов: '.count($s_words).'<br>';

$max = $s_words[0]; //считаем первый элемент массива максимальным
for ($i=0; $i<count($s_words); $i++) //задаем параметры цикла для прохода по массиву со словами
{
    if(strlen($max) < strlen($s_words[$i])) //сравниваем длину текущего слова со следующим
        $max = $s_words[$i]; //если находим слово длиннее, то присваеиваем переменной $max его значение
}
echo 'Самое длинное слово: '.$max.'<br>';

$simbols = str_split($s); //разбиваем текст на массив из символов
asort($simbols); //сортируем массив по возрастанию
$num_of_simbols = array_count_values($simbols); //считаем количество повторений каждого символа
echo '<pre>';
print_r($num_of_simbols);
echo '</pre>';