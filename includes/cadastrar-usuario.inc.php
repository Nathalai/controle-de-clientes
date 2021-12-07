<?php

if (isset($_POST["cadastrarUsuarioBtn"]) && $_POST["nomeusuario"] === "admin") {
 
  $nomeusuario = $_POST["novousuario"];
  $senhausuario = $_POST["senhausuario"];
  
  require_once "dbhandler.inc.php";
  require_once "funcoes.inc.php";
  
  cadastrarUsuario($connection, $nomeusuario, $senhausuario);

} else {
  header("location: ../pagina-inicial.php");
  exit();
}

?>