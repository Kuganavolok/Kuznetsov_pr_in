<?php

$task = $_GET['task'];
$UserName = $_GET['UserName'];
$date = $_GET['date'];


if(mb_strlen($task) == 0 ){
    echo "empty in tasks";
    exit();}

$mysql = @new Mysqli('localhost', 'root', '', 'todoit');
if ($mysql->connect_errno) exit('connect error');
$mysql->query("INSERT INTO `tasks` (`tasks`, `user`,`date`)
    VALUES('$task','$UserName','$date')");
$mysql->close();





header('Location:/Kuznetsov_pr_in/adminScreen.php');


