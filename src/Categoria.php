<?php
namespace Microblog;
use PDO, Exception;


class Categoria{
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }


    public function inserir():void{
        $sql = "INSERT INTO categorias(nome) VALUES (:nome)";
        try {
        
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR_CHAR);
            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao inserir usuário".$erro->getMessage());
        }
    }

    public function listar():array{
        $sql = "SELECT * FROM categorias";
        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();

            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

        } catch (Exception $erro) {
            die("Erro ao listar categorias".$erro->getMessage());
        }
        return $resultado;
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
}
?>