<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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
    
    // Busca os dados do cliente
    $cliente = $t->buscarClientePorId($id);
    
    // Verifica se o cliente foi encontrado
    if (!$cliente) {
        echo "Cliente não encontrado!";
        exit();
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'];
        $cpf = $_POST['cpf'];
        $data_nascimento = $_POST['data_nascimento'];
        $email = $_POST['email'];
        $telefone = $_POST['telefone'];

        // Atualiza os dados do cliente
        if ($t->atualizarCliente($id, $nome, $cpf, $data_nascimento, $email, $telefone)) {
            header("Location: geren-cliente.php");
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
    <section class="page-editar-cliente paddingBottom50">
        <div class="container">
            <h2>Editar Cliente</h2>
            <form method="post">
                <div class="bloco-inputs">
                    <div>
                        <label class="input-label">Nome</label>
                        <input type="text" class="nome-input" name="nome" value="<?php echo htmlspecialchars($cliente['nome']); ?>" required>
                    </div>
                    <div>
                        <label class="input-label">CPF</label>
                        <input type="text" class="nome-input" name="cpf" value="<?php echo htmlspecialchars($cliente['cpf']); ?>" required>
                    </div>
                    <div>
                        <label class="input-label">Data de Nascimento</label>
                        <input type="date" class="nome-input" name="data_nascimento" value="<?php echo htmlspecialchars($cliente['data_nascimento']); ?>" required>
                    </div>
                    <div>
                        <label class="input-label">E-mail</label>
                        <input type="email" class="nome-input" name="email" value="<?php echo htmlspecialchars($cliente['email']); ?>" required>
                    </div>
                    <div>
                        <label class="input-label">Telefone</label>
                        <input type="text" class="nome-input" name="telefone" value="<?php echo htmlspecialchars($cliente['telefone']); ?>" required>
                    </div>
                </div>
                <button type="submit" class="button-default">Salvar Alterações</button>
            </form>
        </div>
    </section>
</body>

</html>