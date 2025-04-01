<?php

    use App\Controller\AlunoController;

    include "config.php"; //importa todos os dados dentro do arquivo config.php
    include "autoload.php";
    include "routes.php";

    new AlunoController();
?>