<?php 

namespace App\DAO;

use App\Model\Autor;

class AutorDAO extends DAO {

    public function __construct(){
        parent::__construct();
    }

    public function save(Autor $model): Autor {
        return $model->getId() == null ? ($this->insert($model)) : ($this->update($model));
    }

    public function insert(Autor $model): ?Autor {
        try {
            $sql = 'INSERT INTO autor (nome, data_nascimento, cpf) VALUES (?, ?, ?)';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getDataNascimento());
            $stmt->bindValue(3, $model->getCPF());
            $stmt->execute();

            $model->setId(parent::$conexion->lastInsertId());

            return $model;

        } catch (\Throwable $e) {
            echo "Erro ao tentar inserir novo autor: " . $e->getMessage();
            return null;
        }
    }

    public function update(Autor $model): ?Autor {
        try {
            $sql = 'UPDATE autor SET nome=?, data_nascimento=?, cpf=? WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getDataNascimento());
            $stmt->bindValue(3, $model->getCPF());
            $stmt->bindValue(4, $model->getId());
            $stmt->execute();

            return $model;
        } catch (\Throwable $e) {
            echo "Erro ao tentar atualizar autor: " . $e->getMessage();
            return null;
        }
    }

    public function selectById(int $id): ?Autor {
        try {
            $sql = 'SELECT * FROM autor WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(parent::FETCH_ASSOC);

            if ($row) {
                $autor = new Autor();
                $autor->setId((int)$row['id']);
                $autor->setNome($row['nome']);
                $autor->setDataNascimento($row['data_nascimento']);
                $autor->setCPF($row['cpf']);
                return $autor;
            } else {
                return null;
            }

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar autor por id: " . $e->getMessage();
            return null;
        }
    }

    public function selectAll(): ?array {
        try {
            $sql = 'SELECT * FROM autor';
        
            $stmt = parent::$conexion->prepare($sql);
            $stmt->execute();

            $dados = $stmt->fetchAll(parent::FETCH_ASSOC);

            $autores = [];

            foreach ($dados as $row) {
                $autor = new Autor();
                $autor->setId((int)$row['id']);
                $autor->setNome($row['nome']);
                $autor->setDataNascimento($row['data_nascimento']);
                $autor->setCPF($row['cpf']);
                $autores[] = $autor;
            }

            return $autores;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todos os autores: " . $e->getMessage();
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            $sql = 'DELETE FROM autor WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id);
            
            $stmt->execute();

            return true;

        } catch (\Throwable $e) {
            echo "Erro ao tentar deletar autor de id: " . $id . " | " . $e->getMessage();
            return false;
        }
    }

}

?>