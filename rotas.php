<?php
	class rotas
	{
		private array $rotas = array();
		
		public function get(string $nome, array $dados)
		{
			$this->rotas['GET'][$nome] = $dados;
		}
		public function post(string $nome, array $dados)
		{
			$this->rotas['POST'][$nome] = $dados;
		}
		public function verificar_rota(string $metodo, string $uri)
		{
			if(isset($this->rotas[$metodo][$uri]))
			{
				$dados_rota = $this->rotas[$metodo][$uri];
				$classe = $dados_rota[0];
				$metodo = $dados_rota[1];
				$obj = new $classe();
				return $obj->$metodo();
			}
			else
			{
				echo "Rota Inválida";
			}
		}
	}//fim da classe
	$route = new Rotas();
	$route->get("/", [HomeController::class, "home"]);
	$route->get("/cadastro", [MyWalletController::class, "cadastrar"]);
	$route->post("/cadastrar", [MyWalletController::class, "cadastrar"]);
	$route->get("/login", [MyWalletController::class, "login"]);
	$route->post("/login", [MyWalletController::class, "login"]);
	$route->get("/dashboard", [MyWalletController::class, "dashboard"]);
	$route->post("/dashboard", [MyWalletController::class, "dashboard"]);
	$route->get("/adicionar-transacao", [MyWalletController::class, "addTransacao"]);
	$route->post("/adicionar-transacao", [MyWalletController::class, "addTransacao"]);
	$route->get("/deletar-transacao", [MyWalletController::class, "deletarTransacao"]);
	$route->get("/sair", [MyWalletController::class, "sair"]);

?>