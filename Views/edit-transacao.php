<?php
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>MyWallet - Editar Transação</title>
  <link rel="icon" href="/img/icon.png" type="image/png" />
  <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="edit-transacao.css" />
</head>
<body>
  <header>
    <h1>MyWallet</h1>
    <span>Olá, <strong>Julia</strong> | <a href="#" style="color: white; text-decoration: none;">SAIR</a></span>
  </header>
  <main>
    <div class="form-box">
      <h2>Editar transação</h2>
      <form action="#" method="post">
        <div class="form-inline">
          <label for="tipo">Tipo:</label>
          <input type="radio" name="tipo" id="receita" value="receita" />
          <label for="receita" class="radio-label">Receita</label>
          <input type="radio" name="tipo" id="despesa" value="despesa" />
          <label for="despesa" class="radio-label">Despesa</label>
        </div>
        <div class="form-group">
          <label for="descricao">Descrição:</label>
          <input type="text" id="descricao" name="descricao" placeholder="Descrição da sua transação" />
        </div>
        <div class="form-group">
          <label for="valor">Valor:</label>
          <input type="text" id="valor" name="valor" placeholder="R$" />
        </div>
        <div class="form-group">
          <label for="data">Data:</label>
          <input type="date" id="data" name="data" />
        </div>
        <div class="actions">
          <button class="save" type="submit">SALVAR</button>
          <button class="cancel" type="button">CANCELAR</button>
        </div>
      </form>
    </div>
    <div class="back">
      <button type="button">VOLTAR AO RESUMO</button>
    </div>
  </main>
</body>
</html>
