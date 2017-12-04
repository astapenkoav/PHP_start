<?php
header('Content-Type: text/html; charset= utf-8');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
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
        <?php include 'script_1.php'; ?>
    <p>Задание №2_а</p>
        <?php include 'script_2_a.php'; ?>
    <p>Задание №2_б</p>
        <?php include 'script_2_b.php'; ?>
    <p>Задание №3</p>
        <?php include 'script_3.php'; ?>
    <p>Задание №4</p>
        <?php include 'script_r_1_a.php'; ?>
    <p>Задание №5</p>
        <?php include 'script_r_1_b.php'; ?>
</body>
</html>
