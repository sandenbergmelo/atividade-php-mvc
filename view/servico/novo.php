<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo Serviço</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <form action="../../index.php?classe=Servico&metodo=store" method="post">
            <h1>Novo Serviço</h1>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" step="0.01" required>
            <label for="descricao">Descrição:</label>
            <textarea name="descricao" id="descricao" required></textarea>
            <button type="submit">Salvar</button>
        </form>
        <dialog>
            <p>Serviço inserido com sucesso!</p>
            <button>OK</button>
        </dialog>
    </main>
    <script>
        const form = document.querySelector('form');
        const dialog = document.querySelector('dialog');
        const dialogButton = dialog.querySelector('button');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(form);
            const url = form.getAttribute('action');

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(data => dialog.showModal());
        });

        dialogButton.addEventListener('click', () => {
            dialog.close();
        });

        dialog.addEventListener('close', () => {
            window.location.href = '../../index.php?classe=Servico&metodo=index';
        });
    </script>
</body>

</html>
