<?php
function excluirCliente() {
    if (isset($_GET['cliente-id'])) {
        require_once "dbhandler.inc.php";
        require_once "funcoes.inc.php";
    
        $idcliente = $_GET['cliente-id'];

        excluirClienteDB($connection, $idcliente);

        header("location: ./exibir-clientes.php?error=none");
        exit();
    } else {
        header("location: ./exibir-clientes.php?error=sem-cliente-id");
        exit();
    }
}
?>