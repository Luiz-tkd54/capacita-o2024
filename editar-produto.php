<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="./assets/css/reset.css">
    <link rel="stylesheet" href="./assets/css/styles.css">
    <link rel="stylesheet" href="./assets/css/cadastro_produto.css">
    <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<?php
    session_start(); // Inicia a sessão

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
      header("Location: login.php"); // Redireciona para a página de login se não estiver logado
      exit();
    }
    
  ?>


<body>
    <header>
    <?php
        require_once 'header.php';
        require_once 'class/gerenciamento.php';
        $t = new Tabela("capacitacao2024", "localhost", "root", ""); 

        if(isset($_GET['id'])){
            $id = $_GET['id'];
            $produto = $t->buscarProdutoPorId($id);

            if(!$produto){
                echo "Produto não encontrado!";
                exit();
            }

                if($_SERVER['REQUEST_METHOD']=='POST'){
                $imagem = $_FILES['imagem'];
                $nome = $_POST['nome'];
                $sku = $_POST['sku'];
                $quantidade = $_POST['quantidade'];
                $descricao = $_POST['descricao'];
                $valor = $_POST['valor'];

                $novoCaminhoImagem = $t->atualizaruploadImagem($imagem);

                    if($novoCaminhoImagem){
                        if($t->atualizarProduto($id, $novoCaminhoImagem, $nome, $sku, $quantidade, $descricao, $valor)){
                            header("location: geren-produtos.php");
                            exit();
                        }else{
                            echo "<script>alert('Erro ao atualizar dados.');</script>";
                        }
                    }
                   
                }
            }
        else{
            echo "ID não fornecido!";
            exit();
        }


    ?>
    </header>
    <section class="page-cadastro-produto paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Alterar de produto</span>
        </a>
      </div>
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
