<?php
require_once 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') { 
  $email1 = $_POST['email'] ;
  $senha1 = $_POST['senha'] ;

  if ($email1 == $emailCerto && $senha1 == $senhaCerta){
    header("Location: estoque.php");
    exit;
  }
  else{
    $erro = 'Email ou senha incorretos';
  }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - <?php print $nomeLoja; ?></title>
  <link rel="stylesheet" href="styles/style.css">
</head>
<body class="pagina-login">
  <div class="login-box">
    
    <img src="imagens/FundoSite.png" alt="ConstruTech">
    <form class="formulario-login" method="POST">
      <label for="email">E-mail</label>
      <input type="email" id="email" name="email" required>
      <label for="senha">Senha</label>
      <input type="password" id="senha" name="senha" required>
      <button type="submit" class="btn-login">Entrar</button>
      <?php if(!empty($erro)): ?>
      <p style="text-align: center;"><?php echo $erro?> </p>
    <?php endif; ?>
    </form>
  </div>
</body>
</html>