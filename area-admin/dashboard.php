<?php
require_once '../config/crud.php';
$requer_gerente = true;
include '../config/auth.php';

$faturamento = readAll($pdo, 'pedidos', "status = 'Concluído'");
$totalFat = array_sum(array_column($faturamento, 'total'));
$criticos = count(readAll($pdo, 'produtos', "quantidade < 10"));
$clientes = count(readAll($pdo, 'cadastrados', "papel = 'cliente'"));
$pendentes = count(readAll($pdo, 'pedidos', "status = 'Pendente'"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Estrutec</title>
    <link rel="stylesheet" href="styles/admin-style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
    <div class="dashboard-cards">
        <div class="card"><h3>Vendas do Mês</h3><div class="valor">R$ <?= number_format($totalFat, 2, ',', '.') ?></div></div>
        <div class="card"><h3>Estoque baixo</h3><div class="valor"><?= $criticos ?></div></div>
        <div class="card"><h3>Clientes Ativos</h3><div class="valor"><?= $clientes ?></div></div>
        <div class="card"><h3>Pedidos Pendentes</h3><div class="valor"><?= $pendentes ?></div></div>
    </div>
</body>
</html>
<?php include 'partials/footer.php'; ?>