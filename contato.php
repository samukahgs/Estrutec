<!DOCTYPE html>
<html>
<head>
    <title>Contato - Estrutec</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
<?php include 'partials/header.php'; ?>
<main>
    <div class="form-container">
        <h2>Fale Conosco</h2>
        <form action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="003094ff-69d0-4e8e-8a3d-219a585f9938">
            <div class="form-group"><label>Nome Completo*</label><input type="text" name="nome" required></div>
            <div class="form-group"><label>E-mail*</label><input type="email" name="email" required></div>
            <div class="form-group"><label>Telefone*</label><input type="text" name="telefone" required></div>
            <div class="form-group"><label>Mensagem*</label><textarea name="mensagem" rows="4" required></textarea></div>
            <button type="submit">Enviar Mensagem</button>
        </form>
    </div>
</main>
<?php include 'partials/footer.php'; ?>
</body>
</html>