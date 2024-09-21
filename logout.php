<?php
// inicia sessao
session_start();

// Verifica se a sessão existe e a destrói
if (isset($_SESSION['usuario'])) {
    unset($_SESSION['usuario']); // Remove a variável da sessão
}

// destroi a sessao 

session_destroy();

// redireciona o usuario para pagina de login 

header("Location: login.php");
exit();

?>