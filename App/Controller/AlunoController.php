<?php 

    namespace App\Controller;

    use App\Model\Aluno;
use Exception;

    class AlunoController extends Controller {

        public static function index(): void {
            parent::isProtected();
            $model = new Aluno();

            try{
                $model->getAll();
            }catch(Exception $e){
                $model->setError("Ocorreu um erro ao tentar buscar os usuários. Tente novamente mais tarde!");
            }
            parent::render("Aluno/lista_aluno.php", $model);
        }

        public static function cadastro(): void {

            parent::isProtected();

            $model = new Aluno();

            try {
                if(parent::isPost()){
                
                $model->setId(!empty($_POST['id']) ? $_POST['id'] : null);
                $model->setNome($_POST['nome']);
                $model->setRA($_POST['ra']);
                $model->setCurso($_POST['curso']);
                $model->save();

                parent::redirect("/alunos"); //redireciona para a rota /aluno

                }else{
                    if(isset($_GET['id'])){
                        $model = $model->getById((int) $_GET['id']);
                    }                    
                }
            } catch (Exception $e) {
                $model->setError($e->getMessage());
            }

            parent::render("Aluno/form_aluno.php", $model);
            
        }

        public static function deletar(): void {
            
            parent::isProtected();

            $model = new Aluno();

            try{
                $model->delete( (int) $_GET['id']);
                parent::redirect("/alunos");
            }catch(Exception $e){
                $model->setError($e->getMessage());
            }

            parent::render("Aluno/lista_aluno.php", $model);
        } 
    }
?>