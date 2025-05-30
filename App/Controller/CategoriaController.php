<?php 

    namespace App\Controller;

    use App\Model\Categoria;
    class CategoriaController extends Controller {

        public static function cadastro(): void {

            parent::isProtected();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $categoria = new Categoria();
                $categoria->setId(!empty($_POST['id']) ? $_POST['id'] : null);
                $categoria->setDescricao($_POST['descricao']);
                $categoria->save();

                header("Location: /categorias"); //redireciona para a rota /aluno

            }else{
                $model = new Categoria();

                if(isset($_GET['id'])){
                    $model = $model->getById((int) $_GET['id']);
                }

                include VIEWS . '/Categoria/form_categoria.php';
            }
        }
        
        public static function listar(): void {
            //echo "Listagem de Categorias";
            parent::isProtected();
            $categoria = new Categoria();
            $lista = $categoria->getAll();
            include VIEWS . '/Categoria/lista_categoria.php';
        }

        public static function deletar(): void {

            parent::isProtected();

            $categoria = new Categoria();

            $categoria->delete( (int) $_GET['id']);

            header('Location: /categorias');
        } 
    }
?>