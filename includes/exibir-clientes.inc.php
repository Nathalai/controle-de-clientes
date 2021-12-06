<?php
function buscarClientes() {
    if (isset($_SESSION['idusuario'])) {    

        require_once "dbhandler.inc.php";
        require_once "funcoes.inc.php";
    
        $clientesBuscados = buscarClientesDB($connection);
        return $clientesBuscados;
    }
     else {
        header("location: ../pagina-inicial.php?error=sem-id-usuario");
        exit();
    }
}
?>