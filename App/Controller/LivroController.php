<?php 

namespace App\Controller;

use App\Model\{
    Autor,
    Categoria,
    Livro
};
class LivroController extends Controller {

    public static function cadastro(): void {

        parent::isProtected();

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            $model = new Livro();
            $model->setId(!empty($_POST['id']) ? $_POST['id'] : null);
            $model->setTitulo($_POST['titulo']);
            $model->setISBN($_POST['isbn']);
            $model->setEditora($_POST['editora']);
            $model->setAno($_POST['ano']);
            $model->setIdCategoria($_POST['id_categoria']);
            $model->setIdAutores($_POST['autor']);

            $model->save();

            header("Location: /livros"); //redireciona para a rota /autores

        }else{
            $model = new Livro();

            if(isset($_GET['id'])){
                $model = $model->getById((int) $_GET['id']);
            }

            $model->setRowsCategoria(new Categoria()->getAll()); //obtendo a lista de categorias.
            $model->setRowsAutores(new Autor()->getAll()); //obtendo a lista de autores.

            include VIEWS . '/Livro/form_livro.php';
        }
    }

    public static function listar(): void {
        //echo "Listagem de livros";
        parent::isProtected();
        $model = new Livro();
        $lista = $model->getAll();
        include VIEWS . '/Livro/lista_livro.php';
    }

    public static function deletar(): void {

        parent::isProtected();

        $lista = new Livro();

        $lista->delete( (int) $_GET['id']);

        header('Location: /livros');
    } 

}

?>