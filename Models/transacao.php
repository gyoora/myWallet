<?php
    class Transacao {

        public function __construct(
            public int $id = 0,
            public Tipo_transacao $tipo,
            public string $data = "",
            public string $descricao = "",
            public float $valor = 0,
            public Usuarios $usuario
        ){}
    }


?>