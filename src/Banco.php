<?php
namespace Microblog;
use PDO, Exception;

abstract class Banco {
    private static string $servidor = "localhost";
    private static string $usuario = "root";
    private static string $senha = "";
    private static string $banco = "microblog_melissa";

    // Operador nullable typehint = quando ussado indica que a propriedade da classe pode conter um valor nulo ou pode ser um tipo PDO
    //Neste caso ela é inicializada como null e quando a conexão é feita passa a ser PDO 
    private static ?PDO $conexao = null; 

    public static function conecta():PDO {
        // Se conexão ainda nao existir faça o try catch
        if (self::$conexao == null) {
            try {
                self::$conexao = new PDO(
                    "mysql:host=".self::$servidor."; 
                    dbname=".self::$banco.";
                    charset=utf8",
                    self::$usuario, 
                    self::$senha
                );
                self::$conexao->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $erro) {
                die("Deu ruim: ".$erro->getMessage());
            }
        }
        return self::$conexao;
    }
}