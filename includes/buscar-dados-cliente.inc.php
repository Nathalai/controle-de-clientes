<?php

if (isset($_GET["cliente-id"])) {

    $idcliente = $_GET["cliente-id"];

    require_once "dbhandler.inc.php";
    require_once "funcoes.inc.php";

    passarDadosClienteParaSessao($connection, $idcliente);    

} else {
    header("location: ../exibir-clientes.php?error=sem-id-cliente");
    exit();
}

?>