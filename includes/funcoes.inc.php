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
  }
}

function cadastrarLog($connection, $nomeusuario, $data, $hora) {
  $usuarioExiste = usuarioExiste($connection, $nomeusuario);

  if ($usuarioExiste === false) {
    header("location: ../acessar.php?error=usuario-nao-cadastrado");
    exit();
  }

  $descricao = "Data do log: " . $data . " às " . $hora;

  $sql = "INSERT INTO logs_acesso (descricao, usuarios_idusuario) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../acessar.php?error=stmt-falhou");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "ss", $descricao, $usuarioExiste["idusuario"]);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
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

function buscarDadosCliente($connection, $idcliente) {
  $sql = "SELECT c.idcliente, c.nomecliente, c.cpfcliente, c.tipocliente, c.dtnasccliente, 
  t.ddd, t.fone, t.tipotelefone, 
  e.logradouro,  e.numero, e.complemento, e.bairro, e.cep, e.cidade, e.uf 
  FROM clientes AS c 
  INNER JOIN telefones AS t ON t.clientes_idcliente = c.idcliente 
  INNER JOIN enderecos AS e ON e.clientes_idcliente = c.idcliente 
  WHERE c.idcliente = ?;";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../acessar.php?error=stmt-falhou");
    exit();
  }
  mysqli_stmt_bind_param($stmt, "s", $idcliente);
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

function passarDadosClienteParaSessao($connection, $idcliente) {
  $dadosCliente = buscarDadosCliente($connection, $idcliente);

  $dataNascDB = $dadosCliente['dtnasccliente'];
  $dataNascConvertida = date("d/m/Y", strtotime($dataNascDB));

  session_start();
  $_SESSION["idcliente"] = $dadosCliente["idcliente"];
  $_SESSION["nomecliente"] = $dadosCliente["nomecliente"];
  $_SESSION["cpfcliente"] = $dadosCliente["cpfcliente"];
  $_SESSION["tipocliente"] = $dadosCliente['tipocliente'];
  $_SESSION["dtnasccliente"] = $dataNascConvertida;
  $_SESSION["ddd"] = $dadosCliente["ddd"];
  $_SESSION["fone"] = $dadosCliente["fone"];
  $_SESSION["tipotelefone"] = $dadosCliente["tipotelefone"];
  $_SESSION["logradouro"] = $dadosCliente["logradouro"];
  $_SESSION["numero"] = $dadosCliente["numero"];
  $_SESSION["complemento"] = $dadosCliente["complemento"];
  $_SESSION["bairro"] = $dadosCliente["bairro"];
  $_SESSION["cep"] = $dadosCliente["cep"];
  $_SESSION["cidade"] = $dadosCliente["cidade"];
  $_SESSION["uf"] = $dadosCliente["uf"];
  header("location: ../ver-detalhes.php?");
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

function alterarDadosPessoais($connection, $novotipocliente, $idcliente) {
  $sql = "UPDATE clientes SET tipocliente = ? WHERE idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../ver-detalhes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $novotipocliente, $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION["tipocliente"] = $novotipocliente;    
}

function alterarTelefone($connection, $novoddd, $novofone, $novotipotelefone, $idcliente) {
  $sql = "UPDATE telefones SET ddd = ?, fone = ?, tipotelefone = ? WHERE clientes_idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../ver-detalhes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $novoddd, $novofone, $novotipotelefone, $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION["ddd"] = $novoddd;
    $_SESSION["fone"] = $novofone;
    $_SESSION["tipotelefone"] = $novotipotelefone;
}

function alterarEndereco($connection, $novologradouro, $novonumero, $novocomplemento, $novobairro, $novocep, $novocidade, $novouf, $idcliente) {
  $sql = "UPDATE enderecos SET logradouro = ?, numero = ?, complemento = ?, bairro = ?, cep = ?, cidade = ?, uf = ? WHERE clientes_idcliente = ?;";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../ver-detalhes.php?error=stmt-falhou");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssssssss", $novologradouro, $novonumero, $novocomplemento, $novobairro, $novocep, $novocidade, $novouf, $idcliente);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    session_start();
    $_SESSION["logradouro"] = $novologradouro;
    $_SESSION["numero"] = $novonumero;
    $_SESSION["complemento"] = $novocomplemento;
    $_SESSION["bairro"] = $novobairro;
    $_SESSION["cep"] = $novocep;
    $_SESSION["cidade"] = $novocidade;
    $_SESSION["uf"] = $novouf;
}

function alterarDados($connection, $novotipocliente, $novoddd, $novofone, $novotipotelefone, $novologradouro, $novonumero, $novocomplemento, $novobairro, $novocep, $novocidade, $novouf, $idcliente) {  
  alterarDadosPessoais($connection, $novotipocliente, $idcliente);
  alterarTelefone($connection, $novoddd, $novofone, $novotipotelefone, $idcliente);
  alterarEndereco($connection, $novologradouro, $novonumero, $novocomplemento, $novobairro, $novocep, $novocidade, $novouf, $idcliente);
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