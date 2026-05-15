<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SFI Solutions-Contato</title>
    <link rel="stylesheet" href="Contato.css">
</head>
<body>
    <section class="secao-contato">
    <div class="cartao">
        <h2>Fale Conosco</h2>
        <form action="https://api.web3forms.com/submit" method="POST">
            <input type="hidden" name="access_key" value="003094ff-69d0-4e8e-8a3d-219a585f9938">
            
            <div class="grupo">
                <label>Nome</label>
                <input type="text" name="nome" placeholder="Seu nome" required>
            </div>

            <div class="grupo">
                <label>E-mail</label>
                <input type="email" name="email" placeholder="seu@email.com" required>
            </div>
            <div>
              <label>Telefone</label>
              <input type="number" name="Number" placeholder="+55 (DD) 9XXXX-XXXX" required>
            </div>

            <div class="grupo">
                <label>Mensagem</label>
                <textarea name="mensagem" rows="4" placeholder="Como podemos ajudar?" required></textarea>
            </div>

            <button type="submit">Enviar mensagem</button>
        </form>
    </div>

</body>
</html>