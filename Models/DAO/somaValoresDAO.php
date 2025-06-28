<?php
    class SomaValoresDAO {
        public function __construct(private $db = null){}
        
        public function buscarSomaValores(SomaValores $somaValores) {
            $sql = "SELECT SUM(valor) AS total FROM transacoes WHERE MONTH(data) = ? AND YEAR(data) = 2025 AND id_usuario = ? AND tipo = ?";
            
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $somaValores->getMes(), PDO::PARAM_INT);
                $stm->bindValue(2, $somaValores->getIdUsuario(), PDO::PARAM_INT);
                $stm->bindValue(3, $somaValores->getTipo(), PDO::PARAM_STR);
                $stm->execute();
                return $stm->fetch(PDO::FETCH_OBJ);
            } catch(PDOException $e) {
                echo "Erro ao buscar valores." . $e->getMessage();
                $this->db = null;
                die();
            }
        }
    }
?>