<?php

//объявляем массив, содержащий структуру меню
//для простоты понимания, объявляем частями
$element_1 = array(
    "link_1"=>"ref1.php",
    "name_1"=>"Элемент 1",
    "inside_1_1"=>array(
        "link_4"=>"ref4.php",
        "name_4"=>"Элемент 4",
        "inside_4_1"=>array(
            "link_9"=>"ref9.php",
            "name_9"=>"Элемент 9"
        ),
        "inside_4_2"=>array(
            "link_10"=>"ref10.php",
            "name_10"=>"Элемент 10"
        )
    ),
    "inside_1_2"=>array(
        "link_5"=>"ref5.php",
        "name_5"=>"Элемент 5"
    )
);
$element_2 = array(
    "link_2"=>"ref2.php",
    "name_2"=>"Элемент 2",
    "inside_2_1"=>array(
        "link_6"=>"ref6.php",
        "name_6"=>"Элемент 6"
    ),
    "inside_2_2"=>array(
        "link_7"=>"ref7.php",
        "name_7"=>"Элемент 7",
        "inside_7_1"=>array(
            "link_11"=>"ref11.php",
            "name_11"=>"Элемент 11"
        ),
        "inside_7_2"=>array(
            "link_12"=>"ref12.php",
            "name_12"=>"Элемент 12"
        )
    )
);
$element_3 = array(
    "link_3"=>"ref3.php",
    "name_3"=>"Элемент 3",
    "inside_3_1"=>array(
        "link_8"=>"ref8.php",
        "name_8"=>"Элемент 8",
        "inside_8_1"=>array(
            "link_13"=>"ref13.php",
            "name_13"=>"Элемент 13"
        ),
        "inside_8_2"=>array(
            "link_14"=>"ref14.php",
            "name_14"=>"Элемент 14"
        ),
        "inside_8_3"=>array(
            "link_15"=>"ref15.php",
            "name_15"=>"Элемент 15"
        )
    )
);

//объединяем элементы в общий массив
$menu = array($element_1, $element_2, $element_3);

// рекурсивная функция для прохода по массиву
function level ($menu)
{
    foreach ($menu as $element) //проходим по первому уровню массива
        {
            if (is_array($element))  //если элемент массива является вложенным массивом, то вызываем функцию рекурсивно
            {
                echo '<ul>';
                level($element);  //рекурсивный вызов функции
                echo '</ul>';
            }   elseif(preg_match("/\b.*\.php\b/", $element)) {  //если элемент не явлется массивом, то проверяем условие седержит ли значение элемента '*.php'
                    echo '<li><a href="'.$element.'">';  //открываем тег li и обворачиваем элемент-ссылку тегами для ссылки
            }   else {
                    echo $element.'</a></li>';  //добавляем элемент-название и закрываем тег списка li
            }
        }
}
level($menu);  //вызываем функцию для нашего массива
