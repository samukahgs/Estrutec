<?php
// area-admin/estoque.php
require_once '../config/crud.php';
include '../config/auth.php'; // garante acesso apenas para logados

// Busca todas as categorias distintas do banco
$categoriasDB = readAll($pdo, 'produtos', '1 GROUP BY categoria');
$categorias = [];
foreach ($categoriasDB as $cat) {
    $categorias[$cat['categoria']] = $cat['categoria']; // chave e valor iguais
}

// Filtro por categoria (via GET)
$categoriaFiltro = $_GET['categoria'] ?? '';
$where = $categoriaFiltro ? "categoria = '$categoriaFiltro'" : null;
$produtos = readAll($pdo, 'produtos', $where);

// Processamento das ações (ADD, REMOVE, DELETE) – igual ao exemplo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $acao = $_POST['acao'] ?? '';
    $produto = read($pdo, 'produtos', "id = $id");

    if ($produto) {
        if ($acao === 'add') {
            $novaQtd = $produto['quantidade'] + 1;
            update($pdo, 'produtos', ['quantidade' => $novaQtd], "id = $id");
        } elseif ($acao === 'remove' && $produto['quantidade'] > 0) {
            $novaQtd = $produto['quantidade'] - 1;
            update($pdo, 'produtos', ['quantidade' => $novaQtd], "id = $id");
        } elseif (isset($_POST['lixeira'])) {
            delete($pdo, 'produtos', "id = $id");
        }
    }
    header("Location: estoque.php" . ($categoriaFiltro ? "?categoria=$categoriaFiltro" : ""));
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estrutec - Estoque</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="styles/admin-style.css">
</head>
<body>
    <?php require_once '../partials/header.php'; ?>
    <main class="pagina-estoque">

        <div class="estoque-filtros">
            <img src="../icones/Filter.png" alt="Filtrar" class="icone-filtro">
            <?php foreach ($categorias as $chave => $label): ?>
                <a href="estoque.php?categoria=<?php echo urlencode($chave); ?>" class="tag-filtro <?php echo $categoriaFiltro === $chave ? 'tag-ativa' : ''; ?>"><?php echo htmlspecialchars($label); ?></a>
            <?php endforeach; ?>
            <?php if ($categoriaFiltro): ?>
                <a href="estoque.php" class="tag-filtro">Limpar filtro</a>
            <?php endif; ?>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Cód.</th>
                        <th>Item</th>
                        <th>Categoria</th>
                        <th>Quantidade</th>
                        <th>Preço Unit.</th>
                        <th>Total</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($produtos as $produto): ?>
                    <tr>
                        <td><?php echo $produto['id']; ?></td>
                        <td><?php echo htmlspecialchars($produto['item']); ?></td>
                        <td><?php echo htmlspecialchars($produto['categoria']); ?></td>
                        <td>
                            <?php 
                                $qtd = $produto['quantidade'] ?? 0;
                                if ($qtd <= 0) {
                                    $cor = "#EF4444";
                                    $peso = "bold";
                                } elseif ($qtd <= 30) {
                                    $cor = "#FBBF24";
                                    $peso = "normal";
                                } else {
                                    $cor = "#D0D8E8";
                                    $peso = "normal";
                                }
                            ?>
                            <span style="color: <?php echo $cor; ?>; font-weight: <?php echo $peso; ?>;">
                                <?php echo $produto['quantidade']; ?>
                            </span>
                        </td>
                        <td>R$ <?php echo number_format((float)$produto['preco'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($produto['quantidade'] * $produto['preco'], 2, ',', '.'); ?></td>
                        <td class="acoes">
                            <form method="POST">
                                <input type="hidden" name="id" value="<?= $produto['id']; ?>">
                                <button type="submit" name="acao" value="add" class="btn-acao btn-add">+</button>
                                <button type="submit" name="acao" value="remove" class="btn-acao btn-remove">-</button>
                                <button type="submit" name="lixeira" class="btn-acao btn-lixeira">🗑️</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="estoque-rodape">
            <div class="rodape-item">
                <span class="rodape-label">Valor Total em Estoque:</span>
                <span class="rodape-valor">
                    R$ <?php
                        $total = array_sum(array_map(function($p) {
                            $qtd = (float)($p['quantidade'] ?? 0);
                            $preco = (float)($p['preco'] ?? 0);
                            return $qtd * $preco;
                        }, $produtos));
                        echo number_format($total, 2, ',', '.');
                    ?>
                </span>
            </div>
            <div class="rodape-item">
                <span class="rodape-label">Total de Itens:</span>
                <span class="rodape-valor"><?php echo count($produtos); ?></span>
            </div>
            <div class="rodape-item">
                <span class="rodape-label">Alertas de Reposição:</span>
                <span class="rodape-valor rodape-alerta">
                    <?php echo count(array_filter($produtos, fn($p) => $p['quantidade'] <= 30)); ?>
                </span>
            </div>
        </div>
    </main>
    <?php require_once '../partials/footer.php'; ?>
</body>
</html>