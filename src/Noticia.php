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


    public function listar():array{

        //Usa o atributo desta(this) tabela (public $usuario)
        if ($this->usuario->getTipo() === "admin") { // Admin
            $sql= "SELECT noticias.id, noticias.titulo, noticias.data, noticias.destaque, usuarios.nome as autor FROM noticias INNER JOIN usuarios ON noticias.usuario_id = usuarios.id ORDER BY data desc";
        
        } else {  //Editor
            $sql= "SELECT id, titulo, data, destaque FROM noticias where usuario_id = :usuario_id ORDER BY data desc";
        }
        try {
            $consulta = $this->conexao->prepare($sql);
            
            /* Somente se NÃO for um admin, trate o parâmetro abaixo */
            if( $this->usuario->getTipo() !== "admin" ){
                $consulta->bindValue(
                    ":usuario_id", $this->usuario->getId(), PDO::PARAM_INT
                );
            }
            
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);

            
        } catch (Exception $erro) {
            die("Erro ao listar noticias".$erro->getMessage());
        }
        return $resultado;

    }

    public function listarUm():array{
        if ($this->usuario->getTipo() === "admin") { // Admin
            $sql= "SELECT * FROM noticias WHERE id = :id ";
        
        } else {  //Editor
            $sql= "SELECT * FROM noticias WHERE id = :id AND usuario_id = :usuario_id";
        }

        try {
            $consulta = $this->conexao->prepare($sql);
            
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            if( $this->usuario->getTipo() !== "admin" ){
                $consulta->bindValue(
                    ":usuario_id", $this->usuario->getId(), PDO::PARAM_INT
                );
            }
            $consulta->execute();

            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
            
        } catch (Exception $erro) {
            die("Erro ao lista uma noticias".$erro->getMessage());
        } 
        return $resultado;
    }


    // Imagem retorna array com type[] name[] path[] ["tmp_name"]=>...
    public function upload(array $arquivo): void{
        //Definindo tipos válidos
        $tiposValidos = ["image/png", "image/jpeg", "image/gif", "image/svg+xml"];
        //Verificando se o arquivo NÃO é um dos  tipos válidos com uma função
        if (!in_array($arquivo["type"], $tiposValidos)) {
            // alerta usuario e volta para o form
            die("
            <script> 
                alert('formato inválido');
                history.back();
            </script>
            ");
        }


        //Acessando apenas o nome/extensão do arquivo
        $nome = $arquivo["name"];

        // Acessando os dados de acesso/armazenamento temporários
        $temporario = $arquivo["tmp_name"];

        //Definindo a pasta de destino(definitiva) das imagens no site
        
        $pastaFinal = "../imagens/".$nome;

        // Usamos a função para mover da area temporária até a final
        //coloca na pasta imagens
        move_uploaded_file($temporario, $pastaFinal);

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