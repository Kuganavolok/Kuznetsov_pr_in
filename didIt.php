<?php
require "dbconnect.php";
$data = $_POST;
if(trim($data['tasks']) != '') {
    $user = R::dispense('step');
    $user->tasks = $data['tasks'];
    $user->performer = $_SESSION['logged_user']->name;
    $user->date = $data['date'];
    $user->step = $data['step'];
    $user->note = $data['note'];
    R::store($user);


    $tasks = $_POST['tasks'];
    $performer = $_SESSION['logged_user']->name;
    $step = $_POST['step'];

    if ($step == 'wykonane') {
        $mysql = new mysqli('localhost', 'root', '', 'mybase');
        $result = $mysql->query("DELETE FROM `step` WHERE `performer` = '$performer' AND `tasks` = '$tasks' AND `step` = 'do wykonywania' ");
        $mysql->close();
    }
    if ($step == 'w trakcie') {
        $mysql = new mysqli('localhost', 'root', '', 'mybase');
        $result = $mysql->query("DELETE FROM `step` WHERE `performer` = '$performer' AND `tasks` = '$tasks' AND `step` = 'do wykonywania' ");
        $mysql->close();
    }
    if ($step == 'wykonane') {
        $mysql = new mysqli('localhost', 'root', '', 'mybase');
        $result = $mysql->query("DELETE FROM `step` WHERE `performer` = '$performer' AND `tasks` = '$tasks' AND `step` = 'w trakcie' ");
        $mysql->close();
    }
}

header('Location:/Kuznetsov_pr_in/user.php');
