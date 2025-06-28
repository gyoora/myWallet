<?php
    class PerfilController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function mostrarTela() {
            require_once "Views/perfil.php";
        }

    }
?>