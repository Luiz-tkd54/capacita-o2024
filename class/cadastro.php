<?php


class Usuario{

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


    // cadastro

    public function cadastrarUsuario($nome, $data_nascimento, $cpf, $telefone, $email, $senha ){
        // verificação se o email ja foi cadastrado.
        $cad =  $this->pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $cad->bindValue(":e",$email);
        $cad->execute();
        // email ja existe
        if ($cad->rowCount() > 0){
            return false;
        // email nao existe  
        }else{
            // criptografia
            $senha_criptografada = sha1($senha);
            $cad = $this->pdo->prepare("INSERT INTO usuario (nome, data_nascimento, cpf, telefone, email, senha)
            VALUES (:n, :d, :c, :t, :e, :s)");
            $cad->bindValue(":n",$nome);
            $cad->bindValue(":d",$data_nascimento);
            $cad->bindValue(":c",$cpf);
            $cad->bindValue(":t",$telefone);
            $cad->bindValue(":e",$email);
            $cad->bindValue(":s",$senha_criptografada);
            $cad->execute();
            return true;
        }
    }
}



?>