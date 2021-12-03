<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <title>Cadastrar Cliente</title>
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
            if ($_GET["error"] == "cliente-ja-cadastrado") {
            echo "<p class='error'>Este cliente já foi cadastrado!</p>";
            }
            else if ($_GET["error"] == "none") {
            echo "<h5>O cliente foi cadastrado com sucesso!</h5>";
            }
          }
        ?>

        <h4><b>CADASTRAR CLIENTE</b></h4>        

        <form class="was-validated cadastrar-cliente" action="includes/cadastrar-cliente.inc.php" method="post">        
          <div class="cadastrar-cliente">

            <div class="dados-pessoais" style="width: 420px;">
              <p><b>Dados Pessoais</b></p>
              <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nomecliente" class="form-control" placeholder="Ex.: Maria dos Santos" maxlength="45" required>
              </div>
              <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpfcliente" class="form-control" placeholder="Ex.: 000.000.000-00" minlength="11" maxlength="14" required>
              </div>
              <div class="mb-3">
                <label class="form-label" for="tipocliente">Tipo</label>
                <select class="form-select" name="tipocliente" id="tipocliente" required>
                  <option value="">---</option>
                  <option value="1">Pessoa Física</option>
                  <option value="2">Pessoa Jurídica</option>
                </select>
              </div>
              <div class="mb-3">
                <label class="form-label">Data de Nascimento</label>
                <input type="date" name="dtnasccliente" class="form-control" required>          
              </div>

              <p><b>Telefone</b></p>
              <div class="mb-3">
                <label class="form-label" for="tipocelular">Tipo</label>
                <select class="form-select" name="tipocelular" id="tipocelular" required>
                  <option value="">---</option>
                  <option value="1">Celular</option>
                  <option value="2">Fixo</option>
                </select>
              </div>    
              <div class="mb-3">
                <label class="form-label">DDD</label>
                <input type="text" name="ddd" class="form-control" placeholder="Ex.: 46" minlength="2" maxlength="2" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Número de Telefone</label>
                <input type="text" name="fone" class="form-control" placeholder="Ex.:987654321" minlength="9" maxlength="9" required>
              </div>                        
            </div>

            <div class="endereco" style="width: 420px;">
              <p><b>Endereço</b></p>
              <div class="mb-3">
                <label class="form-label">Logradouro</label>
                <input type="text" name="logradouro" class="form-control" placeholder="Ex.: Avenida sete de setembro" maxlength="100" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Número</label>
                <input type="text" name="numero" class="form-control" maxlength="5" required>
              </div>
              <div class="mb-3">
                <label class="form-label">Complemento</label>
                <input type="text" name="complemento" class="form-control" placeholder="Ex.: bloco 3, apartamento 55" maxlength="45">
              </div>
              <div class="mb-3">
                <label class="form-label">Bairro</label>
                <input type="text" name="bairro" class="form-control" maxlength="45" required>
              </div>
              <div class="mb-3">
                <label class="form-label">CEP</label>
                <input type="text" name="cep" class="form-control" minlength="8" maxlength="8">
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
                <input type="text" name="cidade" class="form-control" maxlength="45" required>
              </div>
            </div>
          </div>

          <div class="submit">
            <button type="submit" name="cadastrarClienteBtn" class="submitBt">CADASTRAR</button>
          </div>
        </form>
      </section>
    </section>        
  </body>
</html>