<?php 

namespace App\Model;

use App\DAO\CategoriaDAO;

class Categoria {

    private ?int $id;
    private string $descricao;

    public function __construct() {
        $this->id = null;
        $this->descricao = '';
    }

    //Getters e Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getDescricao(): string {
        return $this->descricao;
    }

    public function setDescricao(string $descricao): void {
        $this->descricao = $descricao;
    }

    //métodos adicionais
    public function save(): ?Categoria {
        return new CategoriaDAO()->save($this); 
    }

    public function getById(int $id): ?Categoria {
        return new CategoriaDAO()->selectById($id);
    }

    public function getAll(): ?array {
        return new CategoriaDAO()->selectAll();
    }

    public function delete(int $id): bool {
        return new CategoriaDAO()->delete($id);
    }

}

?>