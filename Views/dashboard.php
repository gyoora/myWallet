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
                <h2>Resumo Financeiro - 
                    <select name="month" id="mes">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </h2>
                <div class="summary-stats">
                    <div class="stat green">
                        <p>Receita mensal</p>
                        <strong><?php echo $receitaObj->total ?? 0; ?></strong>
                    </div>
                    <div class="stat red">
                        <p>Despesa mensal</p>
                        <strong><?php $despesaObj->total ?? 0 ?></strong>
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
                                <td class='tipos' name='tipo'>{$dado->tipo}</td>
                                <td>" . date('d/m/Y', strtotime($dado->data)) . "</td>
                                <td>{$dado->descricao}</td>
                                <td>R$ " . number_format($dado->valor, 2, ',', '.') . "</td>
                                <td class='actions'>
                                    <a href='deletar-transacao?id={$dado->id}'><i class='fas fa-trash'></i></a>
                                    <a href='editar-transacao?id={$dado->id}'><i class='fas fa-pen'></i></a>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr>
                            <td>Sem transações inseridas.</td>
                        <tr>";
                    }
                ?>
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
