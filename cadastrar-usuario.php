<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Cadastrar Usuário</title>
    <link rel="shortcut icon" href="https://www.rpinfo.com.br/views/geral/img/favicon.ico" type="image/x-icon">
    <link href="style/main.css" rel="stylesheet"/>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
    <?php
        include_once "header.php";
        
    ?>

    <section class="conteudo">
      <?php        
        include_once "menu.php";
      ?>

      <section class="formulario">
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "usuario-invalido") {
              echo "<p class='error'>Usuário inválido! Escolha um nome de usuário que utilize apenas letras e/ou números.</p>";
            }
            else if ($_GET["error"] == "usuario-ja-utilizado") {
              echo "<p class='error'>Este nome de usuário já foi utilizado!</p>";
            }
            else if ($_GET["error"] == "stmt-falhou") {
              echo "<p class='error'>Algo deu errado, tente novamente!</p>";
            }
            else if ($_GET["error"] == "none") {
              echo "<h5>O novo usuário foi cadastrado com sucesso!</h5>";
            }
          }
        ?>

        <h4><b>CADASTRAR USUÁRIO</b></h4>

        <form class="was-validated" action="includes/cadastrar-usuario.inc.php" method="post" style="width: 40%; margin-top: 16px;">           
          <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="nomeusuario" class="form-control" placeholder="Nome do usuário" required>
          </div>
            <label class="form-label">Senha</label>
            <div class="mb-3">
              <input type="password" name="senhausuario" class="form-control" placeholder="Senha do usuário" required>
            </div>
          </div>
          <div class="submit">
            <button type="submit" name="cadastrarUsuarioBtn" class="submitBt">CADASTRAR</button>
          </div>
        </form>
      </section>
    </section>
  </body>
</html>