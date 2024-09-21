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
          <span>Cadastro de cliente</span>
        </a>
      </div>

      <?php
      if (isset($_POST['nome'])){
        // proteção de codigos maliciosos
        $nome = addslashes($_POST['nome']); 
        $cpf = addslashes($_POST['cpf']);
        $email= addslashes($_POST['email']);
        $data_nascimento = addslashes($_POST['data']);
        $telefone = addslashes($_POST['telefone']);
        // validacao  de preenchimento obrigatorio
        if(!empty($nome) && !empty($cpf) && !empty($email) &&
           !empty($data_nascimento) && !empty($telefone)){
          //cadastrar
          if(!$c->CadastrarCliente($nome, $cpf, $email, $data_nascimento, $telefone )){
            echo "Email ja esta cadastrado";
          }else{
            echo "Cliente cadastrado com sucesso!";
          }
          
        }else{
            echo "Preencha todos os campos!";
        }

      }
      ?>

      <div class="container-small">
        <form method="post" id="form-cadastro-cliente">
          <div class="bloco-inputs">
            <div>
              <label class="input-label">Nome</label>
              <input type="text" class="nome-input" name="nome">
            </div>
            <div>
              <label class="input-label">Data de Nascimento</label>
              <input type="date" class="data-input" name="data">
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
          </div>            
          <button type="submit" class="button-default">Salvar novo cliente</button>
        </form>
      </div>
    </div>
  </section>
</body>

</html>