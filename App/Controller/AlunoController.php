<?php 

    namespace App\Controller;

    use App\Model\Aluno;
    class AlunoController {

        public static function cadastro(): void {
            $aluno = new Aluno();
            $aluno->setNome("Thasyo");
            $aluno->setRA(12345);
            $aluno->setCurso("Engenharia de Software");
            $aluno->save();

            echo 'Aluno inserido!';
        }
        
        public static function listar(): void {
            echo "Listagem de alunos";
            $aluno = new Aluno();
            $lista = $aluno->getAll();
            var_dump($lista);
        }
    }
?>