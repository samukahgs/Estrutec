<?php
require_once '../config/crud.php';
include '../config/auth.php';
$pedidos = readAll($pdo, 'pedidos', "1 ORDER BY data_pedido DESC");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/admin-style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<h2>Pedidos</h2>
<div class="table-container">
    <table>
        <thead><tr><th>ID Pedido</th><th>Cliente</th><th>Data</th><th>Total</th><th>Status</th><th>Ação</th></tr></thead>
        <tbody>
        <?php foreach ($pedidos as $ped): 
            $cliente = read($pdo, 'cadastrados', "id_login = {$ped['id_login']}");
        ?>
        <tr>
            <td><?= $ped['id_pedido'] ?></td>
            <td><?= htmlspecialchars($cliente['nome']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($ped['data_pedido'])) ?></td>
            <td>R$ <?= number_format($ped['total'],2,',','.') ?></td>
            <td><?= $ped['status'] ?></td>
            <td>
                <form action="../crud/update-pedido.php" method="POST">
                    <input type="hidden" name="id_pedido" value="<?= $ped['id_pedido'] ?>">
                    <select name="status">
                        <option value="Pendente" <?= $ped['status']=='Pendente'?'selected':'' ?>>Pendente</option>
                        <option value="Em separação" <?= $ped['status']=='Em separação'?'selected':'' ?>>Em separação</option>
                        <option value="Concluído" <?= $ped['status']=='Concluído'?'selected':'' ?>>Concluído</option>
                    </select>
                    <button type="submit">Atualizar</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>