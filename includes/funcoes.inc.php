<?php
function usuarioExiste($connection, $nomeusuario) {
  $sql = "SELECT * FROM usuarios WHERE nomeusuario = ?;";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../acessar.php?error=stmt-falhou");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $nomeusuario);
  mysqli_stmt_execute($stmt);

  $dadosResultantes = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($dadosResultantes)) {
    return $row;
  } else {
    $result = false;
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function acessar($connection, $nomeusuario, $senhausuario) {
  $usuarioExiste = usuarioExiste($connection, $nomeusuario);


  if ($usuarioExiste === false) {
    header("location: ../acessar.php?error=usuario-nao-cadastrado");
    exit();
  }

  $dbSenha = $usuarioExiste["senhausuario"];
    header("location: ../acessar.php?" . $nomeusuario . $senhausuario . $dbSenha);

  //$hashedSenha = $usuarioExiste["senhausuario"];
  //$checarSenha = password_verify($senhausuario, $hashedSenha);

  //if ($checarSenha === false) {
  if ($senhausuario !== $dbSenha) {
    //$newhashedpass = password_hash($senhausuario, PASSWORD_BCRYPT);
    header("location: ../acessar.php?error=senha-incorreta");
    exit();
  //} else if ($checarSenha === true) {
  } else if ($senhausuario === $dbSenha) {
    session_start();
    $_SESSION["idusuario"] = $usuarioExiste["idusuario"];
    $_SESSION["nomeusuario"] = $usuarioExiste["nomeusuario"];
    header("location: ../pagina-inicial.php");
  }
}
 
function clienteExiste($connection, $cpfcliente) {
    $sql = "SELECT * FROM clientes WHERE cpfcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../cadastrar-cliente.php?error=stmtfalhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $cpfcliente);
    mysqli_stmt_execute($stmt);

    $dadosResultantes = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($dadosResultantes)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function cadastrarDadosPessoais($connection, $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $idusuario) {
  $sql = "INSERT INTO clientes (nomecliente, cpfcliente, tipocliente, dtnasccliente, usuarios_idusuario) VALUES (?, ?, ? ,?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-cliente.php?error=stmt-falhou");
    exit();
  }   
  
  mysqli_stmt_bind_param($stmt, "sssss", $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $idusuario);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function obterIdClientePeloCpf($connection, $cpfcliente) {
  $sql = "SELECT idcliente FROM clientes WHERE cpfcliente = $cpfcliente;";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-cliente.php?error=stmt-falhou");
    exit();
  }  
  mysqli_stmt_execute($stmt);

  $dadosResultantes = mysqli_stmt_get_result($stmt);

  if ($row = mysqli_fetch_assoc($dadosResultantes)) {
    return $row;
  } else {
    $result = mysqli_stmt_error($stmt);
    return $result;
  }

  mysqli_stmt_close($stmt);
}

function cadastrarTelefone($connection, $ddd, $fone, $tipotelefone, $clientes_idcliente, $idusuario) {
  $sql = "INSERT INTO telefones (ddd, fone, tipotelefone, clientes_idcliente, usuarios_idusuario) VALUES (?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-cliente.php?error=stmt-falhou");
    exit();
  }   
  
  mysqli_stmt_bind_param($stmt, "sssss", $ddd, $fone, $tipotelefone, $clientes_idcliente, $idusuario);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);  
}

function cadastrarEndereco($connection, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $clientes_idcliente, $idusuario) {
  $sql = "INSERT INTO enderecos (logradouro, numero, complemento, bairro, cep, cidade, uf, clientes_idcliente, usuarios_idusuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-cliente.php?error=stmt-falhou");
    exit();
  }   
  
  mysqli_stmt_bind_param($stmt, "sssssssss", $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $clientes_idcliente, $idusuario);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
}

function criarCliente($connection, $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $ddd, $fone, $tipotelefone, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $idusuario) {
  cadastrarDadosPessoais($connection, $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $idusuario);
  $clienteCadastrado = obterIdClientePeloCpf($connection, $cpfcliente);
  $clientes_idcliente = $clienteCadastrado['idcliente'];
  cadastrarTelefone($connection, $ddd, $fone, $tipotelefone, $clientes_idcliente, $idusuario);
  cadastrarEndereco($connection, $logradouro, $numero, $complemento, $bairro, $cep, $cidade, $uf, $clientes_idcliente, $idusuario);
  header("location: ../cadastrar-cliente.php?error=none");
  exit();
}

function buscarClientesDB($connection) {    
  $sql = "SELECT c.idcliente, c.nomecliente, c.cpfcliente, c.tipocliente, c.dtnasccliente, u.nomeusuario FROM clientes AS c INNER JOIN usuarios AS u ON u.idusuario = c.usuarios_idusuario;";
  $result = mysqli_query($connection, $sql);

  if (mysqli_num_rows($result) > 0) {
  $itens = array();    
    while($row = mysqli_fetch_assoc($result)) {
      $tipocliente;
      if ($row['tipocliente'] === "S") {
        $tipocliente = "Silver";
      } else if ($row['tipocliente'] === "G") {
        $tipocliente = "Gold";
      } else if ($row['tipocliente'] === "P") {
        $tipocliente = "Platinum";
      }

      $dataNascDB = $row['dtnasccliente'];
      $dataNascConvertida = date("d/m/Y", strtotime($dataNascDB));

      $item = array('ID' => $row["idcliente"], 'Nome' => $row["nomecliente"], 'CPF'=> $row['cpfcliente'], 'Tipo de Cliente'=> $tipocliente, 'Data de Nascimento'=> $dataNascConvertida, 'Cadastrado(a) por:'=> $row['nomeusuario']);
      array_push($itens, $item);
    }

    return $itens;
  }

  mysqli_close($connection);
}

function excluirDadosPessoais($connection, $idcliente) {
  $sql = "DELETE FROM clientes WHERE idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../exibir-clientes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirTelefone($connection, $idcliente) {
  $sql = "DELETE FROM telefones WHERE clientes_idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../exibir-clientes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirEndereco($connection, $idcliente) {
  $sql = "DELETE FROM enderecos WHERE clientes_idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../exibir-clientes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function excluirClienteDB($connection, $idcliente) {  
  excluirDadosPessoais($connection, $idcliente);
  excluirTelefone($connection, $idcliente);
  excluirEndereco($connection, $idcliente);
}

function cadastrarUsuario($connection, $nomeusuario, $senhausuario) {
  $sql = "INSERT INTO usuarios (nomeusuario, senhausuario) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-admin.php?error=stmtfalhou");
    exit();
  }

  //$hashedSenha = password_hash($senha, PASSWORD_BCRYPT);
  
  mysqli_stmt_bind_param($stmt, "ss", $nomeusuario, $senhausuario);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../cadastrar-usuario.php?error=none");
  exit();
}

?>