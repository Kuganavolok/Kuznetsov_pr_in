<?php //usunięcie sesji użytkownika, gdy jest zalogowany
require __DIR__ . '/head.php';
require "dbconnect.php";
unset($_SESSION['logged_user']);
header('Location:index.php');
require __DIR__ . '/foot.php';

