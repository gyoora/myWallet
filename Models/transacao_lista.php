<?php
    class TransacaoLista {

        public function __construct(
            public int $id = 0,
            public string $tipo = 0,
            public string $data = "",
            public string $descricao = "",
            public float $valor = 0,
        ){}

        public function getId() {
            return $this->id;
        }
        public function getTipo() {
            return $this->tipo;
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
    }

?>