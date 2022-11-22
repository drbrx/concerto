<?php
session_start();

$_SESSION['address'] = "127.0.0.1";
$_SESSION['user'] = "root";
$_SESSION['pwd'] = "";
$_SESSION['db'] = "concertobosio";


$db = mysqli_connect($_SESSION['address'], $_SESSION['user'], $_SESSION['pwd'], $_SESSION['db']) or die("Error 418: I'm a teapot! I don't make coffee and consequently didn't connect to the db!");
