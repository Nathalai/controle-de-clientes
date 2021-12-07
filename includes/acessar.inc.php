<?php

if (isset($_POST["acessarBtn"])) {

    $nomeusuario = $_POST["nomeusuario"];
    $senhausuario = $_POST["senhausuario"];
    $data = $_POST["data"];
    $hora = $_POST["hora"];

    require_once "dbhandler.inc.php";
    require_once "funcoes.inc.php";
    
    acessar($connection, $nomeusuario, $senhausuario);
    cadastrarLog($connection, $nomeusuario, $data, $hora);

    header("location: ../pagina-inicial.php");
    exit();

} else {
    header("location: ../acessar.php");
    exit();
}

?>