<?php 

    namespace App\Controller;

    abstract class Controller{

        protected static function isProtected(): void {
            if(!isset($_SESSION['usuario_logado'])){
                header('Location: /login');
            }
        } 

    }

?>