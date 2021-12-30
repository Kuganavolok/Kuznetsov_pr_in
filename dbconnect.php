
<?php
//Podłączenie RedBeanPHP
require "library/rb-mysql.php";
//Połączenie z baza danych
R::setup('mysql:host=localhost;dbname=mybase','root','');
//Sprawdzanie połączenia z bazą danych
if(!R::testConnection()) die('Brak połączenia z bazą danych');
session_start();
