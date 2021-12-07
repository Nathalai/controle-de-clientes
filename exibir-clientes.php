<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Exibir Clientes Cadastrados</title>
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
      include_once "./includes/exibir-clientes.inc.php";
    ?>

    <section class="conteudo">
      <?php        
      include_once "menu.php";      
      ?>

      <section class="formulario">
        <?php
          if (isset($_GET["error"])) {
            if ($_GET["error"] == "sem-cliente-id") {
            echo "<p class='error'>Não foi possível excluir o cliente!</p>";
            }
            else if ($_GET["error"] == "sem-id-cliente") {
              echo "<p class='error'>Algo deu errado. Não foi possível obter o ID do cliente.</p>";
            }
            else if ($_GET["error"] == "stmt-falhou") {
              echo "<p class='error'>Algo deu errado, tente novamente!</p>";
            }
            else if ($_GET["error"] == "none") {
              echo "<h5>O cliente foi excluído!</h5>";
            }
          }
        ?>

        <h4><b>EXIBIR CLIENTES CADASTRADOS</b></h4>

        <?php      
          function exibirClientes($array){
            $html = '<table>';
            $html .= '<tr>';
            foreach($array[0] as $key=>$value){
              $html .= '<th>' . htmlspecialchars($key) . '</th>';
            }
            $html .= '<th colspan="2"></th>';
            $html .= '</tr>';
            foreach($array as $key=>$value){
              $html .= '<tr>';
              foreach($value as $key2=>$value2){
                $html .= '<td>' . htmlspecialchars($value2) . '</td>';                
              }
              $html .= '<td><a href="./includes/buscar-dados-cliente.inc.php?cliente-id=' . $value["ID"] . '">Ver Detalhes</a></td>';
              $html .= '<td><a href="./excluir-cliente.php?cliente-id=' . $value["ID"] . '">Excluir</a></td>';
              $html .= '</tr>';
            }
            $html .= '</table>';
            return $html;
          }
          
          $itens = buscarClientes();

          $exibirClientes = exibirClientes($itens);

          echo $exibirClientes;
        ?>

      </section>
    </section>
  </body>
</html>