<?php

namespace App\DAO;

use App\Model\Login;

class LoginDAO extends DAO {

    public function __construct(){
        parent::__construct();
    }

        public function autenticar(Login $model): ?Login {
            try {
                $sql = 'SELECT * FROM usuario WHERE email=?';
            
                $stmt = parent::$conexion->prepare($sql);

                $stmt->bindValue(1, $model->getEmail());
                $stmt->execute();

                $row = $stmt->fetch(parent::FETCH_ASSOC);

                if ($row && password_verify($model->getSenha(), $row['senha'])) {
                    $login = new Login();
                    $login->setEmail($row['email']);
                    return $login;
                } else {
                    return null;
                }

            } catch (\Throwable $e) {
                echo "Erro ao tentar buscar usuário logado: " . $e->getMessage();
                return null;
            }
        }


}

?>