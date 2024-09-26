<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de cliente</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
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

<?php
  require_once 'class/cadastro.php';
  $c = new Cliente("capacitacao2024","localhost","root","");  
?>

<body>
  <header>
    <?php
      require_once 'header.php';
    ?>
  </header>
  <section class="page-cadastro-cliente paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Alterar senha</span>
        </a>
      </div>
      <div class="container-small">
        <form method="post" id="form-cadastro-cliente">
          <div class="bloco-inputs">
            <div>
              <label class="input-label">Email</label>
              <input type="text" class="nome-input" name="email">
            </div>
            <div>
              <label class="input-label">nova senha</label>
              <input type="password" class="nome-input" name="nova-senha">
            </div>
          
          </div>            
          <button type="submit" class="button-default">Alterar senha</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>