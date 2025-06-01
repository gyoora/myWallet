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
    <title>Dashboard - MyWallet</title>
    <link rel="stylesheet" href="CSS/form_transacao.css">
    <link rel="icon" href="img/icon.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>MyWallet</h1>
        <span>Olá, <strong><?= htmlspecialchars($nome) ?></strong> | <button id="btn-sair">SAIR</button>
    </header>
    <main>
        <div class="form-box">
            <h2>Adicionar nova transação</h2>
            <form action="adicionar-transacao" method="post">
                <div class="form-inline">
                    <label for="tipo">Tipo:</label>
                    <?php
                        foreach($ret as $dados) {
                            $idRadio = 'tipo_' . $dados->id;
                            echo "<input type='radio' name='tipo' id='{$idRadio}' value='{$dados->id}'>
                            <label for='tipo' class='radio-label'>{$dados->tipo}</label>
                            ";
                        }
                    ?>
                </div>
                <div class="aviso"><?php echo $msg[0]; ?></div>
                <div class="form-group">
                    <label for="descricao">Descrição:</label>
                    <input type="text" id="descricao" name="descricao" placeholder="Descrição da sua transação">
                </div>
                <div class="aviso"><?php echo $msg[2]; ?></div>
                <div class="form-group">
                    <label for="valor">Valor:</label>
                    <input type="number" id="valor" name="valor" step='0.01' min='0' placeholder="R$">
                </div>
                <div class="aviso"><?php echo $msg[3]; ?></div>
                <div class="form-group">
                    <label for="data">Data:</label>
                    <input type="date" id="data" name="data">
                </div>
                <div class="aviso"><?php echo $msg[1]; ?></div>
                <div class="actions">
                    <button class="save" type="submit">SALVAR</button>
                    <button class="cancel" type="button">CANCELAR</button>
                </div>
            </form>
        </div>
        <div class="back">
            <button type="button"><a href="dashboard">VOLTAR AO RESUMO</a></button>
        </div>
    </main>
    <script src="https://kit.fontawesome.com/8ec4f5570d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
    