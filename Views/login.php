<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyWallet - Entre na sua conta</title>
  <link rel="icon" href="img/icon.png" type="image/png">
  <link rel="stylesheet" href="CSS/login.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <script src="https://kit.fontawesome.com/8ec4f5570d.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container">
    <h2>Entre na sua conta</h2>
    <p class="description">Preencha seus dados</p>
    <form action="loginAction" method="post">
        <div class="form-group">
            <i class="fas fa-envelope"></i>
            <input type="email" placeholder="E-mail" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
        </div>
        <div class="aviso"><?php echo $msg[0]; ?></div>
        <div class="form-group">
            <i class="fas fa-lock"></i>
            <input type="password" placeholder="Senha" name="senha" >
        </div>
        <div class="aviso"><?php echo $msg[1]; ?></div>
        <div class="aviso"><?php echo $msg[2]; ?></div>
        <p class="link">Não tem uma conta? <strong><a href="cadastro">Cadastre-se aqui!</a></strong></p>
        <input type="submit" value="LOGIN" class="button">
    </form>
  </div>
</body>
</html>
  