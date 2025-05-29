<?php
    class UsuariosDAO {
        public function __construct(private $db = null){}

        public function cadastrar(Usuarios $usuario) {
            $sql = "INSERT INTO usuarios (nome, email, senha) VALUES (?,?,?)";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getNome(), PDO::PARAM_STR);
                $stm->bindValue(2, $usuario->getEmail(), PDO::PARAM_STR);
                $stm->bindValue(3, $usuario->getSenha(), PDO::PARAM_STR);

                $stm->execute();
            } catch (PDOException $e) {
                echo "Erro ao cadastrar" . $e->getMessage();
                $this->db = null;
                die();
            }
        }
        public function emailCadastrado(Usuarios $email) {
            $sql = "SELECT COUNT(*) FROM usuarios WHERE email = ?";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $email->getEmail(), PDO::PARAM_STR);
                $stm->execute();
                return $stm->fetchColumn() > 0;
            } catch (PDOException $e) {
                echo "Erro ao buscar email." . $e->getMessage();
                $this->db = null;
                die();
            }
        }

        public function login(Usuarios $usuario) {
            $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuario->getEmail(), PDO::PARAM_STR);
                $stm->bindValue(2, $usuario->getSenha(), PDO::PARAM_STR);
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "Erro ao buscar usuário." . $e->getMessage();
                $this->db = null;
                die();
            }
        }
    }
?>
