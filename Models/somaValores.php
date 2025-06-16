<?php
    class SomaValores {
        public function __construct(
            public string $mes = 0,
            public Usuarios $id_usuario = new Usuarios(),
            public Tipo_transacao $tipo = new Tipo_transacao()
        ){}

        public function getMes() {
            return $this->mes;
        }
        public function getIdUsuario() {
            return $this->id_usuario;
        }
        public function getTipo() {
            return $this->tipo;
        }
    }
?>