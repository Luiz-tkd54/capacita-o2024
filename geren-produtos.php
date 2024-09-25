<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de produto</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/gerenciamento_produto.css">
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
        $b = new Busca("capacitacao2024","localhost","root","");
    ?>

  </header>
  <section class="page-gerenciamento-produto paddingBottom50">
    <div class="container">
      <div class="d-flex justify-content-between">
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Gerenciamento de produto</span>
        </a>
        <a href="produtos.php" class="bt-add">Adicionar novo produto</a>
      </div>
      <div class="shadow-table">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Imagem</th>
              <th>Nome</th>
              <th>SKU</th>
              <th>QNT</th>
              <th>Descrição</th>
              <th>Valor</th>
              <th></th>
            </tr>
          </thead>
          <?php
          
            $dados = $b->buscarProdutos();
            if(count($dados) > 0){
              for ($i=0; $i < count($dados); $i++) { 
                echo "<tr>";
                foreach ($dados[$i] as $k => $v) {
                  if($k === 'imagem'){
                    echo "<td><img src='$v' alt='arquivo/' style='width: 80px; height: auto; border: solid 2px #333;'></td>";
                  }else{
                    echo "<td>".$v."</td>";
                  }
                  
                }
          ?>
                <td>
                  <a style="text-decoration: none;
                                 background-color: #367299; 
                                 color:#fff; border-radius: 4px;" href="">Editar</a> 
       
                  <a style="text-decoration: none; 
                                 background-color: #8d3535;
                                 color:#fff; border-radius: 4px;" href="">Excluir</a>
                </td>
          <?php
                echo "</tr>"; 
              }
         
            }else{
              echo "Nenhum produto cadastrado!";
            }
          ?>
        </table>
      </div>
    </div>
  </section>
</body>

</html>