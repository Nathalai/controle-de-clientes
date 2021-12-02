<?php

$serverName = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "controledeclientes";

$connection = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName);

if (!$connection) {
  die("A conexão falhou:" . mysqli_connect_error());
}

?>