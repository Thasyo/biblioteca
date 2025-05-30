<?php 

namespace App\DAO;

use App\Model\Usuario;

class UsuarioDAO extends DAO {

    public function __construct(){
        parent::__construct();
    }

    public function save(Usuario $model): Usuario {
        return $model->getId() == null ? ($this->insert($model)) : ($this->update($model));
    }

    public function insert(Usuario $model): ?Usuario {
        try {
            $sql = 'INSERT INTO usuario (nome, email, senha) VALUES (?, ?, ?)';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getEmail());
            //criptografando senha antes de salvar.
            $passwordHash = password_hash($model->getSenha(), PASSWORD_DEFAULT);
            $stmt->bindValue(3, $passwordHash);
            $stmt->execute();

            $model->setId(parent::$conexion->lastInsertId());

            return $model;

        } catch (\Throwable $e) {
            echo "Erro ao tentar inserir novo usuário: " . $e->getMessage();
            return null;
        }
    }

    public function update(Usuario $model): ?Usuario {
        try {
            $sql = 'UPDATE usuario SET nome=?, email=?, senha=? WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $model->getNome());
            $stmt->bindValue(2, $model->getEmail());
            //criptografando senha antes de salvar.
            $passwordHash = password_hash($model->getSenha(), PASSWORD_DEFAULT);
            $stmt->bindValue(3, $passwordHash);
            $stmt->bindValue(4, $model->getId());
            $stmt->execute();

            return $model;
        } catch (\Throwable $e) {
            echo "Erro ao tentar atualizar usuário: " . $e->getMessage();
            return null;
        }
    }

    public function selectById(int $id): ?Usuario {
        try {
            $sql = 'SELECT * FROM usuario WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id, parent::PARAM_INT);
            $stmt->execute();

            $row = $stmt->fetch(parent::FETCH_ASSOC);

            if ($row) {
                $usuario = new Usuario();
                $usuario->setId((int)$row['id']);
                $usuario->setNome($row['nome']);
                $usuario->setEmail($row['email']);
                $usuario->setSenha($row['senha']);
                return $usuario;
            } else {
                return null;
            }

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar usuario por id: " . $e->getMessage();
            return null;
        }
    }

    public function selectAll(): ?array {
        try {
            $sql = 'SELECT * FROM usuario';
        
            $stmt = parent::$conexion->prepare($sql);
            $stmt->execute();

            $dados = $stmt->fetchAll(parent::FETCH_ASSOC);

            $usuarios = [];

            foreach ($dados as $row) {
                $usuario = new Usuario();
                $usuario->setId((int)$row['id']);
                $usuario->setNome($row['nome']);
                $usuario->setEmail($row['email']);
                $usuario->setSenha($row['senha']);
                $usuarios[] = $usuario;
            }

            return $usuarios;

        } catch (\Throwable $e) {
            echo "Erro ao tentar buscar todos os usuarios: " . $e->getMessage();
            return null;
        }
    }

    public function delete(int $id): bool {
        try {
            $sql = 'DELETE FROM usuario WHERE id=?';
        
            $stmt = parent::$conexion->prepare($sql);

            $stmt->bindValue(1, $id);
            
            $stmt->execute();

            return true;

        } catch (\Throwable $e) {
            echo "Erro ao tentar deletar usuario de id: " . $id . " | " . $e->getMessage();
            return false;
        }
    }

}

?>