<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de produto</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/cadastro_produto.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>

<?php
    session_start(); // Inicia a sessão

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
      header("Location: login.php"); // Redireciona para a página de login se não estiver logado
      exit();
    }
    
  ?>

  <?php
    require_once 'class/cadastro.php';
    $p = new Produto("capacitacao2024","localhost","root","");
  ?>


  <header>
  <?php
      require_once 'header.php';
    ?>
  </header>
  <section class="page-cadastro-produto paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Cadastro de produto</span>
        </a>
      </div>

    <?php
    
    if (isset($_POST['nome'])){
      // proteção de codigos maliciosos
      $nome = addslashes($_POST['nome']); 
      $sku = addslashes($_POST['sku']);
      $quantidade= addslashes($_POST['quantidade']);
      $valor = addslashes($_POST['valor']);
      $descricao = addslashes($_POST['descricao']);
      $imagem = $_FILES['imagem'];

      if(!empty($nome) && !empty($sku) && !empty($quantidade) &&
           !empty($valor) && !empty($descricao)){

          $caminhoImagem = $p->uploadImagem($imagem);
          
          if ($caminhoImagem){
             //cadastrar
          if(!$p->CadastrarProduto($nome, $sku, $quantidade, $valor, $descricao, $caminhoImagem)){
            echo "SKU ja esta cadastrado";
          }else{
            echo "Produto cadastrado com sucesso!";
          }
          
        }else{
            echo "Preencha todos os campos!";
        }
      
          }
      
    }
    
    ?>

      <div class="container-small">
        <form method="post" enctype="multipart/form-data" id="form-cadastro-produto">
          <div class="bloco-inputs">
            <div>
              <label class="input-label">Nome</label>
              <input type="text" class="nome-input" name="nome">
            </div>
            <div>
              <label class="input-label">Descrição</label>
              <textarea class="textarea" name ="descricao"></textarea>
            </div>
            <div class="flex-2">
              <div>
                <label class="input-label">SKU</label>
                <input type="text" class="sku-input" name="sku">
              </div>
              <div>
                <label class="input-label">Quantidade</label>
                <input type="text" class="quantidade-input" name="quantidade">
              </div>
              <div>
                <label class="input-label">Valor</label>
                <input type="text" class="valor-input" name="valor">
              </div>
            </div>
            <div>
              <label class="bt-arquivo" for="bt-arquivo">Adicionar imagem</label>
              <input id="bt-arquivo" type="file" name= "imagem">
            </div>
          </div>
          <button type="submit" class="button-default">Salvar novo produto</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>