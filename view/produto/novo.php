<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo Produto</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <form action="../../index.php?classe=Produto&metodo=store" method="post">
            <h1>Novo Produto</h1>
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            <label for="valor">Valor:</label>
            <input type="number" name="valor" id="valor" step="0.01" required>
            <label for="marca">Marca:</label>
            <input type="text" name="marca" id="marca" required>
            <label for="categoria">Categoria:</label>
            <input type="text" name="categoria" id="categoria" required>
            <button type="submit">Salvar</button>
        </form>
        <dialog>
            <p>Produto inserido com sucesso!</p>
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
            window.location.href = '../../index.php?classe=Produto&metodo=index';
        });
    </script>
</body>

</html>
