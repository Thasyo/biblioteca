<?php 

    namespace App\Controller;

    use App\Model\Aluno;
    class AlunoController extends Controller {

        public static function cadastro(): void {

            parent::isProtected();

            if($_SERVER['REQUEST_METHOD'] == 'POST'){
                $aluno = new Aluno();
                $aluno->setId(!empty($_POST['id']) ? $_POST['id'] : null);
                $aluno->setNome($_POST['nome']);
                $aluno->setRA($_POST['ra']);
                $aluno->setCurso($_POST['curso']);
                $aluno->save();

                header("Location: /alunos"); //redireciona para a rota /aluno

            }else{
                $model = new Aluno();

                if(isset($_GET['id'])){
                    $model = $model->getById((int) $_GET['id']);
                }

                include VIEWS . '/Aluno/form_aluno.php';
            }
        }
        
        public static function listar(): void {
            //echo "Listagem de alunos";
            parent::isProtected();
            $aluno = new Aluno();
            $lista = $aluno->getAll();
            include VIEWS . '/Aluno/lista_aluno.php';
        }

        public static function deletar(): void {
            
            parent::isProtected();

            $aluno = new Aluno();

            $aluno->delete( (int) $_GET['id']);

            header('Location: /alunos');
        } 
    }
?>