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

<body>
  <header>
    <?php
        require_once 'header.php';
    ?>
  </header>
  <section class="page-gerenciamento-produto paddingBottom50">
    <div class="container">
      <div class="d-flex justify-content-between">
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Gerenciamento de produto</span>
        </a>
        <a href="cad-produto.php" class="bt-add">Adicionar novo produto</a>
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
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td><img src="assets/images/image-happy-theanine.jpg" class="img-produto" alt="" /></td>
              <td>Happy Theanine</td>
              <td>14585</td>
              <td>100</td>
              <td><span class="descr">Produto formulado com L-teanina pura e concentrada — uma poderosa substância
                  bioativa encontrada
                  naturalmente nas folhas de Camellia sinensis</span></td>
              <td>R$ 160,00</td>
            </tr>
            <tr>
              <td>2</td>
              <td><img src="assets/images/image-happy-theanine.jpg" class="img-produto" alt="" /></td>
              <td>Happy Theanine</td>
              <td>14585</td>
              <td>100</td>
              <td><span class="descr">Produto formulado com L-teanina pura e concentrada — uma poderosa substância
                  bioativa encontrada
                  naturalmente nas folhas de Camellia sinensis</span></td>
              <td>R$ 160,00</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>

</html>