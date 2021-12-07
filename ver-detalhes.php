<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Ver Detalhes</title>
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
            if ($_GET["error"] == "stmt-falhou") {
              echo "<p class='error'>Algo deu errado, tente novamente!</p>";
            }
            else if ($_GET["error"] == "none") {
            echo "<h5>O cliente foi cadastrado com sucesso!</h5>";
            }
          }
        ?>

        <h4><b>DETALHES DO CLIENTE</b></h4>        

        <form class="was-validated cadastrar-cliente" action="includes/alterar-dados.inc.php" method="post">        
          <div class="cadastrar-cliente">          
            <div class="dados-pessoais" style="width: 40%;">
              <p><b>Dados Pessoais</b></p>
              <div class="mb-3">
                <label class="form-label">Nome</label>
                <?php
                echo '<input type="text" name="nomecliente" value="' . $_SESSION["nomecliente"] . '" class="form-control" disabled />';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">CPF</label>
                <?php
                echo '<input type="text" name="cpfcliente" value="' . $_SESSION["cpfcliente"] . '" class="form-control" disabled />';
                ?>
              </div>              
              <div class="mb-3">
                <label class="form-label">Data de Nascimento</label>
                <?php
                echo '<input type="text" name="dtnasccliente" value="' . $_SESSION["dtnasccliente"] . '" class="form-control" disabled />';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label" for="tipocliente">Tipo</label>
                <select class="form-select" name="tipocliente" id="tipocliente">
                <?php
                  if ($_SESSION["tipocliente"] === "S") {
                    echo '<option selected value="S">Silver</option>';
                  } else {
                    echo '<option value="S">Silver</option>';
                  }
                  if ($_SESSION["tipocliente"] === "G") {
                    echo '<option selected value="G">Gold</option>';
                  } else {
                    echo '<option value="G">Gold</option>';
                  }
                  if ($_SESSION["tipocliente"] === "P") {
                    echo '<option selected value="P">Platinum</option>';
                  } else {
                    echo '<option value="P">Platinum</option>';
                  }
                ?>
                </select>                
              </div>              

              <p><b>Telefone</b></p>
              <div class="mb-3">
                <label class="form-label" for="tipotelefone">Tipo</label>
                <select class="form-select" name="tipotelefone" id="tipotelefone">
                  <?php                
                    if ($_SESSION["tipotelefone"] === "1") {
                      echo '<option selected value="1">Celular</option>';
                    } else {
                      echo '<option value="1">Celular</option>';
                    }
                    if ($_SESSION["tipotelefone"] === "2") {
                      echo '<option selected value="2">Fixo</option>';
                    } else {
                      echo '<option value="2">Fixo</option>';
                    }
                  ?>
                </select>
              </div>    
              <div class="mb-3">
                <label class="form-label">DDD</label>
                <?php
                echo '<input type="text" name="ddd" value="' . $_SESSION["ddd"] . '" class="form-control" minlength="2" maxlength="2"/>';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Número de Telefone</label>
                <?php
                echo '<input type="text" name="fone" value="' . $_SESSION["fone"] . '" class="form-control" minlength="8" maxlength="9"/>';
                ?>
              </div>                        
            </div>

            <div class="endereco" style="width: 40%;">
              <p><b>Endereço</b></p>
              <div class="mb-3">
                <label class="form-label">Logradouro</label>
                <?php
                echo '<input type="text" name="logradouro" value="' . $_SESSION["logradouro"] . '" class="form-control" maxlength="100"/>';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Número</label>
                <?php
                echo '<input type="text" name="numero" value="' . $_SESSION["numero"] . '" class="form-control" maxlength="5"/>';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Complemento</label>
                <?php
                echo '<input type="text" name="complemento" value="' . $_SESSION["complemento"] . '" class="form-control" maxlength="45"/>';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">Bairro</label>
                <?php
                echo '<input type="text" name="bairro" value="' . $_SESSION["bairro"] . '" class="form-control" maxlength="45"/>';
                ?>
              </div>
              <div class="mb-3">
                <label class="form-label">CEP</label>
                <?php
                echo '<input type="text" name="cep" value="' . $_SESSION["cep"] . '" class="form-control" minlength="8" maxlength="8"/>';
                ?>
              </div>          
              <div class="mb-3">
                <label class="form-label" for="uf">UF</label>
                <select class="form-select" name="uf" id="uf" required>
                  <option value="">---</option>
                  <option value="AC">AC</option>
                  <option value="AL">AL</option>
                  <option value="AM">AM</option>
                  <option value="AP">AP</option>              
                  <option value="BA">BA</option>
                  <option value="CE">CE</option>
                  <option value="DF">DF</option>
                  <option value="ES">ES</option>
                  <option value="GO">GO</option>
                  <option value="MA">MA</option>
                  <option value="MG">MG</option>
                  <option value="MS">MS</option>
                  <option value="MT">MT</option>
                  <option value="PA">PA</option>
                  <option value="PB">PB</option>
                  <option value="PE">PE</option>
                  <option value="PI">PI</option>
                  <option value="PR">PR</option>
                  <option value="RJ">RJ</option>
                  <option value="RN">RN</option>
                  <option value="RO">RO</option>
                  <option value="RR">RR</option>
                  <option value="RS">RS</option>
                  <option value="SC">SC</option>
                  <option value="SP">SP</option>
                  <option value="TO">TO</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Cidade</label>
                <?php
                echo '<input type="text" name="cidade" value="' . $_SESSION["cidade"] . '" class="form-control" maxlength="45"/>';
                ?>
              </div>
            </div>
          </div>
 
          <?php 
          echo '<input type="hidden" name="idusuario" value="' . $_SESSION["idusuario"] . '" />';
          ?>

          <div class="submit">
            <button type="submit" name="alterarDadosBtn" class="submitBt">ALTERAR DADOS</button>
          </div>
        </form>
      </section>
    </section>        
  </body>
</html>