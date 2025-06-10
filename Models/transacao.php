<?php
    class Transacao {

        public function __construct(
            public int $id = 0,
            public int $id_tipo = 0,
            public string $data = "",
            public string $descricao = "",
            public float $valor = 0,
            public Usuarios $usuario = new Usuarios()
        ){}

        public function getId() {
            return $this->id;
        }
        public function getIdTipo() {
            return $this->id_tipo;
        }
        public function getData() {
            return $this->data;
        }
        public function getDescricao() {
            return $this->descricao;
        }
        public function getValor() {
            return $this->valor;
        }
        public function getUsuario() {
            return $this->usuario;
        }
    }


?>