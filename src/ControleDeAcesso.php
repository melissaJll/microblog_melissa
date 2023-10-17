<?php
namespace Microblog;
final class ControleDeAcesso{
    public function __construct() {
        //se não existir uma sessão em "andamento"
        if(!isset($_SESSION)){
            //então inicialize uma sessão
            session_start();
        }
    }

    public function verificaAcesso():void{
        //Se não existir uma variável de sessão chamada 'id' (ussuario ainda não fez login)
        if (!isset($_SESSION['id'])){
            // ... então destrua qualquer resquicio de sessão, redirecione para login, e pare completamente o script
            session_destroy();
            header("location:../login.php?acesso_proibido");
            die();//exit
        }
    }

    public function login(int $id, string $nome, string $tipo): void{
        //SESSION Funciona como array associativo 
        //No mommento que ocorre o login, criamos variáveis de sessão contetndo os dados que queremos monitorar/controlar através da sessão enquanto estiver logada
        //Vão ser acessadas pelo index
        //var      = valor; 
        $_SESSION["id"] = $id;
        $_SESSION["nome"] = $nome;
        $_SESSION["tipo"] = $tipo;
    }

    public function logout(): void{
        session_start();
        session_destroy();
        header("location:../login.php?logout");
        die();
    }

} 

?>