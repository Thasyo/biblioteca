<?php 
namespace App\Controller;

final class InicialController{

    public static function index(): void {
        include VIEWS . '/Inicial/home.php'; // mostra a página inicial pelo caminho disposto.
    }

}
?>