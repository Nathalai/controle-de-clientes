<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Página Inicial</title>
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

      <?php
      if (isset($_SESSION["nomeusuario"])) {
          echo  '<section class="mensagem"><p class="mensagem">Olá ' . $_SESSION["nomeusuario"] . '!</p></section>';
        } else {
          header("location: ./acessar.php");
          exit();
        }
      ?>
    </section>
  </body>
</html>