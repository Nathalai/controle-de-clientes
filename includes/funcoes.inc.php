<?php
function cadastrarUsuario($connection, $nomeusuario, $senhausuario) {
  $sql = "INSERT INTO usuarios (nomeusuario, senhausuario) VALUES (?, ?);";
  $stmt = mysqli_stmt_init($connection);
  if (!mysqli_stmt_prepare($stmt, $sql)) {
    header("location: ../cadastrar-admin.php?error=stmtfalhou");
    exit();
  }

  $hashedSenha = password_hash($senha, PASSWORD_DEFAULT);
  
  mysqli_stmt_bind_param($stmt, "ss", $nomeusuario, $hashedSenha);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_close($stmt);
  header("location: ../cadastrar-admin.php?error=none");
  exit();
}
?>