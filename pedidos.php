<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Novo pedido</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="./assets/css/novo_pedido.css">
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
    ?>
  </header>
  <section class="page-novo-pedido paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Novo pedido</span>
        </a>
      </div>
      <div class="maxW340">
        <label class="input-label">Cliente</label>
        <input type="text" class="input" name="cliente">
      </div>
      <div class="shadow-table">
        <table>
          <thead>
            <tr>
              <th>Produto</th>
              <th>Quantidade</th>
              <th>Valor parcial</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><input type="text" class="input" name="produto"></td>
              <td><input type="text" class="input" name="quantidade"></td>
              <td><input type="text" class="input" name="valorParcial"></td>
              <td><a href="#" class="bt-remover"><img src="assets/images/remover.svg" alt="" /></a></td>
            </tr>
            <tr>
              <td><input type="text" class="input" name="produto"></td>
              <td><input type="text" class="input" name="quantidade"></td>
              <td><input type="text" class="input" name="valorParcial"></td>
              <td><a href="#" class="bt-remover"><img src="assets/images/remover.svg" alt="" /></a></td>
            </tr>
          </tbody>
          <tfoot>
            <tr>
              <td colspan="4">
                <div class="row justify-content-between align-items-center">
                  <div class="col">
                    <a href="#" class="bt-add-produto">
                      <span>Adicionar produto</span>
                      <img src="assets/images/adicionar.svg" alt="" />
                    </a>
                  </div>
                  <div class="blc-subtotal d-flex">
                    <div class="d-flex align-items-center">
                      <span>Subtotal</span>
                      <input type="text" class="input" disabled value="572,00" />
                    </div>
                    <div class="d-flex align-items-center">
                      <span>Desconto</span>
                      <input type="text" class="input" value="100,00" />
                    </div>
                    <div class="d-flex align-items-center">
                      <span>Total</span>
                      <input type="text" class="input" disabled value="472,00" />
                    </div>
                  </div>
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      </div>
      <div class="maxW340">
        <label class="input-label">Observação</label>
        <input type="text" class="input" name="observacao">
      </div>
      <div class="maxW340">
        <button type="submit" class="button-default">Salvar</button>
      </div>
    </div>
  </section>
</body>

</html>