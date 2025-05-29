<?php
    class Meses {
        public function __construct(
            public int $id = 0,
            public string $mes = "",
        ){}

        public function getId() {
            return $this->id;
        }
        public function getMes() {
            return $this->mes;
        }
    }

?>