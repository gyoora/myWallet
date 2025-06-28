<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyWallet - Login</title>
  <link rel="stylesheet" href="CSS/cadastro.css">
  <link rel="icon" href="img/icon.png" type="image/png">
  <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<body>
    <div class="left">
        <div class="content">
            <h1><a href="dashboard"></a>MyWallet</h1>
            <h2>Bem-vindo<br>de volta!</h2>
            <p>Acesse sua conta agora<br>mesmo.</p>
            <button><a href="login">ENTRAR</a></button>
        </div>
        <img src="img/dim-feliz.png" alt="Dinheirinho feliz">
    </div>
    <div class="right">
        <form method="POST" action="cadastrar">
            <h2>Crie sua conta</h2>
            <p>Preencha seus dados</p>
            <div class="form-group">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Nome" name="nome" value="<?= htmlspecialchars($_POST['nome']  ?? '') ?>">
            </div>
            <div class="aviso"><?php echo $msg[0]; ?></div>
            <div class="form-group">
                <i class="fas fa-envelope"></i>
                <input type="email" placeholder="E-mail" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>
            <div class="aviso">
                <?php 
                    echo $msg[1];
                    echo $msg[2]; 
                ?>
            </div>
            <div class="form-group">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Senha" name="senha">
            </div>
            <div class="aviso"><?php echo $msg[3]; ?></div>
            <input type="submit" value="CADASTRAR" class="button">
    </div>
    <script src="https://kit.fontawesome.com/8ec4f5570d.js" crossorigin="anonymous"></script>
</body>
</html>
