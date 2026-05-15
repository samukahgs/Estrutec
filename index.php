<?php
require_once 'init.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php $nomeEmpresa ?></title>
    <link rel="stylesheet" href="./styles/style.css">
</head>
<body>
    <?php 
        require_once 'partials/header.php';
    ?>
    <main>
        <a href="./area-admin/login.php">AREA ADMIN</a>
        <a href="./contato.php">CONTATO</a>
    </main>
    <?php 
        require_once 'partials/footer.php';
    ?>
</body>
</html>