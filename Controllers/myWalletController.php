<?php
    class myWalletController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function cadastrar() {
            $msg = ["","",""];
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $valido = true;
                if(empty($_POST["nome"]) || $_POST["nome"] == 0) {
                    $msg[0] = "Insira o nome de usuário.";
                    $valido = false;
                } else {
                    $msg[0] = "";
                }
                if(empty($_POST["email"]) || $_POST["email"] == 0) {
                    $msg[1] = "Insira seu email.";
                    $valido = false;
                } else {
                    $msg[1] = "";
                }
                if(empty($_POST["senha"]) || $_POST["senha"] == 0) {
                    $msg[2] = "A senha é obrigatória.";
                    $valido = false;
                } else {
                    $msg[2] = "";
                }

                if($valido) {
                    $usuarioDAO = new UsuariosDAO($this->db);

                    $senha_hash = md5($_POST['senha']);
                    
                    $usuario = new Usuarios(0, $_POST['nome'], $_POST['email'], $senha_hash);

                    $usuarioDAO->cadastrar($usuario);

                    require_once "Views/login.php"; 
                    header("Location: login");
                }

                require_once "Views/cadastro.php";
            } else {
                require_once "Views/cadastro.php";
            }
        }

        public function telaLogin() {
            require_once "Views/login.php";
        }
    }
?>