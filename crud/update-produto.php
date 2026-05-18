<?php
require_once '../config/crud.php';
session_start();
if ($_SESSION['papel'] === 'cliente') exit('Acesso negado');

$id = $_POST['id'];
$acao = $_POST['acao'] ?? null;

if ($acao === 'add') {
    $produto = read($pdo, 'produtos', "id = $id");
    update($pdo, 'produtos', ['quantidade' => $produto['quantidade'] + 1], "id = $id");
} elseif ($acao === 'remove') {
    $produto = read($pdo, 'produtos', "id = $id");
    if ($produto['quantidade'] > 0) {
        update($pdo, 'produtos', ['quantidade' => $produto['quantidade'] - 1], "id = $id");
    }
} elseif (isset($_POST['editar'])) {
    update($pdo, 'produtos', [
        'item' => $_POST['nome'],
        'categoria' => $_POST['categoria'],
        'descricao' => $_POST['descricao'],
        'preco' => str_replace(',', '.', $_POST['preco'])
    ], "id = $id");
}

header('Location: ../area-admin/estoque.php');
exit;