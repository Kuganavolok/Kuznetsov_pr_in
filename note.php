<?php
require "dbconnect.php";
print_r($_POST);
$data = $_POST;
$user = R::dispense('note');
$user->tasks = $data['note'];
R::store($user);
header('Location:/Kuznetsov_pr_in/adminScreen.php');
