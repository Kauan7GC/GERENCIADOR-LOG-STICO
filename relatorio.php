<?php
include 'conexao.php';

$data_pesquisa = $_GET['data'] ?? date('Y-m-d');

$sql = "SELECT * FROM fretes WHERE data_cadastro = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$data_pesquisa]);
$fretes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Relatório de Fretes</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <!-- Menu de Navegação -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">Logística UNIPAR</a>
            <div class="navbar-nav">
                <a class="nav-link" href="cadastrar.php">Cadastrar Frete</a>
                <a class="nav-link active" href="relatorio.php">Relatório Diário</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <h2>Relatório de Fretes Diário</h2>
        
        <form method="GET" class="row g-3 mb-4 mt-2">
            <div class="col-auto">
                <input type="date" name="data" value="<?= $data_pesquisa ?>" class="form-control">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-dark">Filtrar Data</button>
                <button type="button" onclick="window.print()" class="btn btn-success">Imprimir / Baixar PDF</button>
            </div>
        </form>

        <table class="table table-bordered bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Produto</th>
                    <th>Origem</th>
                    <th>Destino</th>
                    <th>Transportador</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($fretes) > 0): ?>
                    <?php foreach ($fretes as $f): ?>
                    <tr>
                        <td><?= $f['id'] ?></td>
                        <td><?= $f['produto'] ?></td>
                        <td><?= $f['origem'] ?></td>
                        <td><?= $f['destino'] ?></td>
                        <td><?= $f['transportador'] ?></td>
                        <td>R$ <?= number_format($f['valor_frete'], 2, ',', '.') ?></td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Nenhum frete encontrado para esta data.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <a href="index.php" class="btn btn-secondary">Voltar</a>
    </div>

</body>
</html>