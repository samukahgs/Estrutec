<?php
require_once 'config/crud.php';
session_start();

/*
|--------------------------------------------------------------------------
| FILTRO DE CATEGORIA
|--------------------------------------------------------------------------
*/

$categoria = $_GET['categoria'] ?? '';

if($categoria != '') {

    $sql = "SELECT * FROM produtos WHERE categoria = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$categoria]);

    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

} else {

    $produtos = readAll($pdo, 'produtos');

}

/*
|--------------------------------------------------------------------------
| BUSCAR CATEGORIAS
|--------------------------------------------------------------------------
*/

$sqlCategorias = "SELECT DISTINCT categoria FROM produtos";
$stmtCategorias = $pdo->query($sqlCategorias);

$categorias = $stmtCategorias->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produtos - Estrutec</title>

    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<?php include 'partials/header.php'; ?>

<main>

    <h1>Nossos Produtos</h1>

    <!-- FILTROS -->
    <div class="filtros">

        <a href="produtos.php" class="filtro-btn">
            Todos
        </a>

        <?php foreach($categorias as $c): ?>

            <a 
                href="produtos.php?categoria=<?= urlencode($c['categoria']) ?>"
                class="filtro-btn"
            >
                <?= htmlspecialchars($c['categoria']) ?>
            </a>

        <?php endforeach; ?>

    </div>

    <!-- GRID DE PRODUTOS -->
    <div class="produtos-grid">

        <?php foreach ($produtos as $p): ?>

            <div class="produto-card">

                <img
                    src="imagens/<?= htmlspecialchars($p['imagem'] ?: 'produto-padrao.jpg') ?>"
                    alt="<?= htmlspecialchars($p['item']) ?>"
                >

                <h3>
                    <?= htmlspecialchars($p['item']) ?>
                </h3>

                <p>
                    <?= htmlspecialchars($p['descricao']) ?>
                </p>

                <span class="categoria">
                    <?= htmlspecialchars($p['categoria']) ?>
                </span>

                <span class="preco">
                    R$ <?= number_format($p['preco'], 2, ',', '.') ?>
                </span>

                <a
                    href="carrinho.php?add=<?= $p['id'] ?>"
                    class="btn-comprar"
                >
                    Comprar
                </a>

            </div>

        <?php endforeach; ?>

    </div>

</main>

</body>
</html>