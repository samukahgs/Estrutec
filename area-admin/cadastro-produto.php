<?php
require_once 'init.php';

// print_r($_POST);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

$ids = array_column($_SESSION['produtos'], 'id');
$novoId = $ids ? max($ids) + 1: 1;

$_SESSION['produtos'][] = [
        'id' => $novoId,
        'nome' => $_POST['nome'],
        'quantidade' => $_POST['quantidade'],
        'categoria' => $_POST['categoria'],
        'preco' => $_POST['preco']
    ];
    }
    // print '<pre>';
    // print_r($_SESSION['produtos']);
    // print '</pre>';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Início - <?php print $nomeLoja; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body>
  <?php 
  require_once 'partials/header.php';
  ?>

  <main class="cadastro">
    <h1>Cadastro de produto</h1>

    <form class="formulario" action="cadastro-produto.php" method="post">
      <label for="nome">Nome do produto</label>
      <input type="text" id="nome" name="nome" required>

      <label for="preco">Preço (ex.: 120,50)</label>
      <input type="text" id="preco" name="preco" required>
      
      <label for="preco">Quantidade</label>
      <input type="number" id="quantidade" name="quantidade" required>

      <label for="categoria">Categoria</label>
      <select id="categoria" name="categoria" required>
        <option value="">Selecione</option>
        <option value="bruto">Bruto</option>
        <option value="ferramentas">Ferramentas</option>
        <option value="acabamento">Acabamento</option>
      </select>

      <button type="submit" class="btn">Cadastrar</button>

    </form>
  </main>
</body>
</html>
