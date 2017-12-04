<?php
header('Content-Type: text/html; charset= utf-8');
?>

<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <title>Циклы</title>
</head>
<body>
    <p>Задание №1</p>
    <table class="table1">
        <tr>
            <td class="f-line">Число</td>
            <td class="f-line">Квадрат числа</td>
            <td class="f-line">Куб числа</td>
        </tr>

        <?php include 'script_1.php'; ?>

    </table>
    <br>
    <p>Задание №2_а</p>
    <table class="table2">

        <?php include 'script_2_a.php'; ?>

    </table>
    <br>
    <p>Задание №2_б</p>
    <table class="table2">

        <?php include 'script_2_b.php'; ?>

    </table>
    <br>
    <p>Задание №3</p>

        <?php include 'script_3.php'; ?>

</body>
</html>
