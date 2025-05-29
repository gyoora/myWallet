<?php
    class myWalletController {
        private $db;

        public function __construct()
        {
            $this->db = Conexao::getInstancia();
        }

        public function cadastrar() {
            $msg = ["", "", "", ""];
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $senha_hash = md5($_POST["senha"]);
                $usuario = new Usuarios(0, $_POST["nome"], $_POST["email"], $senha_hash);
                
                $usuarioDAO = new UsuariosDAO($this->db);
                $emailCadastrado = $usuarioDAO->emailCadastrado($usuario);

                // var_dump($emailCadastrado);

                $valido = true;
                if(empty($usuario->nome) || $usuario->nome == "") {
                $msg[0] = "Insira o nome de usuário.";
                $valido = false;
                } else {
                $msg[0] = "";
                }
                if(empty($usuario->email) || $usuario->email == "") {
                    $msg[1] = "Insira seu email.";
                    $valido = false;
                } else {
                    $msg[1] = "";
                }
                if($emailCadastrado == true) {
                    $msg[2] = "Email já cadastrado.";
                    $valido = false;
                } else {
                    $msg[2] = "Email já cadastrado.";
                }                
                if(empty($_POST["senha"]) || $_POST["senha"] == 0) {
                    $msg[3] = "A senha é obrigatória.";
                    $valido = false;
                } else {
                    $msg[3] = "";
                }
                if($valido) {
                    $usuarioDAO = new UsuariosDAO($this->db);
                    $usuarioDAO->cadastrar($usuario);

                    require_once "Views/login.php"; 
                    header("Location: login");
                }  

                require_once "Views/cadastro.php";
            } else {
                require_once "Views/cadastro.php";
            }
        }

        public function login() {
            $msg = ["", "", ""]; // [0]email, [1]senha, [2]erro geral
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $senha_hash = md5($_POST["senha"]);
                $usuario = new Usuarios(0, "", $_POST["email"], $senha_hash);
                $valido = true;

                if (empty($usuario->email)) {
                    $msg[0] = "Insira seu email.";
                    $valido = false;
                } else {
                    $msg[0] = "";   
                }

                if (empty($_POST["senha"])) {
                    $msg[1] = "Insira sua senha.";
                    $valido = false;
                } else {
                    $msg[1] = "";
                }

                if ($valido) {
                    $usuarioDAO = new UsuariosDAO($this->db);
                    $login = $usuarioDAO->login($usuario);

                    if ($login) {
                        session_start();
                        $_SESSION["usuario"] = $login;

                        $ret = $usuarioDAO->dadosUsuario($login->id);

                        if($ret) {
                            $_SESSION['id'] = $ret['id'];
                            $_SESSION['nome'] = $ret['nome'];
                            $_SESSION['email'] = $ret['email'];
                        }

                        require_once "Views/dashboard.php";
                        header("Location: dashboard");
                        exit;
                    } else {
                        $msg[2] = "Email ou senha incorretos. Verifique os dados inseridos.";
                    }
                }
                require_once "Views/login.php";
            } else {
                require_once "Views/login.php";
            }
        }

        public function dashboard() {
            require_once "Views/dashboard.php";
        }
    }
?>