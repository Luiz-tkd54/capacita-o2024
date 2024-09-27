<?php
require_once 'gerenciamento.php';

$db = new Tabela("capacitacao2024","localhost","root","");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Dados do pedido
    $clienteNome = $_POST['cliente'];
    $observacao = $_POST['observacao'];
    $produtos = $_POST['produtos'];

    // Buscar o CPF do cliente baseado no nome
    $pdo = $db->getPDO();  // Usando o método getter para obter o objeto PDO
    $clienteQuery = $pdo->prepare("SELECT cpf FROM cliente WHERE nome = :nome LIMIT 1");
    $clienteQuery->bindValue(':nome', $clienteNome);
    $clienteQuery->execute();
    $cliente = $clienteQuery->fetch(PDO::FETCH_ASSOC);

    if ($cliente) {
        $cpfCliente = $cliente['cpf'];

        // Inserir pedido na tabela "pedido"
        $insertPedido = $pdo->prepare("INSERT INTO pedido (cpf_cliente, observacao) VALUES (:cpf_cliente, :observacao)");
        $insertPedido->bindValue(':cpf_cliente', $cpfCliente);
        $insertPedido->bindValue(':observacao', $observacao);
        $insertPedido->execute();
        $idPedido = $pdo->lastInsertId(); // Obter o ID do pedido recém-criado

        // Inserir cada produto na tabela "pedido_produto"
        foreach ($produtos as $produto) {
            // Buscar o ID do produto baseado no nome
            $produtoQuery = $pdo->prepare("SELECT id FROM produto WHERE nome = :nome LIMIT 1");
            $produtoQuery->bindValue(':nome', $produto['nome']);
            $produtoQuery->execute();
            $produtoData = $produtoQuery->fetch(PDO::FETCH_ASSOC);

            if ($produtoData) {
                $idProduto = $produtoData['id'];

                // Inserir o produto no pedido
                $insertPedidoProduto = $pdo->prepare("INSERT INTO pedido_produto (id_pedido, id_produto, quantidade) VALUES (:id_pedido, :id_produto, :quantidade)");
                $insertPedidoProduto->bindValue(':id_pedido', $idPedido);
                $insertPedidoProduto->bindValue(':id_produto', $idProduto);
                $insertPedidoProduto->bindValue(':quantidade', $produto['quantidade']);
                $insertPedidoProduto->execute();
            }
        }
        // atualizar quantidade do produto a fazer ainda 
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Cliente não encontrado']);
    }
}
?>