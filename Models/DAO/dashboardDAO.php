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

        public function mostrarDadosDashboard(int $usuarioId, int $mesSelecionado, int $anoSelecionado) {
            $sql = "SELECT SUM(valor) as total
            FROM transacoes
            WHERE id_usuario = :usuario";

            $params = [':usuario' => $usuarioId];

            if ($mesSelecionado > 0) {
                $sql .= " AND MONTH(data) = :mes";
                $params[':mes'] = $mesSelecionado;
            }
            if ($anoSelecionado > 0) {
                $sql .= " AND YEAR(data) = :ano";
                $params[':ano'] = $anoSelecionado;
            }

            $sqlReceita = $sql . " AND tipo = 1";
            $stmtReceita = $this->db->prepare($sqlReceita);
            foreach ($params as $key => $value) {
                $stmtReceita->bindValue($key, $value, PDO::PARAM_INT);
            }
            $stmtReceita->execute();
            $receita = $stmtReceita->fetchColumn();

            $sqlDespesa = $sql . " AND tipo = 2";
            $stmtDespesa = $this->db->prepare($sqlDespesa);
            foreach ($params as $key => $value) {
                $stmtDespesa->bindValue($key, $value, PDO::PARAM_INT);
            }
            $stmtDespesa->execute();
            
            $despesa = $stmtDespesa->fetchColumn(); 

            $dashboard = new Dados_Dashboard(
                $receita ?? 0,
                $despesa ?? 0
            );

            return $dashboard;
        }

        public function mostrarTransaçoes(int $usuarioId, int $mesSelecionado, int $anoSelecionado) {
            $sql = "SELECT t.id, tt.tipo, t.data, t.descricao, t.valor FROM transacoes t INNER JOIN tipo_transacao tt ON t.tipo = tt.id WHERE t.id_usuario = :usuario";
            $parametros = [":usuario" => $usuarioId];
            if($mesSelecionado > 0) {
                $sql .= " AND MONTH(t.data) = :mes";
                $parametros[':mes'] = $mesSelecionado;
            }
            if($anoSelecionado > 0) {
                $sql .= " AND YEAR(t.data) = :ano";
                $parametros[':ano'] = $anoSelecionado;
            }
            $sql .= " ORDER BY t.data DESC";
            try {
                $stm = $this->db->prepare($sql);
                foreach ($parametros as $key => $value) {
                    $stm->bindValue($key, $value, PDO::PARAM_INT);
                }
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

        public function alterarTransacao(Transacao $transacao) {
            $sql = "UPDATE transacoes SET tipo = ?, data = ?, descricao = ?, valor = ? WHERE id = ?";

            try {
                $stm = $this->db->prepare($sql);   
                $stm->bindValue(1, $transacao->getIdTipo(), PDO::PARAM_INT); 
                $stm->bindValue(2, $transacao->getData(), PDO::PARAM_STR);
                $stm->bindValue(3, $transacao->getDescricao(),PDO::PARAM_STR);
                $stm->bindValue(4, $transacao->getValor(), PDO::PARAM_STR);
                $stm->bindValue(5, $transacao->getId(), PDO::PARAM_INT);
                $stm->execute();

                return $stm->fetchAll(PDO::FETCH_OBJ); 
            } catch(PDOException $e) {
                echo "Erro ao editar transação: " . $e->getMessage();
                $this->db = null;
                die();
            }
        }

        public function buscarPorId(int $id) {
                $sql = "SELECT * FROM transacoes WHERE id = ?";

                try {
                    $stm = $this->db->prepare($sql);
                    $stm->bindValue(1, $id, PDO::PARAM_INT);
                    $stm->execute();
                    return $stm->fetch(PDO::FETCH_OBJ);
                } catch (PDOException $e) {
                    echo "Erro ao buscar usuário." . $e->getMessage();
                    $this->db = null;
                    die();
                }
        }

        public function listarAnosComTransacoes(int $idUsuario) {
            $sql = "SELECT DISTINCT YEAR(data) AS ano FROM transacoes WHERE id_usuario = ? ORDER BY ano DESC";
            try {
                $stm = $this->db->prepare($sql);
                $stm->bindValue(1, $idUsuario, PDO::PARAM_INT);
                $stm->execute();
                return $stm->fetchAll(PDO::FETCH_COLUMN);
            } catch (PDOException $e) {
                echo "Erro ao buscar usuário." . $e->getMessage();
                $this->db = null;
                die();
            }
        }

    }
?>