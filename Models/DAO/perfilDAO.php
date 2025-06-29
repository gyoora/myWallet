<?php
    class PerfilDAO {
        public function __construct(private $db = null){}

        public function alterarNomeUsuario(Usuarios $usuarios) {
            $sql = "UPDATE usuarios SET nome = ? WHERE id = ?";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuarios->getNome(), PDO::PARAM_STR);
                $stm->bindValue(2, $usuarios->getId(), PDO::PARAM_INT);
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ); 
            } catch (PDOException $e) {
                echo "Erro ao editar nome de usuário: " . $e->getMessage();
                $this->db = null;
                die();
            }

        }
    }  
?>
