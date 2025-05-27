<?php
    class myWalletController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function telaCadastro() {
            require_once "Views/cadastro.php";
        }

        public function telaLogin() {
            require_once "Views/login.php";
        }
    }
?>