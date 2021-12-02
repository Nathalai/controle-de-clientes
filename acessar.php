<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8" />
        <title>Acessar</title>
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

      <?php
        if (isset($_GET["error"])) {
          if ($_GET["error"] == "usuario-nao-cadastrado") {
            echo '<h5>Usuário não cadastrado!</h5>';
          }
          else if ($_GET["error"] == "senhaincorreta") {
            echo '<h5>Senha incorreta, tente novamente!</h5>';
          }
        } 
      ?>     

      <section class="formulario" style="width: 100%;">
        <h4>Acessar</h4>
        <form class="was-validated" action="includes/acessar.inc.php" method="post" style="width: 40%;">
          <div class="mb-3">
            <label class="form-label">Usuário</label>
            <input type="text" name="usuario" class="form-control" placeholder="Digite seu nome de usuário" required>
          </div>
          <div class="mb-3">
            <label class="form-label">Senha</label>
            <div class="input-group">
              <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" required>
            </div>
          </div>            
          <div class="submit">
            <button type="submit" name="acessarBtn" class="submitBt">ENTRAR</button>
          </div>
        </form>
      </section>
    </body>
</html>