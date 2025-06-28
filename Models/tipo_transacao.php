<?php
    class Tipo_transacao {
        public function __construct(
            public int $id = 0,
            public string $tipo = "",
        ){}

        public function getId() {
            return $this->id;
        }
        public function getTipo() {
            return $this->tipo;
        }
    }

?>