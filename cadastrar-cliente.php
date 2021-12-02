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
                <h4>Cadastrar Cliente</h4>

                <?php
                if (isset($_GET["error"])) {
                    if ($_GET["error"] == "cliente-ja-cadastrado") {
                    echo "<h5>Este cliente já foi cadastrado!</h5>";
                    }
                    else if ($_GET["error"] == "none") {
                    echo "<h4>O cliente foi cadastrado com sucesso!</h4>";
                    }
                }
                ?>

                <form class="was-validated" action="includes/cadastrar-cliente.inc.php" method="post" style="width: 50%;">           
                    <div class="mb-3">
                        <label class="form-label">Nome</label>
                        <input type="text" name="nomecliente" class="form-control" placeholder="Ex.: Maria dos Santos" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CPF</label>
                        <input type="text" name="cpfcliente" class="form-control" placeholder="Ex.:000.000.000-00" maxlength="14" required>
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
                    </div>
                        <div class="submit">
                        <button type="submit" name="cadastrarBtn" class="submitBt">CADASTRAR</button>
                    </div>
                </form>
            </section>
        </section>        
    </body>
</html>