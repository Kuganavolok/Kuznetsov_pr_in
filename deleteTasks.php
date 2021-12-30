<?php
$data = $_POST['del'];
$mysql = new mysqli('localhost', 'root', '', 'mybase');
$result = $mysql->query("DELETE FROM `note` WHERE `tasks` = '$data'");
$result = $mysql->query("DELETE FROM `step` WHERE `tasks` = '$data' AND `step` = 'do wykonywania'");
$mysql->close();
header('Location:/Kuznetsov_pr_in/adminScreen.php');