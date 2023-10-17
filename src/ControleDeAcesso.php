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
            header("location:../login.php");
            die();//exit
        }
    }

} 

?>