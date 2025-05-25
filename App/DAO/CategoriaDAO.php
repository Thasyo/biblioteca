<?php 

namespace App\DAO;

use App\Model\Categoria;

class CategoriaDAO extends DAO {

    public function __construct(){
        parent::__construct();
    }

    public function save(Categoria $model): Categoria {
        return $model->getId() == null ? ($this->insert($model)) : ($this->update($model));
    }

    public function insert(Categoria $model): ?Categoria {
        try {
            $sql = 'INSERT INTO categoria (descricao) VALUES (?)';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getDescricao());
            $stmt->execute();

            $model->setId(parent::$conexion->lastInsertId());

            return $model;

        } catch (\Throwable $e) {
            echo "Erro ao tentar inserir nova categoria: " . $e->getMessage();
            return null;
        }
    }

    public function update(Categoria $model): ?Categoria {
        try {
            $sql = 'UPDATE categoria SET descricao=? WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getDescricao());
            $stmt->bindValue(2, $model->getId());
            $stmt->execute();

            return $model;
        } catch (\Throwable $e) {
            echo "Erro ao tentar atualizar categoria: " . $e->getMessage();
            return null;
        }
    }

    public function selectById(int $id): ?Categoria {
        try {
            $sql = 'SELECT * FROM categoria WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(parent::FETCH_ASSOC);

            if ($row) {
                $categoria = new Categoria();
                $categoria->setId((int)$row['id']);
                $categoria->setDescricao($row['descricao']);
                return $categoria;
            } else {
                return null;
            }

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar categoria por id: " . $e->getMessage();
            return null;
        }
    }

    public function selectAll(): ?array {
        try {
            $sql = 'SELECT * FROM categoria';
        
            $stmt = parent::$conexion->prepare($sql);
            $stmt->execute();

            $dados = $stmt->fetchAll(parent::FETCH_ASSOC);

            $categorias = [];

            foreach ($dados as $row) {
                $categoria = new Categoria();
                $categoria->setId((int)$row['id']);
                $categoria->setDescricao($row['descricao']);
                $categorias[] = $categoria;
            }

            return $categorias;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todas as categorias: " . $e->getMessage();
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            $sql = 'DELETE FROM categoria WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id);
            
            $stmt->execute();

            return true;

        } catch (\Throwable $e) {
            echo "Erro ao tentar deletar categoria de id: " . $id . " | " . $e->getMessage();
            return false;
        }
    }

}

?>