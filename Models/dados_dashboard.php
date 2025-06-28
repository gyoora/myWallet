<?php
    class Dados_Dashboard {

        public function __construct(
            public float $receita = 0,
            public float $despesa = 0,
            public float $saldoAtual = 0,
        ){}

        public function getReceita() {
            return $this->receita;
        }

        public function getDespesa() {
            return $this->despesa;
        }

        public function getSaldoAtual() {
            $this->saldoAtual = $this->receita - $this->despesa;
            return $this->saldoAtual;
        }
        
    }

?>