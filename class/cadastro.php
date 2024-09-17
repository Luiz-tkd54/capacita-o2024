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


    //-----------------------CADASTRO  DE USUARIO--------------------------------------------------------------------

    public function cadastrarUsuario($nome, $data_nascimento, $cpf, $telefone, $email, $senha ){
        // verificação se o email ja foi cadastrado.
        $cadusuario =  $this->pdo->prepare("SELECT id FROM usuario WHERE email = :e");
        $cadusuario->bindValue(":e",$email);
        $cadusuario->execute();
        // email ja existe
        if ($cadusuario->rowCount() > 0){
            return false;
        // email nao existe  
        }else{
            // criptografia
            $senha_criptografada = sha1($senha);
            $cadusuario = $this->pdo->prepare("INSERT INTO usuario (nome, data_nascimento, cpf, telefone, email, senha)
            VALUES (:n, :d, :c, :t, :e, :s)");
            $cadusuario->bindValue(":n",$nome);
            $cadusuario->bindValue(":d",$data_nascimento);
            $cadusuario->bindValue(":c",$cpf);
            $cadusuario->bindValue(":t",$telefone);
            $cadusuario->bindValue(":e",$email);
            $cadusuario->bindValue(":s",$senha_criptografada);
            $cadusuario->execute();
            return true;
        }
    }
}

// -------------------------CADASTRO DE CLIENTE---------------------------------------------------------------------
class Cliente {

    private $pdo;

    public function __construct($dbname, $host, $user, $password){

        try {
        
        $this->pdo = new PDO("mysql:dbname=".$dbname.";host=".$host,$user,$password);

        } catch (PDOException $e) {
            echo "Erro com banco de dados:".$e->getMessage();
            exit();
        } catch (PDOException $e) {
            echo "Erro generico:".$e->getMessage();
            exit();
        }   
    }   

    public function CadastrarCliente($nome, $cpf, $email, $data_nascimento, $telefone){
        
        $cadcliente = $this->pdo->prepare("SELECT id from cliente WHERE email = :e ");
        $cadcliente->bindValue(":e",$email);
        $cadcliente->execute();
        
        if ($cadcliente->rowCount() > 0){
            return false;
        // email nao existe  
        }else{
            $cadcliente = $this->pdo->prepare("INSERT INTO cliente (nome, cpf, email, data_nascimento, telefone)
            VALUES (:n, :c, :e, :d, :t)");
            $cadcliente->bindValue(":n",$nome);
            $cadcliente->bindValue(":c",$cpf);
            $cadcliente->bindValue(":e",$email);
            $cadcliente->bindValue(":d",$data_nascimento);
            $cadcliente->bindValue(":t",$telefone);
            $cadcliente->execute();
            return true;
        }
    }







}
?>