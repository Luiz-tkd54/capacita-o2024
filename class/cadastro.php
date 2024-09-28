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
// -----------------------LOGIN ---------------------------------------------------------------
   
    public function Login($email, $senha){
        $senha_criptografada = sha1($senha);
        $login = $this->pdo->prepare("SELECT id FROM usuario WHERE email = :e AND senha = :s");
        $login->bindValue(":e",$email);
        $login->bindValue(":s",$senha_criptografada);
        $login->execute();

        if($login->rowCount() > 0){
            // login bem sucedido
            return true;
        }else{
            // credenciais invalidas
            return false;
        }
    }
//----------------------ALTERAR A SENHA -------------------------------------------------------

    public function alterarSenha($email,$novaSenha){

        $novaSenhaCriptografada = sha1($novaSenha);
        $alterar = $this->pdo->prepare("UPDATE usuario SET senha = :s WHERE email = :e");
        $alterar->bindValue(":s",$novaSenhaCriptografada);
        $alterar->bindValue(":e",$email);
        return $alterar->execute(); 
    }



//---------------------NOME NO DROPMENU ----------------------------------------------------------

    public function nomeMenu($email){
      
        $buscaDeNome = $this->pdo->prepare("SELECT nome FROM usuario WHERE email = ?");
        $buscaDeNome->execute([$email]);
        return $buscaDeNome->fetch(PDO::FETCH_ASSOC);
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
// --------------------------CADASTRO DE PRODUTO -------------------------------------------------------
class Produto {

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

    public function CadastrarProduto($nome, $sku, $quantidade, $valor, $descricao, $imagem){

        $cadProduto = $this->pdo->prepare('SELECT id FROM produto WHERE sku = :s');
        $cadProduto->bindValue(':s', $sku);
        $cadProduto->execute();

        if($cadProduto->rowCount() > 0){
            return false;
        }else{
            $cadProduto = $this->pdo->prepare('INSERT INTO produto (nome, sku, quantidade, valor, descricao, imagem)
            VALUES (:n, :s, :q, :v, :d, :i)');
            $cadProduto->bindValue(":n", $nome);
            $cadProduto->bindValue(":s", $sku);
            $cadProduto->bindValue(":q", $quantidade);
            $cadProduto->bindValue(":v", $valor);
            $cadProduto->bindValue(":d",$descricao);
            $cadProduto->bindValue(":i",$imagem);
            $cadProduto->execute();
            return true;
        }
    }

    public function uploadImagem($imagem){

        $uploadDiretorio = 'arquivo/';
        $uploadFile = $uploadDiretorio . basename($imagem['name']);

        if(move_uploaded_file($imagem['tmp_name'], $uploadFile)){
            return $uploadFile;
        }else{
            echo "Erro ao salvar a imagem.";
            return false;
        }
    }

}
?>