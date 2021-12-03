<section class="menu">
  <a class="nav-link" aria-current="page" href="pagina-inicial.php">Página Inicial</a>
  <a class="nav-link" aria-current="page" href="cadastrar-cliente.php">Cadastrar Cliente</a>
  <a class="nav-link" aria-current="page" href="exibir-cadastrados.php">Exibir Clientes Cadastrados</a>

  <?php
  if ($_SESSION["nomeusuario"] == "admin") {
      echo  '<a class="nav-link" aria-current="page" href="cadastrar-usuario.php">Cadastrar Usuário</a>';
    }
  ?>

  <a class="nav-link" aria-current="page" href="includes/sair.inc.php">Sair</a>
</section>