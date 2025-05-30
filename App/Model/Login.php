<?php 

namespace App\Model;

use App\DAO\LoginDAO;

class Login {

    private string $email;
    private string $senha;

    public function __construct() {
        $this->email = '';
        $this->senha = '';
    }

    //getters e setters
    public function getEmail(): string {
        return $this->email;
    }

    public function setEmail(string $email): void {
        $this->email = $email;
    }

        public function getSenha(): string {
        return $this->senha;
    }

    public function setSenha(string $senha): void {
        $this->senha = $senha;
    }

    //métodos adicionais
    public function logar(): ?Login {
        return new LoginDAO()->autenticar($this);
    }

}

?>