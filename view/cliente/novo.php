<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserir Cliente</title>
    <link rel="stylesheet" href="css/novo.css">
</head>

<body>
    <main>
        <form action="../../index.php?classe=Cliente&metodo=store" method="post">
            <h1>Novo Cliente</h1>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <label for="cpf">CPF:</label>
            <input type="text" name="cpf" id="cpf" pattern="\d*" minlength="11" maxlength="11" required>
            <label for="dtNasc">Data de Nascimento:</label>
            <input type="date" name="dtNasc" id="dtNasc" required>
            <label for="whatsapp">Whatsapp:</label>
            <input type="text" name="whatsapp" id="whatsapp" pattern="\d*" minlength="11" maxlength="11" required>
            <label for="logradouro">Logradouro:</label>
            <input type="text" name="logradouro" id="logradouro" required>
            <label for="num">Número:</label>
            <input type="text" name="num" id="num" pattern="\d*" required>
            <label for="bairro">Bairro:</label>
            <input type="text" name="bairro" id="bairro" required>
            <button type="submit">Salvar</button>
        </form>
    </main>
</body>

</html>
