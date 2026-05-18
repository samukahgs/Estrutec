<?php
require_once 'config/crud.php';
session_start();
$produtos = readAll($pdo, 'produtos');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutec - Materiais para Estruturas e Fundação</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>
    <main>
        <h1>Produtos Estruturais</h1>
        <div class="produtos-grid">
            <?php foreach ($produtos as $p): ?>
                <div class="produto-card">
                    <img src="imagens/<?= htmlspecialchars($p['imagem'] ?: 'produto-padrao.jpg') ?>" alt="<?= htmlspecialchars($p['item']) ?>">
                    <h3><?= htmlspecialchars($p['item']) ?></h3>
                    <p><?= htmlspecialchars($p['descricao']) ?></p>
                    <span class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                    <a href="carrinho.php?add=<?= $p['id'] ?>" class="btn-comprar">Comprar</a>
                </div>
            <?php endforeach; ?>
        </div>
    </main>
    <?php include 'partials/footer.php'; ?>
</body>
</html>