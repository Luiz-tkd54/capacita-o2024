<?php

class Busca{

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
// -----------------BUSCA TABELA PRODUTOS ---------------------------------------

    public function buscarProdutos(){
        $busca = array();
        $produto = $this->pdo->prepare("SELECT * FROM produto ORDER BY nome");
        $produto->execute();
        $busca = $produto->fetchAll(PDO::FETCH_ASSOC);
        return $busca;
    }

// ---------------------- BUSCA TABELA CLIENTES -------------------------------

    public function buscarClientes(){
        $busca = array();
        $cliente = $this->pdo->prepare("SELECT *FROM cliente ORDER BY nome");
        $cliente->execute();
        $busca = $cliente->fetchAll(PDO::FETCH_ASSOC);
        return $busca;
    }



}




?>