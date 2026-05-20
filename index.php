<?php
require_once 'config/crud.php';
session_start();
$produtos = readAll($pdo, 'produtos', '1 GROUP BY categoria');
// // Busca todas as categorias distintas do banco
// $categoriasDB = readAll($pdo, 'produtos', '1 GROUP BY categoria');
// $categorias = [];
// foreach ($categoriasDB as $cat) {
//     $categorias[$cat['categoria']] = $cat['categoria']; // chave e valor iguais
// }
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
        <main>
        <section class="hero-estrutec">
            <div class="hero-overlay"></div> <!-- Overlay = Sobreposição -->
            <div class="hero-content">
                <h1 class="hero-headline">A base sólida para o seu <br><span>Projeto</span></h1><!--titulo principal-->
                <p class="hero-tagline">Encontre tudo que você precisa em ferrangens, concretagem e estruturas em um só lugar.<br> Navegue por nossas categorias e agilize sua obra hoje mesmo.</p>
                <a href="./productsPage.php" class="hero-button">COMPRE JÁ</a>
            </div>
        </section>
        <section class="categorias">
            <div class="produtos-grid">
            <?php foreach ($produtos as $p): ?>
                <div class="produto-card">
                    <img src="imagens/<?= htmlspecialchars($p['imagem'] ?: 'produto-padrao.jpg') ?>" alt="<?= htmlspecialchars($p['item']) ?>">
                    <h3><?= htmlspecialchars($p['categoria']) ?></h3>
                    <span class="preco">R$ <?= number_format($p['preco'], 2, ',', '.') ?></span>
                    <a href="carrinho.php?add=<?= $p['id'] ?>" class="btn-comprar">Comprar</a>
                </div>
            <?php endforeach; ?>
        </div>
        </section>
        <h1>Produtos Estruturais</h1>
    </main>
    <?php include 'partials/footer.php'; ?>
</body>
</html>