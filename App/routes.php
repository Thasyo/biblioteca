<?php 
    // Arquivo responsável por conter as instâncias das classes de Controller.

    use App\Controller\{
        AlunoController,
        AutorController,
        InicialController
    };

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //Pega toda a url até o ponto de interrogação da query string. Isso nos permite fazer o processo de navegação por rota.

    switch($url){
        case "/":
            InicialController::index();
            break;

        case "/alunos":
            AlunoController::listar();
            break;

        case "/aluno/cadastro";
            AlunoController::cadastro();
            break;
        
        case "/aluno/deletar";
            AlunoController::deletar();
            break;

        case "/autores":
            AutorController::listar();
            break;

        case "/autor/cadastro":
            AutorController::cadastro();
            break;

        case "/autor/deletar":
            AutorController::deletar();
            break;

        default:
            echo "Página não encontrada.";
            break;
    }
?>