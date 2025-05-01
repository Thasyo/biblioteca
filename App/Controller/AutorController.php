<?php 

namespace App\Controller;

use App\Model\Autor;

class AutorController {

    public static function cadastro(): void {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $autor = new Autor();
            $autor->setId(!empty($_POST['id']) ? $_POST['id'] : null);
            $autor->setNome($_POST['nome']);
            $autor->setDataNascimento($_POST['data_nascimento']);
            $autor->setCPF($_POST['cpf']);
            $autor->save();

            header("Location: /autores"); //redireciona para a rota /autores

        }else{
            $model = new Autor();

            if(isset($_GET['id'])){
                $model = $model->getById((int) $_GET['id']);
            }

            include VIEWS . '/Autor/form_autor.php';
        }
    }

    public static function listar(): void {
        //echo "Listagem de autores";
        $autor = new Autor();
        $lista = $autor->getAll();
        include VIEWS . '/Autor/lista_autor.php';
    }

    public static function deletar(): void {
        $aluno = new Autor();

        $aluno->delete( (int) $_GET['id']);

        header('Location: /autores');
    } 

}

?>