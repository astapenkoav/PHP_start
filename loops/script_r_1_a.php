<?php
header('Content-Type: text/html; charset= utf-8');

echo '<table border="1 solid" width="30%"><tr><td align="center">Номер п/п</td><td align="center">Число</td></tr>'; //Открываем таблицу и создаем шапку
for ($i=1; $i<=100; $i++) {
    if ($i%2!=0) {
        echo '<tr bgcolor="#d3d3d3">'; //Проверяем условия четности строки и меняем цвет фона
    } else {
        echo '<tr>';
    }
    echo '<td align="center">'. $i . '</td>'; //Вставляем порядковый номер в первый столбец
    echo '<td align="center">'. mt_rand(1,100) . '</td>'; //Вставляем случайное число во второй столбец
    echo '</tr>'; //Закрываем строку
}
echo '</table>'; //Закрываем таблицу