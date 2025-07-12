<?php 

namespace App\DAO;

use App\Model\Livro;

class LivroDAO extends DAO {

        public function __construct(){
            parent::__construct();
        }

    public function save(Livro $model): Livro {
        return $model->getId() == null ? ($this->insert($model)) : ($this->update($model));
    }

    public function insert(Livro $model): ?Livro {
        try {

            parent::$conexion->beginTransaction();

            $sql = 'INSERT INTO livro (titulo, isbn, editora, ano, id_categoria) VALUES (?, ?, ?, ?, ?)';
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $model->getTitulo());
            $stmt->bindValue(2, $model->getISBN());
            $stmt->bindValue(3, $model->getEditora());
            $stmt->bindValue(4, $model->getAno());
            $stmt->bindValue(5, $model->getIdCategoria());
            $stmt->execute();
            $model->setId(parent::$conexion->lastInsertId());

            foreach($model->getIdAutores() as $autor){
                $sql = 'INSERT INTO livro_autor (id_livro, id_autor) VALUES (?, ?)';
                $stmt = parent::$conexion->prepare($sql);
                $stmt->bindValue(1, $model->getId());
                $stmt->bindValue(2, $autor);
                $stmt->execute();
            }

            parent::$conexion->commit();

            return $model;

        } catch (\Throwable $e) {
            echo "Erro ao tentar inserir novo livro: " . $e->getMessage();
            return null;
        }
    }

    public function update(Livro $model): ?Livro {
        try {

            parent::$conexion->beginTransaction();

            $sql = 'UPDATE livro SET titulo=?, isbn=?, editora=?, ano=?, id_categoria=? WHERE id=?';
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $model->getTitulo());
            $stmt->bindValue(2, $model->getISBN());
            $stmt->bindValue(3, $model->getEditora());
            $stmt->bindValue(4, $model->getAno());
            $stmt->bindValue(5, $model->getIdCategoria());
            $stmt->bindValue(6, $model->getId());
            $stmt->execute();

            $sql = "DELETE FROM livro_autor WHERE id_livro=?";
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1,$model->getId());
            $stmt->execute();

            foreach($model->getIdAutores() as $autor){
                $sql = 'INSERT INTO livro_autor (id_livro, id_autor) VALUES (?, ?)';
                $stmt = parent::$conexion->prepare($sql);
                $stmt->bindValue(1, $model->getId());
                $stmt->bindValue(2, $autor);
                $stmt->execute();
            }

            parent::$conexion->commit();

            return $model;
        } catch (\Throwable $e) {
            echo "Erro ao tentar atualizar livro: " . $e->getMessage();
            return null;
        }
    }

    public function selectById(int $id): ?Livro {
        try {
            $sql = 'SELECT * FROM livro WHERE id=?';
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(parent::FETCH_ASSOC);

            if (!$row) {
                return null;
            }

            // Cria o objeto Livro com os dados da tabela 'livro'
            $livro = new Livro();
            $livro->setId((int)$row['id']);
            $livro->setTitulo($row['titulo']);
            $livro->setISBN($row['isbn']);
            $livro->setEditora($row['editora']);
            $livro->setAno($row['ano']);
            $livro->setIdCategoria($row['id_categoria']);

            // Agora buscamos os autores relacionados
            $sql = "SELECT id_autor FROM livro_autor WHERE id_livro=?";
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();
            $livro_autores = $stmt->fetchAll(parent::FETCH_ASSOC);

            // Define os IDs dos autores no modelo
            $autores_ids = array_column($livro_autores, 'id_autor');
            $livro->setIdAutores($autores_ids);

            return $livro;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar livro por id: " . $e->getMessage();
            return null;
        }
    }


    public function selectAll(): ?array {
        try {
            $sql = 'SELECT * FROM livro';
        
            $stmt = parent::$conexion->prepare($sql);
            $stmt->execute();

            $dados = $stmt->fetchAll(parent::FETCH_ASSOC);

            $livros = [];

            foreach ($dados as $row) {
                $livro = new Livro();
                $livro->setId((int)$row['id']);
                $livro->setTitulo($row['titulo']);
                $livro->setISBN($row['isbn']);
                $livro->setEditora($row['editora']);
                $livro->setAno($row['ano']);
                $livro->setIdCategoria($row['id_categoria']);
                $livros[] = $livro;
            }

            return $livros;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todos os livros: " . $e->getMessage();
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            parent::$conexion->beginTransaction();

            // 1. Remove os autores vinculados (tabela livro_autor)
            $sql = 'DELETE FROM livro_autor WHERE id_livro = ?';
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            // 2. Agora remove o livro
            $sql = 'DELETE FROM livro WHERE id = ?';
            $stmt = parent::$conexion->prepare($sql);
            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            parent::$conexion->commit();

            return true;

        } catch (\Throwable $e) {
            parent::$conexion->rollBack();
            echo "Erro ao tentar deletar livro de id: " . $id . " | " . $e->getMessage();
            return false;
        }
    }


}

?>