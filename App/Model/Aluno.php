<?php 

namespace App\Model;

use App\DAO\AlunoDAO;

class Aluno extends Model{
    private ?int $id;
    private ?int $ra;
    private string $curso;
    private string $nome;

    public function __construct() {
        $this->id = null;
        $this->ra = null;
        $this->curso = '';
        $this->nome = '';
    }

    //Getters e Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getRA(): ?int {
        return $this->ra;
    }

    public function setRA(?int $ra): void {
        $this->ra = $ra;
    }

    public function getCurso(): string {
        return $this->curso;
    }

    public function setCurso(string $curso): void {
        $this->curso = $curso;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function setNome(string $nome): void {
        $this->nome = $nome;
    }

    //métodos adicionais
    public function save(): ?Aluno {
        return new AlunoDAO()->save($this); 
    }

    public function getById(int $id): ?Aluno {
        return new AlunoDAO()->selectById($id);
    }

    public function getAll(): ?array {
        return parent::setRows(new AlunoDAO()->selectAll());
    }

    public function delete(int $id): bool {
        return new AlunoDAO()->delete($id);
    }

}
?>