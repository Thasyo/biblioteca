<?php 

namespace App\Controller;

use App\Model\Usuario;

class UsuarioController {

    public static function cadastro(): void {
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $usuario = new Usuario();
            $usuario->setId(!empty($_POST['id']) ? $_POST['id'] : null);
            $usuario->setNome($_POST['nome']);
            $usuario->setEmail($_POST['email']);
            $usuario->setSenha($_POST['senha']);
            $usuario->save();

            header("Location: /usuarios"); //redireciona para a rota /usuarios

        }else{
            $model = new Usuario();

            if(isset($_GET['id'])){
                $model = $model->getById((int) $_GET['id']);
            }

            include VIEWS . '/Usuario/form_usuario.php';
        }
    }

    public static function listar(): void {
        //echo "Listagem de usuarios";
        $usuario = new Usuario();
        $lista = $usuario->getAll();
        include VIEWS . '/Usuario/lista_usuario.php';
    }

    public static function deletar(): void {
        $aluno = new Usuario();

        $aluno->delete( (int) $_GET['id']);

        header('Location: /usuarios');
    } 

}

?>