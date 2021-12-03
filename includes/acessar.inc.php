<?php

if (isset($_POST["acessarBtn"])) {

    $nomeusuario = $_POST["nomeusuario"];
    $senhausuario = $_POST["senhausuario"];

    require_once "dbhandler.inc.php";
    require_once "funcoes.inc.php";

    acessar($connection, $nomeusuario, $senhausuario);

} else {
    header("location: ../acessar.php");
    exit();
}

?>