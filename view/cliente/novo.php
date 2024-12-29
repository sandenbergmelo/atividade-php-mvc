<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo Cliente</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
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
        <dialog>
            <p>Cliente inserido com sucesso!</p>
            <button>OK</button>
        </dialog>
    </main>
    <script>
        // Seleciona o formulário, o diálogo e o botão dentro do diálogo
        const form = document.querySelector('form');
        const dialog = document.querySelector('dialog');
        const dialogButton = dialog.querySelector('button');

        // Adiciona evento de submissão ao formulário
        form.addEventListener('submit', (event) => {
            // Previne o comportamento padrão de submissão do formulário
            event.preventDefault();

            const formData = new FormData(form);
            const url = form.getAttribute('action');

            // Faz uma requisição POST com os dados do formulário
            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(data => dialog.showModal()); // Mostra o diálogo após a submissão
        });

        dialogButton.addEventListener('click', () => {
            dialog.close();
        });

        // Adiciona evento para redirecionar após fechar o diálogo
        dialog.addEventListener('close', () => {
            window.location.href = '../../index.php?classe=Cliente&metodo=index';
        });
    </script>
</body>

</html>
