<?php
namespace Microblog;
use PDO, Exception;

final class Noticia{
    private int $id;
    private string $data;
    private string $titulo;
    private string $texto;
    private string $resumo;
    private string $imagem;
    private string $destaque;
    private string $termo;

    // Atributos cujos tipos são associados a classes já existentes. Permitindo usar os recursos das classes
    public Usuario $usuario;
    public Categoria $categoria;

    private PDO $conexao;

    public function __construct() {
        // Ao criar um objeto de noticia, já iremos instanciar usuario e categoria
        $this->usuario = new Usuario;
        $this->categoria = new Categoria;
        $this->conexao = Banco::conecta();
    }


    // CRUD

    public function inserir():void{
        $sql = "INSERT INTO noticias(titulo, texto, resumo, imagem, destaque, usuario_id, categoria_id) 
        VALUES (:titulo, :texto, :resumo, :imagem, :destaque, :usuario_id, :categoria_id)";
        try {
            $consulta = $this->conexao->prepare($sql);

            $consulta->bindValue(":titulo", $this->titulo, PDO::PARAM_STR_CHAR);
            $consulta->bindValue(":texto", $this->texto, PDO::PARAM_STR_CHAR);
            $consulta->bindValue(":resumo", $this->resumo, PDO::PARAM_STR_CHAR);
            $consulta->bindValue(":imagem", $this->imagem, PDO::PARAM_STR_CHAR);
            $consulta->bindValue(":destaque", $this->destaque, PDO::PARAM_STR_CHAR);


            // Devido a associação entre as classes podemos chamar o método getId de Usuario e Categoria para depois associar os valores aos parametro da consulta SQL.
            $consulta->bindValue(":usuario_id", $this->usuario->getId(), PDO::PARAM_INT);
            $consulta->bindValue(":categoria_id", $this->categoria->getId(), PDO::PARAM_INT);

            $consulta->execute();

        } catch (Exception $erro) {
            die("Erro ao inserir notícia".$erro->getMessage());
        }
    }

 
    public function getId(): int
    {
        return $this->id;
    }
    public function setId(int $id): void
    {
        $this->id = filter_var($id, FILTER_SANITIZE_NUMBER_INT);
    }

    
    
    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): void
    {
        $this->data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    
    public function getTitulo(): string
    {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void
    {
        $this->titulo =  filter_var($titulo, FILTER_SANITIZE_SPECIAL_CHARS);

    }


    
    public function getTexto(): string
    {
        return $this->texto;
    }

    public function setTexto(string $texto): void
    {
        $this->texto = filter_var($texto , FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    
    public function getResumo(): string
    {
        return $this->resumo;
    }

    public function setResumo(string $resumo): void
    {
        $this->resumo =  filter_var($resumo, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    
    public function getImagem(): string
    {
        return $this->imagem;
    }
    public function setImagem(string $imagem): void
    {
        $this->imagem = filter_var($imagem, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    
    public function getDestaque(): string
    {
        return $this->destaque;
    }
    public function setDestaque(string $destaque): void
    {
        $this->destaque =  filter_var($destaque, FILTER_SANITIZE_SPECIAL_CHARS);

    }



    public function getTermo(): string
    {
        return $this->termo;
    }
    public function setTermo(string $termo): void
    {
        $this->termo =filter_var( $termo, FILTER_SANITIZE_SPECIAL_CHARS);

    }

    
    

}

?>