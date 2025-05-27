<?php
   class Conexao 
    {
        private static $conexao;

        private function __construct(){}

        public static function getInstancia()
        {
            if(empty(self::$conexao)){
                $parametros = 'mysql:host=localhost;dbname=myWallet;charset=utf8mb4';
                try 
                {
                    self::$conexao = new PDO($parametros, 'root', '');
                }
                catch(PDOException $e)
                {
                    echo "Problema ao estabeler a conexão com o banco.";
                    die();
                }
            }
            return self::$conexao;
        }
    }
?>