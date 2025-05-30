<?php

    session_start();

    use App\Controller\AlunoController;
    use App\Controller\AutorController;
    use App\Controller\CategoriaController;
    use App\Controller\UsuarioController;

    include "config.php"; //importa todos os dados dentro do arquivo config.php
    include "autoload.php";
    include "routes.php";

    new AlunoController();
    new AutorController();
    new CategoriaController();
    new UsuarioController();
?>