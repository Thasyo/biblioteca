<?php 
    // Arquivo responsável por conter as instâncias das classes de Controller.

    use App\Controller\AlunoController;

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //Pega toda a url até o ponto de interrogação da query string. Isso nos permite fazer o processo de navegação por rota.

    switch($url){
        case "/":
            echo "Página inicial";
            break;

        case "/aluno":
            AlunoController::listar();
            break;

        case "/aluno/cadastro";
            AlunoController::cadastro();
            break;

        default:
            echo "Página não encontrada.";
            break;
    }
?>