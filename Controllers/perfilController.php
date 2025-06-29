<?php
    class PerfilController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function mostrarTela() {
            session_start();
            require_once "Views/perfil.php";
        }

        public function alterarNome() {
            session_start();
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $usuarioId = $_SESSION['usuario']->id;
                $usuario = new Usuarios($_POST["id"] ?? 0, $_POST['novo_nome']);
                $valido = true;
                if(empty($usuario->id) || $usuario->id <= 0) {
                    $msg[0] = "Faça o login em sua conta.";
                    $valido = false;
                } else {
                    $msg[0] = "";
                }
                if(empty($usuario->nome)) {
                    $msg[1] = "Insira o novo nome de usuário.";
                    $valido = false;
                } else {
                    $msg[1] = "";
                }
                if($valido) {
                    $perfilDAO = new PerfilDAO($this->db);
                    $perfilDAO->alterarNomeUsuario($usuario);
                    header("location: perfil");
                }
            }
            require_once "Views/alterar_nome.php";
        }

    }
?>