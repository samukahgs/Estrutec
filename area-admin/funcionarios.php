<?php
$requer_gerente = true;
include '../config/auth.php';
require_once '../config/crud.php';
$funcionarios = readAll($pdo, 'cadastrados', "papel IN ('funcionario','gerente')");
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles/admin-style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<h2>Funcionários</h2>
<div class="table-container">
    <table>
        <thead><tr><th>ID</th><th>Nome</th><th>E-mail</th><th>Telefone</th><th>Papel</th></tr></thead>
        <tbody>
        <?php foreach ($funcionarios as $f): ?>
        <tr>
            <td><?= $f['id_login'] ?></td>
            <td><?= htmlspecialchars($f['nome']) ?></td>
            <td><?= htmlspecialchars($f['email']) ?></td>
            <td><?= $f['telefone'] ?></td>
            <td><?= $f['papel'] ?></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>