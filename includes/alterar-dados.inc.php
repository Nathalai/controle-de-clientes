<?php

if (isset($_POST["alterarDadosBtn"])) {

  $novotipocliente = $_POST["tipocliente"];

  $novoddd = $_POST["ddd"];
  $novofone = $_POST["fone"];
  $novotipotelefone = $_POST["tipotelefone"];
  
  $novologradouro = $_POST["logradouro"];
  $novonumero = $_POST["numero"];
  $novocomplemento = $_POST["complemento"];
  $novobairro = $_POST["bairro"];
  $novocep = $_POST["cep"];
  $novocidade = $_POST["cidade"];
  $novouf = $_POST["uf"];

  $idcliente = $_POST["idcliente"];

  require_once "dbhandler.inc.php";
  require_once "funcoes.inc.php";
  
  alterarDados($connection, $novotipocliente, $novoddd, $novofone, $novotipotelefone, $novologradouro, $novonumero, $novocomplemento, $novobairro, $novocep, $novocidade, $novouf, $idcliente);
 
  header("location: ../ver-detalhes.php?error=none");
  exit();
 } else {
  header("location: ../ver-detalhes.php");
  exit();
} 

?>