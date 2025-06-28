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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyWallet - Perfil</title>
  <link rel="icon" href="/img/icon.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="CSS/perfil.css">
</head>
<body>
  <header>
    <h1><a href="dashboard">MyWallet</a></h1>
    <span>Olá, <strong><a href=""><?= htmlspecialchars($nome) ?></a></strong> | <button id="btn-sair">SAIR</button>
  </header>

  <main>
    <div class="profile-box">
      <h2>Perfil do Usuário</h2>

      <div class="profile-picture">
        <img src="https://img.myloview.com.br/posters/user-icon-human-person-symbol-avatar-login-sign-700-259624278.jpg" alt="Foto de perfil" id="preview">
        <label for="photo-upload">Alterar Foto</label>
        <input type="file" id="photo-upload" accept="image/*" onchange="previewPhoto(event)">
      </div>

      <div class="field-group">
        <div>
          <div class="field-label">Nome:</div>
          <div class="field-placeholder">Seu nome aqui</div>
        </div>
        <button class="edit-button">Alterar</button>
      </div>

      <div class="field-group">
        <div>
          <div class="field-label">E-mail:</div>
          <div class="field-placeholder">seuemail@email.com</div>
        </div>
        <button class="edit-button">Alterar</button>
      </div>

      <div class="field-group">
        <div>
          <div class="field-label">Senha:</div>
          <div class="field-placeholder">********</div>
        </div>
        <button class="edit-button">Alterar</button>
      </div>
    </div>
  </main>

  <script>
    function previewPhoto(event) {
      const img = document.getElementById('preview');
      const file = event.target.files[0];
      if (file) {
        img.src = URL.createObjectURL(file);
      }
    }
  </script>
</body>
</html>
