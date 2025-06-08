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
                    $msg[2] = "";
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
            }
            require_once "Views/cadastro.php";
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

                        $ret = $usuarioDAO->dadosUsuario($login->id);

                        if($ret) {
                            $_SESSION['usuario'] = $ret;
                        }

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
            session_start();
            $mesesDAO = new MesesDAO($this->db);
            $ret = $mesesDAO->mostrarMeses();
            $dashboardDAO = new DashboardDAO($this->db);
            $dadostransacao = $dashboardDAO->mostrarTransaçoes($_SESSION['usuario']->id);
            require_once "Views/dashboard.php";
        }

        public function addTransacao() {
            session_start();
            $tipoDAO = new Tipo_transacaoDAO($this->db);
            $ret = $tipoDAO->mostrarTipos();
            $msg = ["", "", "", ""];
            if($_SERVER["REQUEST_METHOD"] == "POST") {
                $transacao = new Transacao(0, $_POST["tipo"] ?? 0, $_POST["data"], $_POST["descricao"], $_POST["valor"] == '' ? 0 : $_POST["valor"], $_SESSION['usuario']->id);
                $valido = true;
                if(empty($transacao->id_tipo) || $transacao->id_tipo <= 0) {
                    $msg[0] = "Selecione o tipo da transação.";
                    $valido = false;
                } else {
                    $msg[0] = "";
                }

                if(empty($transacao->data)) {
                    $msg[1] = "Insira a data em que foi feita a transação.";
                    $valido = false;
                } else {
                    $msg[1] = "";
                }
                if(empty($transacao->descricao)) {
                    $msg[2] = "Insira a descrição.";
                    $valido = false;
                } else {
                    $msg[2] = "";
                }
                if(empty($transacao->valor) || $transacao->valor <= 0) {
                    $msg[3] = "Insira o valor da transação. Ele deve ser maior que R$ 0,00.";
                    $valido = false;
                } else {
                    $msg[3] = "";
                }

                if($valido) {
                    $dashboardDAO = new DashboardDAO($this->db);
                    $dashboardDAO->addTransacao($transacao);
                    header("Location: dashboard");
                }
            }
            require_once "Views/form_transacao.php";
        }

        public function deletarTransacao() {
            session_start();

            if (!isset($_SESSION['usuario'])) {
                header("Location: login");
                exit;
            }

            if (isset($_GET['id'])) {
                $idTransacao = intval($_GET['id']);
                $dashboardDAO = new DashboardDAO($this->db);
                $resultado = $dashboardDAO->deletarTransacao($idTransacao);

                if ($resultado) {
                    header("Location: dashboard");
                    exit;
                } else {
                    echo "Erro ao deletar transação.";
                }
            }
        }

        public function sair() {
            session_unset();
            session_destroy();  
            header("Location: /myWallet");
            exit();
        }

    }
?>