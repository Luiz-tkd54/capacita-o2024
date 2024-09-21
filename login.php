<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./assets/css/reset.css">
  <link rel="stylesheet" href="./assets/css/styles.css">
  <link rel="stylesheet" href="https://use.typekit.net/tvf0cut.css">
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
        $_SESSION['usuario']= $email;
        header("Location: dashboard.php");
        exit();
      }else{ 
        echo "Email ou senha invalidos";
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
              <input type="text" class="email-input" id="data-login" name="email">
            </div>
            <div>
              <label class="input-label-password">Senha</label>
              <input type="password" class="password-input" id="data-password" name="password">
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

</html>