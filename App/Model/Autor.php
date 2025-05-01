<?php 

namespace App\Model;

use App\DAO\AutorDAO;

class Autor {

    private ?int $id;
    private string $nome;
    private string $data_nascimento;
    private string $cpf;

    public function __construct() {
        $this->id = null;
        $this->nome = '';
        $this->data_nascimento = '';
        $this->cpf = '';
    }

    //Getters e Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    public function getDataNascimento(): string {
        return $this->data_nascimento;
    }

    public function setDataNascimento(string $data_nascimento): void {
        $this->data_nascimento = $data_nascimento;
    }

    public function getCPF(): string {
        return $this->cpf;
    }

    public function setCPF(string $cpf): void {
        $this->cpf = $cpf;
    }

    //métodos adicionais
    public function save(): ?Autor {
        return new AutorDAO()->save($this); 
    }

    public function getById(int $id): ?Autor {
        return new AutorDAO()->selectById($id);
    }

    public function getAll(): ?array {
        return new AutorDAO()->selectAll();
    }

    public function delete(int $id): bool {
        return new AutorDAO()->delete($id);
    }

}

?>