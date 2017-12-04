<?php

$rows=15; //Задаем количество строк
$cols=4; //Задаем количество столбцов
$n=255; //Задаем количество значений цвета из палитры RGB


echo '<table border="1px" width="30%">';
echo '<tr><th align="center">Номер п/п</th><th align="center" colspan="'.$cols.'">Число</th></tr>'; //Создаем шапку таблицы, делаем количество объединенных ячеек равным количеству столбцов, начиная со второго
for($tr=1; $tr<=$rows; $tr++) //Задаем параметры цикла: количество строк равно значению переменной $rows
{
    if($tr<=$rows/2) //Задаем условие для смены текста с черного на белый в середине таблицы
    {
        echo '<tr style="background-color: rgb('.round($n-($n/$rows*$tr)).','.round($n-($n/$rows*$tr)).','.round($n-($n/$rows*$tr)).')">';
    }else
    {
        echo '<tr style="background-color: rgb('.round($n-($n/$rows*$tr)).','.round($n-($n/$rows*$tr)).','.round($n-($n/$rows*$tr)).'); color: white">';
    }
    echo '<td width="5%" align="center">'.$tr.'</td>'; //Выводим циклом первый столбец
    for ($td = 1; $td <= $cols; $td++) //Задаем параметры цикла для заполнения остальных столбцов
    {
        echo '<td align="center">'.mt_rand(1, 100).'</td>'; //Выводим в ячейках второго и последующего столбцов случайные числа от 1 до 100
    }
    echo '</tr>';
}
echo '</table><br>'; //Закрываем нашу таблицу