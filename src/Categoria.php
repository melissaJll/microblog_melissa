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