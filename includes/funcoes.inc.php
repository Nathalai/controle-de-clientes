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

function cadastrarCliente($connection, $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $idusuario) {
    $sql = "INSERT INTO clientes (nomecliente, cpfcliente, tipocliente, dtnasccliente, usuarios_idusuario) VALUES (?, ?, ? ,?, ?);";
    $stmt = mysqli_stmt_init($connection);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
      header("location: ../cadastrar-cliente.php?error=stmt-falhou");
      exit();
    }   
    
    mysqli_stmt_bind_param($stmt, "sssss", $nomecliente, $cpfcliente, $tipocliente, $dtnasccliente, $idusuario);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../cadastrar-cliente.php?error=none");
    exit();
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