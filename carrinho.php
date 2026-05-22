<?php
require_once 'config/crud.php';
session_start();

// Apenas clientes logados podem acessar o carrinho
if (!isset($_SESSION['id_login']) || $_SESSION['papel'] !== 'cliente') {
    header('Location: login.php');
    exit;
}

// Adicionar ao carrinho
if (isset($_GET['add'])) {
    $id = (int)$_GET['add'];
    $_SESSION['carrinho'][$id] = ($_SESSION['carrinho'][$id] ?? 0) + 1;
    header('Location: carrinho.php');
    exit;
}

// Remover item
if (isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    unset($_SESSION['carrinho'][$id]);
    header('Location: carrinho.php');
    exit;
}

// Atualizar quantidade
if (isset($_POST['atualizar'])) {
    foreach ($_POST['qtd'] as $id => $qtd) {
        if ($qtd <= 0) unset($_SESSION['carrinho'][$id]);
        else $_SESSION['carrinho'][$id] = (int)$qtd;
    }
    header('Location: carrinho.php');
    exit;
}

$itensCarrinho = [];
$totalGeral = 0;
if (!empty($_SESSION['carrinho'])) {
    foreach ($_SESSION['carrinho'] as $id => $qtd) {
        $produto = read($pdo, 'produtos', "id = $id");
        if ($produto) {
            $subtotal = $produto['preco'] * $qtd;
            $totalGeral += $subtotal;
            $itensCarrinho[] = [
                'id' => $id,
                'nome' => $produto['item'],
                'preco' => $produto['preco'],
                'qtd' => $qtd,
                'subtotal' => $subtotal
            ];
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Carrinho - Estrutec</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<main>
    <h1>Meu Carrinho</h1>
    <?php if (empty($itensCarrinho)): ?>
        <p>Seu carrinho está vazio.</p>
        <a href="index.php" class="btn">Continuar comprando</a>
    <?php else: ?>
        <form method="POST">
            <table style="width:100%; background:#132A4A; border-radius:12px;">
                <thead><tr><th>Produto</th><th>Preço</th><th>Quantidade</th><th>Subtotal</th><th></th></tr></thead>
                <tbody>
                <?php foreach ($itensCarrinho as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['nome']) ?></td>
                    <td>R$ <?= number_format($item['preco'],2,',','.') ?></td>
                    <td><input type="number" name="qtd[<?= $item['id'] ?>]" value="<?= $item['qtd'] ?>" min="0" style="width:70px"></td>
                    <td>R$ <?= number_format($item['subtotal'],2,',','.') ?></td>
                    <td><a href="carrinho.php?remove=<?= $item['id'] ?>" class="btn-acao">Remover</a></td>
                </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div style="margin-top:1rem; display:flex; gap:1rem; justify-content:space-between;">
                <button type="submit" name="atualizar" class="btn">Atualizar Carrinho</button>
                <strong>Total: R$ <?= number_format($totalGeral,2,',','.') ?></strong>
            </div>
        </form>
        <form action="crud/finalizar-pedido.php" method="POST" style="margin-top:1rem;">
            <button type="submit" class="btn" style="background:#16B2D4;">Finalizar Pedido</button>
        </form>
    <?php endif; ?>
</main>
<?php include 'partials/footer.php'; ?>
</body>
</html>