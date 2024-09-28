    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Editar usuario</title>
        <link rel="stylesheet" href="./assets/css/reset.css">
        <link rel="stylesheet" href="./assets/css/styles.css">
    </head>

    <?php
    session_start(); // Inicia a sessão

    // Verifica se o usuário está logado
    if (!isset($_SESSION['usuario'])) {
        header("Location: login.php"); // Redireciona para a página de login se não estiver logado
        exit();
    }

    require_once 'class/gerenciamento.php';
    $t = new Tabela("capacitacao2024", "localhost", "root", "");

    // Verifica se o ID foi passado na URL
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        
        // Busca os dados do usuario
        $usuario = $t->buscarUsuarioPorId($id);
        
        // Verifica se o usuario foi encontrado
        if (!$usuario) {
            echo "Usuario não encontrado!";
            exit();
        }

        // Verifica se o formulário foi enviado
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $nome = $_POST['nome'];
            $cpf = $_POST['cpf'];
            $data_nascimento = $_POST['data_nascimento'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];

            // Atualiza os dados do usuario
            if ($t->atualizarUsuario($id, $nome, $cpf, $data_nascimento, $email, $telefone)) {
                header("Location: geren-usuario.php");
                exit();
            } else {
                echo "<script>alert('Erro ao atualizar dados.');</script>";
            }
        }
    } else {
        echo "ID não fornecido!";
        exit();
    }
    ?>

    <body>
        <header>
            <?php require_once 'header.php'; ?>
        </header>
        <section class="page-editar-usuario paddingBottom50">
            <div class="container">
                <h2>Editar usuario</h2>
                <form method="post">
                    <div class="bloco-inputs">
                        <div>
                            <label class="input-label">Nome</label>
                            <input type="text" class="nome-input" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
                        </div>
                        <div>
                            <label class="input-label">CPF</label>
                            <input type="text" class="nome-input" name="cpf" value="<?php echo htmlspecialchars($usuario['cpf']); ?>" required>
                        </div>
                        <div>
                            <label class="input-label">Data de Nascimento</label>
                            <input type="date" class="nome-input" name="data_nascimento" value="<?php echo htmlspecialchars($usuario['data_nascimento']); ?>" required>
                        </div>
                        <div>
                            <label class="input-label">E-mail</label>
                            <input type="email" class="nome-input" name="email" value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
                        </div>
                        <div>
                            <label class="input-label">Telefone</label>
                            <input type="text" class="nome-input" name="telefone" value="<?php echo htmlspecialchars($usuario['telefone']); ?>" required>
                        </div>
                    </div>
                    <button type="submit" class="button-default">Salvar Alterações</button>
                </form>
            </div>
        </section>
    </body>

    </html>