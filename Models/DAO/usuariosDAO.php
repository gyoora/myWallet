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
    }
?>
