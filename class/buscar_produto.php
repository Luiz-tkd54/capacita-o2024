<?php

require_once 'gerenciamento.php';

$t = new Tabela("capacitacao2024","localhost","root","");

if (isset($_GET['nome'])) {
    $nomeProduto = $_GET['nome'];

    // Chame o método para buscar o produto pelo nome
    $produto = $t->buscarProdutosPorNome($nomeProduto);

    if ($produto) {
        // Retorne o produto encontrado em formato JSON
        echo json_encode($produto);
    } else {
        // Se não encontrar produto, retorne um JSON vazio
        echo json_encode([]);
    }
} else {
    echo json_encode([]);
}
?>