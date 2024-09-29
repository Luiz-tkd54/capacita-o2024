<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de cliente</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
  $u = new Usuario("capacitacao2024","localhost","root","");  
?>

<body>
  <header>
    <?php
      require_once 'header.php';
    ?>
  </header>

  <?php
    // verifica se o formulario foi enviado 
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $email = $_POST['email'];
      $novaSenha = $_POST['nova-senha'];

      if($u->alterarSenha($email,$novaSenha)){
        echo '<div class="mensagem-sucesso">Senha alterada com sucesso</div>';
      }else{
        echo "Erro ao alterar a senha";
      }

    }

  ?>

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
              <label class="input-label-login">E-mail</label>
              <input type="text" class="email-input required" id="data-login" name="email" oninput=" emailValidate()">
              <p id="error-message" style="color: #e63636; display: none;">E-mail inválido!</p> 
            </div>
            <div>
              <label class="input-label-password">Senha</label>
              <input type="password" class="password-input required" id="data-password" name="nova-senha" oninput="passwordValidate()">
              <p id="password-error" style="color: #e63636; display: none;">Senha invalida</p>
            </div>
          
          </div>            
          <button type="submit" class="button-default">Alterar senha</button>
        </form>
      </div>
    </div>
  </section>
</body>

<style> .mensagem-sucesso {
    margin-left: 200px;
    font-size: 1.5em; 
    color: #008000; 
    margin-top: 20px; 
}
</style>

<script>
  const form = document.getElementById('form-input-login');
  const campos = document.querySelectorAll('.required');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

  // erros 
  function setError(login){
    campos[login].style.border = '2px solid #e63636';  
    if(login === 0 ){
      document.getElementById('error-message').style.display = 'block';
    }else if(login === 1){
      document.getElementById('password-error').style.display = 'block';
    }
    
  }

  function removeError(login){
    campos[login].style.border = '';
    if(login === 0){
      document.getElementById('error-message').style.display = 'none';
    }else if(login === 1){
      document.getElementById('password-error').style.display = 'none';
    }
    
  }

  // validando email
  function emailValidate(){
    if(!emailRegex.test(campos[0].value)){
      setError(0);
    }else{
     removeError(0);
    }
  }

  function passwordValidate(){
    if(campos[1].value.length < 4){
      setError(1);
    }else{
      removeError(1);
    }

  }
</script>

</html>