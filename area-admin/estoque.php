<?php
require_once 'init.php';

$categoriaFiltro = $_GET['categoria'] ?? '';

$produtosFiltrados = $categoriaFiltro ? array_filter($_SESSION['produtos'], fn($p) => $p['categoria'] === $categoriaFiltro) : $_SESSION['produtos'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') { /*se o servidor receber um método post*/
    $id = $_POST['id']; /*recebe o id que estava hidden*/
    $acao = $_POST['acao'];/*recebe o valor da acao*/

    foreach ($_SESSION['produtos'] as $key => $produto) { /*dentro da session produtos, busca a chave e o valor*/
      if ((int)$produto['id'] === (int)$id) { /*verifica id*/
          if ($acao == 'add'){ /*se a ação for add, incrementa 1 em quantidade*/
              $_SESSION['produtos'][$key]['quantidade']++;
          }
          if ($acao == 'remove' && $_SESSION['produtos'][$key]['quantidade'] > 0) { /*se a ação for remover e a quantidade for maior que 0, decrementa 1 em quantidade*/
              $_SESSION['produtos'][$key]['quantidade']--;
          }
          if (isset($_POST['lixeira'])){
            unset($_SESSION['produtos'][$key]);
          }
          break; /*quebra o loop*/
      }
    }
    header("Location: estoque.php"); /*retorna para a pagina*/
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ConstruTech - Estoque</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <?php require_once 'partials/header.php'; ?>

  <main class="pagina-estoque">

    <div class="estoque-filtros">
      <img src="./imagens/Filter.png" alt="Filtrar" class="icone-filtro">
      <?php foreach ($categorias as $chave => $label): ?>
        <a href="estoque.php?categoria=<?php echo $chave; ?>" class="tag-filtro <?php echo $categoriaFiltro === $chave ? 'tag-ativa' : ''; ?>"><?php echo $label; ?></a>
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
          <?php foreach ($produtosFiltrados as $produto): ?>
          <tr>
            <td><?php echo $produto['id']; ?></td>
            <td><?php echo $produto['nome']; ?>
            </td>
            <td><?php echo $categorias[$produto['categoria']] ?? $produto['categoria']; ?></td>
            <td>
                <?php 
                    $qtd = $produto['quantidade'] ?? 0;
                    if ($qtd <= 0) {
                        $cor = "#EF4444"; // vermelho (Esgotado)
                        $peso = "bold";
                    } elseif ($qtd <= 30) {
                        $cor = "#FBBF24"; // amarelo (Alerta)
                        $peso = "normal";
                    } else {
                        $cor = "#D0D8E8"; // padrão (Cheio)
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
              <form METHOD="POST">
                <input type="hidden" name="id" value="<?= $produto['id']; ?>"> <!-- Leva o id do produto selecionado junto -->
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
            $qtd = (float) str_replace(',', '.', $p['quantidade'] ?? 0);  
            $preco = (float) str_replace(',', '.', $p['preco'] ?? 0); return $qtd * $preco;}, $produtosFiltrados));
            echo number_format($total, 2, ',', '.');
          ?>
        </span>
      </div>
      <div class="rodape-item">
        <span class="rodape-label">Total de Itens:</span>
        <span class="rodape-valor"><?php echo count($produtosFiltrados); ?></span>
      </div>
      <div class="rodape-item">
        <span class="rodape-label">Alertas de Reposição:</span>
        <span class="rodape-valor rodape-alerta">
          <?php echo count(array_filter($produtosFiltrados, fn($p) => $p['quantidade'] <= 30)); ?>
        </span>
      </div>
    </div>
  </main>
</body>
</html>




