<?php
    class Usuarios {
        public function __construct(
            public int $id = 0,
            public string $nome = "",
            public string $email = "",
            public string $senha = ""
        ){}

        public function getId() {
            return $this->id;
        }
        public function getNome() {
            return $this->nome;
        }
        public function getEmail() {
            return $this->email;
        }
        public function getSenha() {
            return $this->senha;
        }
    }

?>