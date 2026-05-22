<?php
$requer_gerente = true;
include '../config/auth.php';
require_once '../config/crud.php';
$clientes = readAll($pdo, 'cadastrados', "papel = 'cliente'");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/admin-style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<div class="admin-main">
    <h2>Clientes Cadastrados</h2>
    <div class="table-container">
        <table>
            <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>CPF</th></tr></thead>
            <tbody>
            <?php foreach ($clientes as $c): ?>
            <tr>
                <td><?= $c['id_login'] ?></td>
                <td><?= htmlspecialchars($c['nome']) ?></td>
                <td><?= htmlspecialchars($c['email']) ?></td>
                <td><?= $c['telefone'] ?></td>
                <td><?= $c['cpf'] ?></td>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>