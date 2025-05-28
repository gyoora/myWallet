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

        public function cadastrar() {
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $valido = true;
                if(empty($_POST["nome"]) || $_POST["nome"] == 0) {
                    $valido = false;
                }
                if(empty($_POST["email"]) || $_POST["email"] == 0) {
                    $valido = false;
                }
                if(empty($_POST["senha"]) || $_POST["senha"] == 0) {
                    $valido = false;
                }

                if($valido) {
                    $usuarioDAO = new UsuariosDAO($this->db);
                    
                    $usuario = new Usuarios(0, $_POST['nome'], $_POST['email'], $_POST['senha']);

                    $usuarioDAO->cadastrar($usuario);

                    header("Location: login");
                }
            }
        }

        public function telaLogin() {
            require_once "Views/login.php";
        }
    }
?>