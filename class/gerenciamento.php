<?php

class Tabela{

// conexão
private $pdo;

public function __construct($dbname, $host, $user, $password)
{

    try {

    $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);

    } catch (PDOException $e) {
        echo "Erro com banco de dados: ".$e->getMessage();
        exit();
    }
    catch (PDOException $e) {
        echo "Erro generico".$e->getMessage();
        exit();
    }
}

public function getPDO() {
    return $this->pdo;
}

// -----------------TABELA PRODUTOS ---------------------------------------

    public function buscarProdutos(){
        $busca = array();
        $produto = $this->pdo->prepare("SELECT * FROM produto ORDER BY nome");
        $produto->execute();
        $busca = $produto->fetchAll(PDO::FETCH_ASSOC);
        return $busca;
    }

    public function excluirProduto($id){
        $excluir = $this->pdo->prepare("DELETE FROM produto WHERE id = :id");
        $excluir->bindValue(":id",$id);
        $excluir->execute();
    }

// ----------------------NOVO PEDIDO --------------------------------------------


public function buscarProdutosPorNome($nomeProduto){
    $busca = array();
    $produto = $this->pdo->prepare("SELECT * FROM produto WHERE nome LIKE :nomeProduto LIMIT 10");
    $produto->bindValue(":nomeProduto", "%" . $nomeProduto . "%");
    $produto->execute();
    $busca = $produto->fetchAll(PDO::FETCH_ASSOC); // Retorna até 10 produtos
    return $busca;
}




// ---------------------- TABELA CLIENTES -------------------------------

    public function buscarCliente(){
        $busca = array();
        $cliente = $this->pdo->prepare("SELECT * FROM cliente ORDER BY nome");
        $cliente->execute();
        $busca = $cliente->fetchAll(PDO::FETCH_ASSOC);
        return $busca;
    }

    public function excluirCliente($id){
        $excluir = $this->pdo->prepare("DELETE FROM cliente WHERE id = :id");
        $excluir->bindValue(":id",$id);
        $excluir->execute();
    }

// -------------------------TABELA USUARIOS ---------------------------------

    public function buscarUsuario(){
        $busca = array();
        $usuario = $this->pdo->prepare("SELECT id,nome,cpf,data_nascimento,email,telefone FROM usuario ORDER BY nome");
        $usuario->execute();
        $busca = $usuario->fetchAll(PDO::FETCH_ASSOC);
        return $busca;
    }

    public function excluirUsuario($id){
        $excluir = $this->pdo->prepare("DELETE FROM usuario WHERE id = :id");
        $excluir->bindValue(":id",$id);
        $excluir->execute();
    }


}



?>