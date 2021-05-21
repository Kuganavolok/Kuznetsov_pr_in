<?php
$tasks = $_GET['tasks'];
$performer = $_COOKIE['user'];
$date = $_GET['date'];



$mysql = new mysqli('localhost','root','','todoit');
$mysql->query("INSERT INTO `completed tasks` (`tasks`, `performer`, `date`)
    VALUES('$tasks','$performer','$date')");
$result = $mysql->query("DELETE FROM `tasks` WHERE `user` = '$performer' AND `tasks` = '$tasks' ");
$mysql->close();
print_r($tasks);

header('Location:/Kuznetsov_pr_in/user.php');