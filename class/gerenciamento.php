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

    // ----------------BOTAO DE EDITAR PRODUTO ----------------------------------- 

    public function buscarProdutoPorId($id) {
        $busca = $this->pdo->prepare("SELECT * FROM produto WHERE id = :id");
        $busca->bindValue(":id", $id);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizarProduto($id, $imagem, $nome, $sku, $quantidade, $descricao, $valor) {
        $atualizar = $this->pdo->prepare("UPDATE produto SET imagem = :i, nome = :n, sku = :s, quantidade = :q,
                                        descricao = :d, valor = :v WHERE id = :id");
        $atualizar->bindValue(":i",$imagem);
        $atualizar->bindValue(":n", $nome);
        $atualizar->bindValue(":s", $sku);
        $atualizar->bindValue(":q", $quantidade);
        $atualizar->bindValue(":d", $descricao);
        $atualizar->bindValue(":v", $valor);
        $atualizar->bindValue(":id", $id);
        return $atualizar->execute();   
    }

    public function atualizaruploadImagem($imagem){

        $uploadDiretorio = 'arquivo/';
        $uploadFile = $uploadDiretorio . basename($imagem['name']);

        if(move_uploaded_file($imagem['tmp_name'], $uploadFile)){
            return $uploadFile;
        }else{
            echo "Erro ao salvar a imagem.";
            return false;
        }
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

// ----------------BOTAO DE EDITAR CLIENTE ----------------------------------- 

    public function buscarClientePorId($id) {
        $busca = $this->pdo->prepare("SELECT * FROM cliente WHERE id = :id");
        $busca->bindValue(":id", $id);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizarCliente($id, $nome, $cpf, $data_nascimento, $email, $telefone) {
        $atualizar = $this->pdo->prepare("UPDATE cliente SET nome = :n, cpf = :c, data_nascimento = :d, email = :e, telefone = :t WHERE id = :id");
        $atualizar->bindValue(":n", $nome);
        $atualizar->bindValue(":c", $cpf);
        $atualizar->bindValue(":d", $data_nascimento);
        $atualizar->bindValue(":e", $email);
        $atualizar->bindValue(":t", $telefone);
        $atualizar->bindValue(":id", $id);
        return $atualizar->execute();
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

// ----------------BOTAO DE EDITAR USUARIO ----------------------------------- 

    public function buscarUsuarioPorId($id) {
        $busca = $this->pdo->prepare("SELECT * FROM usuario WHERE id = :id");
        $busca->bindValue(":id", $id);
        $busca->execute();
        return $busca->fetch(PDO::FETCH_ASSOC);
    }
    
    public function atualizarUsuario($id, $nome, $cpf, $data_nascimento, $email, $telefone) {
        $atualizar = $this->pdo->prepare("UPDATE usuario SET nome = :n, cpf = :c, data_nascimento = :d, email = :e, telefone = :t WHERE id = :id");
        $atualizar->bindValue(":n", $nome);
        $atualizar->bindValue(":c", $cpf);
        $atualizar->bindValue(":d", $data_nascimento);
        $atualizar->bindValue(":e", $email);
        $atualizar->bindValue(":t", $telefone);
        $atualizar->bindValue(":id", $id);
        return $atualizar->execute();
    }

}


// --------------------------CONTAGEM PARA O DASHBOARD-----------------------------------------

class Contagem {

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
// ----------------------- CLIENTE --------------------------------------
    public function contarClientes(){
        $contar = $this->pdo->prepare("SELECT COUNT(*) AS total FROM cliente");
        $contar->execute();
        return $contar->fetchColumn();
    }
// ----------------------- PRODUTO --------------------------------------

public function contarProdutos(){
    $contar = $this->pdo->prepare("SELECT COUNT(*) AS total FROM produto");
    $contar->execute();
    return $contar->fetchColumn();
}

// ----------------------- PEDIDOS --------------------------------------
public function contarPedidos(){
    $contar = $this->pdo->prepare("SELECT COUNT(*) AS total FROM pedido");
    $contar->execute();
    return $contar->fetchColumn();
}
}


?>