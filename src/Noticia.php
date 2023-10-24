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
    private string $destque;
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


    // 

 
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

    
    
    public function getDestque(): string
    {
        return $this->destque;
    }
    public function setDestque(string $destque): void
    {
        $this->destque =  filter_var($destque, FILTER_SANITIZE_SPECIAL_CHARS);

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