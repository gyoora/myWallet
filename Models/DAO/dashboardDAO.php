//
<?php
    class DashboardDAO {
        public function __construct(private $db = null){}

        public function addTransacao() {
            $sql = "INSERT INTO transacoes (tipo, data, descricao, valor, id_usuario) VALUES (?, ?, ?, ?, ?)";
        }
    }
?>