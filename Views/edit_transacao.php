<?php
  if (session_status() === PHP_SESSION_NONE) {
      session_start();
  }

  if (!isset($_SESSION['usuario'])) {
      header("Location: login");
      exit;
  }
  $nome = $_SESSION['usuario']->nome;
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyWallet - Editar Transação</title>
  <link rel="icon" href="/img/icon.png" type="image/png" />
  <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="CSS/edit_transacao.css" />
</head>
<body>
  <header>
    <h1><a href="dashboard">MyWallet</a></h1>
    <span>Olá, <strong><?= htmlspecialchars($nome) ?></strong> | <button id="btn-sair">SAIR</button>
  </header>
  <main>
    <div class="form-box">
      <h2>Editar transação</h2>
      <form action="editar-transacao" method="post">
        <input type="hidden" id="id" name="id" value="<?= $formData->id ?? 0 ?>">
        <div class="form-inline">
          <label for="tipo">Tipo:</label>
          <?php
            foreach($ret as $dados) {
              $idRadio = 'tipo_' . $dados->id;
              $checked = (isset($formData->tipo) && $formData->tipo == $dados->id) ? 'checked' : '';
              echo "<input type='radio' name='tipo' id='{$idRadio}' value='{$dados->id}' $checked>
              <label for='tipo' class='radio-label'>{$dados->tipo}</label>
              ";
            }
          ?>
        </div>
        <div class="form-group">
          <label for="descricao">Descrição:</label>
          <input type="text" id="descricao" name="descricao" value="<?= htmlspecialchars($formData->descricao  ?? '') ?>" placeholder="Descrição da sua transação" />
        </div>
        <div class="form-group">
          <label for="valor">Valor:</label>
          <input type="text" id="valor" name="valor" value="<?= htmlspecialchars($formData->valor  ?? '') ?>" placeholder="R$" />
        </div>
        <div class="form-group">
          <label for="data">Data:</label>
          <input type="date" id="data" value="<?= htmlspecialchars($formData->data  ?? '') ?>" name="data" />
        </div>
        <div class="actions">
          <button class="save" type="submit">SALVAR</button>
          <button class="cancel" type="button"><a href="dashboard">CANCELAR</a></button>
        </div>
      </form>
    </div>
    <div class="back">
      <button type="button"><a href="dashboard">VOLTAR AO RESUMO</a></button>
    </div>
  </main>
</body>
</html>