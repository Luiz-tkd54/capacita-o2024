<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>
    
  <header>
    <div class="container">
      <a href="index.html" class="logo">
        <img src="assets/images/ho.svg" alt="" />
      </a>
    </div>
  </header>
  <?php
    session_start();
    require_once './class/cadastro.php';
    $usuario = new Usuario("capacitacao2024","localhost","root","");

    if($_SERVER['REQUEST_METHOD']== 'POST'){
      $email = addslashes($_POST['email']); 
      $senha = addslashes($_POST['password']);

      if($usuario->login($email, $senha)){
        $usuarioInfo = $usuario->nomeMenu($email);
        $_SESSION['usuario']= $usuarioInfo['nome'];
        header("Location: dashboard.php");
        exit();
      }else{ 

      }
    }
  ?>
  <section class="page-login">
    <div class="container-login">
      <div>
        <img src="assets/images/logoinpsun.png" alt="">
        <p class="login-title">
          Login
        </p>
        <p class="login-text">
          Caso seja admin, entre com o seu login de cliente da <a href="https://essentia.com.br/"
            target="_blank">Essentia Pharma.</a>
        </p>
      </div>
      <div class="login container-small">
        <form method="post" id="form-input-login">
          <div class="input-login">
            <div>
              <label class="input-label-login">E-mail</label>
              <input type="text" class="email-input required" id="data-login" name="email" oninput=" emailValidate()">
              <p id="error-message" style="color: #e63636; display: none;">E-mail inválido!</p> 
            </div>
            <div>
              <label class="input-label-password">Senha</label>
              <input type="password" class="password-input required" id="data-password" name="password" oninput="passwordValidate()">
              <p id="password-error" style="color: #e63636; display: none;">Senha invalida</p>
            </div>
            <div 
              class="faça-cadastro">Ainda não é cadastrado? <a href="cadastre-se.php">Cadastre-se</a>
            </div>
          </div>
          <button type="submit" class="button-default">Continuar</button>
        </form>
      </div>
    </div>
  </section>
</body>
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