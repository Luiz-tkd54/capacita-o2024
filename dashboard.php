<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/index.css">
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
  <header>
    <?php
      require_once 'header.php';
      require_once 'class/gerenciamento.php';
      $c = new Contagem("capacitacao2024","localhost","root","");

      $quantidadeCliente = $c->contarClientes();
      $quantidadeProduto = $c->contarProdutos();
      $quantidadePedido = $c->contarPedidos();

    ?>
  </header>
  <section class="page-index">
    <div class="container">
      <div class="dash-index">
        <div class="blc">
          <div class="d-flex justify-content-between">
            <div>
              <h2>Clientes</h2>
              <span><?php echo " $quantidadeCliente"?></span>
            </div>
            <img src="assets/images/icon-users.svg" alt="">
          </div>
          <a href="geren-cliente.php" class="bt-index">Gerenciar clientes</a>
        </div>
        <div class="blc">
          <div class="d-flex justify-content-between">
            <div>
              <h2>Produtos</h2>
              <span><?php echo " $quantidadeProduto"?></span>
            </div>
            <img src="assets/images/icon-product.svg" style="max-width: 76px;" alt="">
          </div>
          <a href="geren-produtos.php" class="bt-index">Gerenciar produto</a>
        </div>
        <div class="blc">
          <div class="d-flex justify-content-between">
            <div>
              <h2>Pedidos</h2>
              <span><?php echo " $quantidadePedido"?></span>
            </div>
            <img src="assets/images/icon-pedido.svg" alt="">
          </div>
          <a href="pedidos.php" class="bt-index">Novo pedido</a>
        </div>
      </div>
    </div>
  </section>
</body>

</html>