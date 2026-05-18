<?php
require_once 'config/crud.php';
session_start();
if (!isset($_SESSION['id_login'])) header('Location: login.php');
$id = $_SESSION['id_login'];
$pedidos = readAll($pdo, 'pedidos', "id_login = $id ORDER BY data_pedido DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Meus Pedidos - Estrutec</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<main>
    <h1>Meus Pedidos</h1>
    <?php if (empty($pedidos)): ?>
        <p>Você ainda não realizou nenhum pedido.</p>
    <?php else: ?>
        <?php foreach ($pedidos as $ped): ?>
            <div style="background:#132A4A; border-radius:12px; padding:1rem; margin-bottom:1.5rem;">
                <p><strong>Pedido #<?= $ped['id_pedido'] ?></strong> - Data: <?= date('d/m/Y H:i', strtotime($ped['data_pedido'])) ?> - Status: <?= $ped['status'] ?> - Total: R$ <?= number_format($ped['total'],2,',','.') ?></p>
                <?php
                $itens = readAll($pdo, 'itens_pedido', "id_pedido = {$ped['id_pedido']}");
                echo '<ul>';
                foreach ($itens as $item) {
                    $prod = read($pdo, 'produtos', "id = {$item['id_produto']}");
                    echo '<li>' . htmlspecialchars($prod['item']) . ' - Quantidade: ' . $item['qtd_comprada'] . ' - Unitário: R$ ' . number_format($item['preco_unitario'],2,',','.') . '</li>';
                }
                echo '</ul>';
                ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
<?php include 'partials/footer.php'; ?>
</body>
</html>