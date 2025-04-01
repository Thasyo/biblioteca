<?php 
    // Arquivo responsável por dar o include automático das classes do projeto.

    // o spl_autoload_register vai procurar um arquivo com o mesmo nome da classe que for chamada. 
    spl_autoload_register(function ($className){
        $arquivo = BASE_DIR . '/' . $className . '.php';
        //echo $arquivo;

        if(file_exists($arquivo)){
            include $arquivo;
        }else{
            throw new Exception("Arquivo não encontrado!");
        }
    });
?>