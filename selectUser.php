<?php
require "dbconnect.php";
$data = $_POST;
$user = R::dispense('step');
$user->tasks = $data['task'];
$user->performer = $data['userName'];
$user->date = $data['date'];
$user->step = 'do wykonywania';
R::store($user);
header('Location:/Kuznetsov_pr_in/adminScreen.php');


