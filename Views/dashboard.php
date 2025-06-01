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
<link rel="stylesheet" href="CSS/dashboard.css">
<link rel="icon" href="img/icon.png" type="image/png">
<link href="https://fonts.googleapis.com/css2?family=Poltawski+Nowy:wght@700&family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>MyWallet</h1>
        <span>Olá, <strong><?= htmlspecialchars($nome) ?></strong> | <button id="btn-sair">SAIR</button>
    </header>
    
    <div class="content">
        <div class="summary-box">
            <div class="summary-left">
                <h2>Resumo Financeiro - Maio</h2>
                <div class="filters">
                    <select name="month" id="mes">
                        <?php
                            foreach($ret as $dado) {
                                echo "<option>{$dado->mes}</option>";
                            }
                        ?>
                    </select>
                    <select name="year">
                        <option>2025</option>
                    </select>
                </div>
                <div class="summary-stats">
                    <div class="stat green">
                        <p>Receita mensal</p>
                        <strong>+ R$400,00</strong>
                    </div>
                    <div class="stat red">
                        <p>Despesa mensal</p>
                        <strong>+ R$112,00</strong>
                    </div>
                    <div class="stat blue">
                        <p>Saldo Atual</p>
                        <strong>+ R$288,00</strong>
                    </div>
                </div>
            </div>
            <div class="summary-graph">
                <img src="grafico-placeholder.png" alt="Gráfico de pizza">
            </div>
        </div>
        
        <h3>Transações</h3>
        <table>
            <thead>
                <tr>
                    <th>Tipo</th>
                    <th>Data</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(!empty($dadostransacao)) {
                        foreach($dadostransacao as $dado) {
                            echo "<tr>
                                <td>{$dado->tipo}</td>
                                <td>{$dado->data}</td>
                                <td>{$dado->descricao}</td>
                                <td>R$ {$dado->valor}</td>
                                <td>
                                    <i class='fas fa-trash'></i>
                                    <i class='fas fa-pen'></i>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td>Sem transações inseridas.</td>
                        <tr>";
                    }
                ?>
                <!-- <tr>
                    <td class="type-receita">Receita</td>
                    <td>16/05/2025</td>
                    <td>Presente de aniversário</td>
                    <td>R$400,00</td>
                    <td class="actions">
                        <i class="fas fa-trash"></i>
                        <i class="fas fa-pen"></i>
                    </td>
                </tr>
                <tr>
                    <td class="type-despesa">Despesa</td>
                    <td>16/05/2025</td>
                    <td>Bichinho de pelúcia fofo</td>
                    <td>R$112,00</td>
                    <td class="actions">
                        <i class="fas fa-trash"></i>
                        <i class="fas fa-pen"></i>
                    </td>
                </tr> -->
            </tbody>
        </table>
        
        <div class="buttons">
            <button class="btn pdf">GERAR PDF</button>
            <button class="btn add"><a href="adicionar-transacao">+ NOVA TRANSAÇÃO</a></button>
        </div>
    </div>
    <script src="JS/dashboard.js"></script>
    <script src="https://kit.fontawesome.com/8ec4f5570d.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>
</html>
