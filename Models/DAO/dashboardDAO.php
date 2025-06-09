<?php
    class DashboardDAO {
        public function __construct(private $db = null){}

        public function addTransacao(Transacao $transacao) {
            $sql = "INSERT INTO transacoes (tipo, data, descricao, valor, id_usuario) VALUES (?, ?, ?, ?, ?)";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $transacao->getIdTipo(), PDO::PARAM_INT);
                $stm->bindValue(2, $transacao->getData(), PDO::PARAM_STR);
                $stm->bindValue(3, $transacao->getDescricao(),PDO::PARAM_STR);
                $stm->bindValue(4, $transacao->getValor(), PDO::PARAM_STR);
                $stm->bindValue(5, $transacao->getIdUsuario(), PDO::PARAM_INT);
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ); 
            } catch(PDOException $e) {
                echo "Erro ao inserir transação." . $e->getMessage();
                $this->db = null;
                die();
            }
        }

        public function mostrarTransaçoes(int $usuarioId) {
            $sql = "SELECT t.id, tt.tipo, t.data, t.descricao, t.valor FROM transacoes t INNER JOIN tipo_transacao tt ON t.tipo = tt.id WHERE t.id_usuario = ?";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $usuarioId, PDO::PARAM_INT);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo "Erro ao buscar transações" . $e->getMessage();
            }
        }

        public function deletarTransacao(int $idTransacao) {
            $sql = "DELETE FROM transacoes WHERE id = ?";

            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $idTransacao, PDO::PARAM_INT);
                $stm->execute();
                return true;
            } catch (PDOException $e) {
                echo "Erro ao deletar transação: " . $e->getMessage();
                $this->db = null;
                return false;
            }
        }

        public function alterarTransacao(Transacao $transacao, int $idTransacao) {
            $sql = "UPDATE transacoes SET tipo = ?, data = ?, descricao = ?, valor = ? WHERE id = ?";

            try {
                $stm = $this->db->prepare($sql);   
                $stm->bindValue(1, $transacao->getIdTipo(), PDO::PARAM_INT); 
                $stm->bindValue(2, $transacao->getData(), PDO::PARAM_STR);
                $stm->bindValue(3, $transacao->getDescricao(),PDO::PARAM_STR);
                $stm->bindValue(4, $transacao->getValor(), PDO::PARAM_STR);
                $stm->bindValue(5, $idTransacao, PDO::PARAM_INT);
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ); 
            } catch(PDOException $e) {
                echo "Erro ao editar transação: " . $e->getMessage();
                $this->db = null;
                die();
            }
        }

        // public function buscarIdTransacao(Transacao $idTransacao) {
        //     $sql = "SELECT * FROM transacoes WHERE id = ?";
        //     try {
        //         $stm = $this->db->prepare($sql);
        //         $stm->bindValue(1, $idTransacao->getId(), PDO::PARAM_INT);
        //         $stm->execute();
        //         $this->db = null;
        //         return $stm->fetchAll(PDO::FETCH_OBJ);
        //     } catch (PDOException $e) {
        //         echo "Erro ao buscar Id". $e->getMessage();
        //         $this->db = null;
        //         die();
        //     }
        // }
    }
?>