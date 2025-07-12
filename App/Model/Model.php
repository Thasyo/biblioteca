<?php 

    namespace App\Model;

    abstract class Model{

        private array $rows = [];
        private string $error = "";

        final public function getRows(): array {
            return $this->rows;
        }

        final public function setRows(array $lista): void {
            $this->rows = $lista;
        }

        public function getError(): string {
            $message = "<p>";
            $message .= $this->error;
            $message .= "</p>";
            
            return $message;
        }

        public function setError(string $message): void {
            $this->error = $message;
        }

    }

?>