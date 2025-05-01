<?php

    use App\Controller\AlunoController;
    use App\Controller\AutorController;

    include "config.php"; //importa todos os dados dentro do arquivo config.php
    include "autoload.php";
    include "routes.php";

    new AlunoController();
    new AutorController();
?>