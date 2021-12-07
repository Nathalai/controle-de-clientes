<?php

if (isset($_POST["alterarDadosBtn"])) {

    $usuarioId = $_POST["usuarioId"];
    $novoUsername = $_POST["username"];
    $novoEmail = $_POST["email"];

    require_once "dbhandler.inc.php";
    require_once "funcoes.inc.php";
    
    if (usuarioInvalido($novoUsername) !== false) {
        header("location: ../perfil.php?error=usuarioinvalido");
        exit();
    }
    if (emailInvalido($novoEmail) !== false) {
        header("location: ../perfil.php?error=emailinvalido");
        exit();
    }
    if (usuarioExisteAlterarDados($connection, $novoUsername, $novoEmail, $usuarioId) !== false) {
        header("location: ../perfil.php?error=usuariojautilizado");
        exit();
    }

    alterarDados($connection, $usuarioId, $novoUsername, $novoEmail);

} else {
    header("location: ../perfil.php");
    exit();
}

?>