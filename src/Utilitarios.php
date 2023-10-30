<?php
namespace Microblog;

abstract class Utilitarios{
    //Usamos o operador OU quando o parametro pode receber tipos de dados diferentes de acordo com a chamada. Sintaxe php 7.4
    public static function dump(array | bool | object $dados): void{ 
        echo "<pre>";
        var_dump($dados);
        echo"</pre>";

    }


    public static function formataData(string $data):string {
        return date("d/m/Y H:i", strtotime($data));
    }
}
?>