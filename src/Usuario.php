<?php
namespace Microblog;
use PDO, Exception;

class Usuario{
    private int $id;
    private string $nome;
    private string $email;
    private string $senha;
    private string $tipo;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();//::método estatico
    }




    public function inserir():void{

        $sql="INSERT INTO usuarios(nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);

            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao inserir usuário".$erro->getMessage());
        }
    }

    //Todos os usuarios
    public function listar():array{
        $sql = "SELECT id, nome, email, tipo FROM usuarios";
        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao listar usuário".$erro->getMessage());
        }
        return $resultado;

    }

    //Um usuario
    public function listarUm():array {
        $sql = "SELECT * FROM usuarios WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao carregar dados: ".$erro->getMessage());
        }

        return $resultado;
    }

    //update um usuario
    public function atualizar(){
        $sql = "UPDATE usuarios SET 
        nome = :nome,
        email = :email,
        tipo = :tipo,
        senha = :senha
        WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->bindValue(":email", $this->email, PDO::PARAM_STR);
            $consulta->bindValue(":senha", $this->senha, PDO::PARAM_STR);
            $consulta->bindValue(":tipo", $this->tipo, PDO::PARAM_STR);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao atualizar dados: ".$erro->getMessage());
        }
    }






    //Codificação da senha e comparação de senha
    public function codificaSenha(string $senha){
        return password_hash($senha, PASSWORD_DEFAULT);
    }

    public function verificaSenha(string $senhaFormulario, string $senhaBanco):string{
        // (senha digitada, senha codificada) = if(true ou false)
        //Caso 2: escreve a mesma senha
        if (password_verify($senhaFormulario, $senhaBanco)) { 
            return $senhaBanco; //retorna a mesma, pois é igual
        }else{
            return $this->codificaSenha($senhaFormulario);
        }//Caso 3: senha digitada diferente
    }





    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);

    }



    public function getNome(): string
    {
        return $this->nome;
    }
    public function setNome(string $nome): void
    {
        $this->nome = filter_var($nome, FILTER_SANITIZE_SPECIAL_CHARS);
    }



    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = filter_var($email, FILTER_SANITIZE_EMAIL);
    }


    
    public function getSenha(): string
    {
        return $this->senha;
    }
    public function setSenha(string $senha): void
    {
        $this->senha = filter_var($senha, FILTER_SANITIZE_SPECIAL_CHARS);;

    }


    
    public function getTipo(): string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): void
    {
        $this->tipo = filter_var($tipo, FILTER_SANITIZE_SPECIAL_CHARS);

    }


    
}