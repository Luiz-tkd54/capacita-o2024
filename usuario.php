<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de usuário</title>
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
<!-- busca de arquivo da class usuario -->
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
  <section class="page-cadastro-usuario paddingBottom50">
    <div class="container">
      <div>
        <a href="dashboard.php" class="link-voltar">
          <img src="assets/images/arrow.svg" alt="">
          <span>Cadastro de usuário</span>
        </a>
      </div>
      <?php
      if (isset($_POST['nome'])){
        // proteção de codigos maliciosos
        $nome = addslashes($_POST['nome']); 
        $data_nascimento = addslashes($_POST['data']);
        $cpf = addslashes($_POST['cpf']);
        $telefone = addslashes($_POST['telefone']);
        $email = addslashes($_POST['email']);
        $senha = addslashes($_POST['senha']);
        // validacao  de preenchimento obrigatorio
        if(!empty($nome) && !empty($data_nascimento) && !empty($cpf) &&
           !empty($telefone) && !empty($email) && !empty($senha)){
          //cadastrar
          if(!$u->cadastrarUsuario($nome, $data_nascimento, $cpf, $telefone, $email, $senha )){
            echo "Email ja esta cadastrado";
          }else{
            echo '<div class="mensagem-sucesso">Usuário cadastrado com sucesso</div>';
          }
          
        }else{
            echo "Preencha todos os campos!";
        }

      }
      ?>

      <style> 
        .mensagem-sucesso {
        font-size: 1.5em; 
        color: #008000; 
        margin-top: 20px; 
        } 
      </style>

      <div class="container-small">
        <form method="POST" id="form-cadastro-usuario">
          <div class="bloco-inputs">
            <div>
              <label class="input-label">Nome</label>
              <input type="text" class="nome-input" name="nome">
            </div>
            <div>
              <label class="input-label">Data de Nascimento</label>
              <input type="date" class="date-input" name="data">
            </div>
            <div>
              <label class="input-label">CPF</label>
              <input type="text" class="cpf-input" name="cpf">
            </div>
            <div>
              <label class="input-label">Telefone</label>
              <input type="tel" class="telefone-input" name="telefone">
            </div>
            <div>
              <label class="input-label">E-mail</label>
              <input type="text" class="email-input" name="email">
            </div>
            <div>
              <label class="input-label">Senha</label>
              <input type="password" class="senha-input" name="senha">
            </div>
          </div>
          <button type="submit" class="button-default">Salvar novo usuário</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>