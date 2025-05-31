<?php
    class Tipo_transacaoDAO {
        public function __construct(private $db = null){}

        public function mostrarTipos() {
            $sql = "SELECT * FROM tipo_transacao";

            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException $e) {
                echo "Erro ao buscar tipos" . $e->getMessage();
            }
        }
    }  
?>
