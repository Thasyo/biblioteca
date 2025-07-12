<?php 

namespace App\Model;

use App\DAO\LivroDAO;

class Livro extends Model{
    private ?int $id;
    private string $titulo;
    private string $isbn;
    private string $editora;
    private string $ano;
    private array $rows_categorias;
    private ?int $id_categoria;
    private array $rows_autores;
    private array $id_autores;

    public function __construct() {
        $this->id = null;
        $this->titulo = '';
        $this->isbn = '';
        $this->editora = '';
        $this->ano = '';
        $this->rows_categorias = [];
        $this->rows_autores = [];
        $this->id_autores = [];
        $this->id_categoria = null;
    }

    //Getters e Setters
    public function getId(): ?int {
        return $this->id;
    }

    public function setId(?int $id): void {
        $this->id = $id;
    }

    public function getTitulo(): string {
        return $this->titulo;
    }

    public function setTitulo(string $titulo): void {
        $this->titulo = $titulo;
    }

    public function getISBN(): string {
        return $this->isbn;
    }

    public function setISBN(string $isbn): void {
        $this->isbn = $isbn;
    }

    public function getEditora(): string {
        return $this->editora;
    }

    public function setEditora(string $editora): void {
        $this->editora = $editora;
    }

    public function getAno(): string {
        return $this->ano;
    }

    public function setAno(string $ano): void {
        $this->ano = $ano;
    }

    public function getRowsCategoria(): ?array {
        return $this->rows_categorias;
    }

    public function setRowsCategoria(?array $rows_categorias): void {
        $this->rows_categorias = $rows_categorias;
    }

    public function getIdCategoria(): ?int {
        return $this->id_categoria;
    }

    public function setIdCategoria(?int $id_categoria): void {
        $this->id_categoria = $id_categoria;
    }

    public function getRowsAutores(): ?array {
        return $this->rows_autores;
    }

    public function setRowsAutores(?array $rows_autores): void {
        $this->rows_autores = $rows_autores;
    }

    public function getIdAutores(): ?array {
        return $this->id_autores;
    }

    public function setIdAutores(?array $id_autores): void {
        $this->id_autores = $id_autores;
    }

    //métodos adicionais
    public function save(): ?Livro {
        return new LivroDAO()->save($this); 
    }

    public function getById(int $id): ?Livro {
        return new LivroDAO()->selectById($id);
    }

    public function getAll(): ?array {
        return (new LivroDAO())->selectAll();
    }

    public function delete(int $id): bool {
        return new LivroDAO()->delete($id);
    }

}
?>