<?php 
    // Arquivo responsável por conter as instâncias das classes de Controller.

    use App\Controller\{
        InicialController,
        LoginController,
        AlunoController,
        AutorController,
        CategoriaController,
        UsuarioController

    };

    $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //Pega toda a url até o ponto de interrogação da query string. Isso nos permite fazer o processo de navegação por rota.

    switch($url){

        //home
        case "/":
            InicialController::index();
            break;

        //login
        case "/login":
            LoginController::index();
            break;
        
        //logout
        case "/logout":
            LoginController::logout();
            break;

        //alunos
        case "/alunos":
            AlunoController::listar();
            break;

        case "/aluno/cadastro";
            AlunoController::cadastro();
            break;
        
        case "/aluno/deletar";
            AlunoController::deletar();
            break;

        //autores
        case "/autores":
            AutorController::listar();
            break;

        case "/autor/cadastro":
            AutorController::cadastro();
            break;

        case "/autor/deletar":
            AutorController::deletar();
            break;
        
        //Categoria
        case "/categorias":
            CategoriaController::listar();
            break;

        case "/categoria/cadastro":
            CategoriaController::cadastro();
            break;

        case "/categoria/deletar":
            CategoriaController::deletar();
            break;

        //Usuários
        case "/usuarios":
            UsuarioController::listar();
            break;

        case "/usuario/cadastro":
            UsuarioController::cadastro();
            break;
        case "/usuario/deletar":
            UsuarioController::deletar();
            break;

        //default padrão
        default:
            echo "Página não encontrada.";
            break;
    }
?>