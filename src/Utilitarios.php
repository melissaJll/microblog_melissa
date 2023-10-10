<?php
namespace Microblog;

abstract class Utilitarios{
    //Usamos o operador OU quando o parametro pode receber tipos de dados diferentes de acordo com a chamada. Sintaxe php 7.4
    public static function dump(array | bool $dados): void{ 
        echo "<pre>";
        var_dump($dados);
        echo"</pre>";

    }
}
?>