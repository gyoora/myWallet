<?php
    class ValoresController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function mostrarValores() {
            

            require_once 'Views/dashboard.php';
        }

    }
?>