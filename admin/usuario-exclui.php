<?php

use Microblog\ControleDeAcesso;
use Microblog\Usuario;

require_once "../vendor/autoload.php"; //Não usa require cabeçalho

$sessao = new ControleDeAcesso;
$sessao->verificaAcesso();

$usuario = new Usuario;
$usuario->setId($_GET["id"]);
$usuario->excluir();
header("location:usuarios.php");

?>