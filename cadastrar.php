<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $produto = $_POST['produto'];
    $origem = $_POST['origem'];
    $destino = $_POST['destino'];
    $transportador = $_POST['transportador'];
    $valor_frete = $_POST['valor_frete'];

    // Inserindo os dados no banco de dados
    $sql = "INSERT INTO fretes (produto, origem, destino, transportador, valor_frete, data_cadastro) VALUES (?, ?, ?, ?, ?, CURDATE())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$produto, $origem, $destino, $transportador, $valor_frete]);

    $mensagem = "Frete cadastrado com sucesso!";
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Frete</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Menu de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Logística UNIPAR</a>
            <div class="navbar-nav">
                <a class="nav-link active" href="cadastrar.php">Cadastrar Frete</a>
                <a class="nav-link" href="relatorio.php">Relatório Diário</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Novo Cadastro de Frete</h2>
        
        <?php if (!empty($mensagem)): ?>
            <div class="alert alert-success"><?= $mensagem ?></div>
        <?php endif; ?>

        <form method="POST" class="bg-white p-4 rounded shadow-sm">
            <div class="mb-3">
                <label class="form-label">Nome do Produto:</label>
                <input type="text" name="produto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Endereço de Origem:</label>
                <input type="text" name="origem" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Endereço de Destino:</label>
                <input type="text" name="destino" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Transportador:</label>
                <input type="text" name="transportador" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Valor do Frete (R$):</label>
                <input type="number" step="0.01" name="valor_frete" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar Frete</button>
            <a href="index.php" class="btn btn-secondary">Voltar</a>
        </form>
    </div>

</body>
</html>