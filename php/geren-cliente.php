<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Gerenciamento de cliente</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
</head>

<body>
  <header>
    <?php
        require_once 'header.php';
    ?>
  </header>
  <section class="page-gerenciamento-cliente paddingBottom50">
    <div class="container">
      <div class="d-flex justify-content-between">
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Gerenciamento de cliente</span>
        </a>
        <a href="clientes.php" class="button-default bt-add">Adicionar novo cliente</a>
      </div>
      <div class="shadow-table">
        <table>
          <thead>
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>CPF</th>
              <th>E-mail</th>
              <th>Telefone</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Nome Sobrenome</td>
              <td>111.333.555-77</td>
              <td>nome.sobrenome@essentialnutrition.com.br</td>
              <td>(48) 99999-9999</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Nome Sobrenome</td>
              <td>111.333.555-77</td>
              <td>nome.sobrenome@essentialnutrition.com.br</td>
              <td>(48) 99999-9999</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>
</body>

</html>