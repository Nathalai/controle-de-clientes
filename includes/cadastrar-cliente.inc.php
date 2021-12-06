<?php

if (isset($_POST["cadastrarClienteBtn"]) && isset($_POST["idusuario"])) {  

  $nomecliente = $_POST["nomecliente"];
  $cpfcliente = $_POST["cpfcliente"];
  $tipocliente = $_POST["tipocliente"];
  $dtnasccliente = $_POST["dtnasccliente"];

  $ddd = $_POST["ddd"];
  $fone = $_POST["fone"];
  $tipotelefone = $_POST["tipotelefone"];
  
  $logradouro = $_POST["logradouro"];
  $numero = $_POST["numero"];
  $complemento = $_POST["complemento"];
  $bairro = $_POST["bairro"];
  $cep = $_POST["cep"];
  $cidade = $_POST["cidade"];
  $uf = $_POST["uf"];

  $idusuario = $_POST["idusuario"];

  require_once "dbhandler.inc.php";
  require_once "funcoes.inc.php";
  
  if (clienteExiste($connection, $cpfcliente) !== false) {
    header("location: ../cadastrar-cliente.php?error=cliente-ja-cadastrado");
    exit();
  }
  criarCliente($connection, $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $ddd, $fone, $tipotelefone, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $idusuario);
} else {
  header("location: ../acessar.php");
  exit();
}

?>