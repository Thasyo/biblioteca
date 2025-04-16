<?php

namespace App\DAO;

use App\Model\Aluno;
class AlunoDAO extends DAO {

    public function __construct(){
        parent::__construct();
    }

    public function save(Aluno $model): Aluno {
        return $model->getId() == null ? ($this->insert($model)) : ($this->update($model));
    }

    public function insert(Aluno $model): ?Aluno {
        try {
            $sql = 'INSERT INTO aluno (nome, ra, curso) VALUES (?, ?, ?)';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getRA());
            $stmt->bindValue(3, $model->getCurso());
            $stmt->execute();

            $model->setId(parent::$conexion->lastInsertId());

            return $model;

        } catch (\Throwable $e) {
            echo "Erro ao tentar inserir novo aluno: " . $e->getMessage();
            return null;
        }
    }

    public function update(Aluno $model): ?Aluno {
        try {
            $sql = 'UPDATE aluno SET nome=?, ra=?, curso=? WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getRA());
            $stmt->bindValue(3, $model->getCurso());
            $stmt->bindValue(4, $model->getId());
            $stmt->execute();

            return $model;
        } catch (\Throwable $e) {
            echo "Erro ao tentar atualizar aluno: " . $e->getMessage();
            return null;
        }
    }

    public function selectById(int $id): ?Aluno {
        try {
            $sql = 'SELECT * FROM aluno WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(parent::FETCH_ASSOC);

            if ($row) {
                $aluno = new Aluno();
                $aluno->setId((int)$row['id']);
                $aluno->setRA((int)$row['ra']);
                $aluno->setCurso($row['curso']);
                $aluno->setNome($row['nome']);
                return $aluno;
            } else {
                return null;
            }

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar aluno por id: " . $e->getMessage();
            return null;
        }
    }

    public function selectAll(): ?array {
        try {
            $sql = 'SELECT * FROM aluno';
        
            $stmt = parent::$conexion->prepare($sql);
            $stmt->execute();

            $dados = $stmt->fetchAll(parent::FETCH_ASSOC);

            $alunos = [];

            foreach ($dados as $row) {
                $aluno = new Aluno();
                $aluno->setId((int)$row['id']);
                $aluno->setRA((int)$row['ra']);
                $aluno->setCurso($row['curso']);
                $aluno->setNome($row['nome']);
                $alunos[] = $aluno;
            }

            return $alunos;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todos os alunos: " . $e->getMessage();
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            $sql = 'DELETE FROM aluno WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id);
            
            $stmt->execute();

            return true;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todos os alunos: " . $e->getMessage();
            return false;
        }
    }

}
?>