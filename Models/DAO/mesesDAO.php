<?php
    class MesesDAO {
        public function __construct(private $db = null){}

        public function mostrarMeses() {
            $sql = "SELECT * FROM meses";

            try {
                $stm = $this->db->prepare($sql);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "Erro ao buscar meses" . $e->getMessage();
            }
        }
    }  
?>
