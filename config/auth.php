<?php
// config/auth.php - Controle de acesso
session_start();

if (!isset($_SESSION['id_login'])) {
    header('Location: ../login.php');
    exit;
}

// Se a página exigir gerente (definir $requer_gerente = true antes de incluir este arquivo)
if (isset($requer_gerente) && $requer_gerente && $_SESSION['papel'] !== 'gerente') {
    header('Location: dashboard.php');
    exit;
}
?>