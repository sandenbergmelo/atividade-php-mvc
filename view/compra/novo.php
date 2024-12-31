<?php
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../model/Produto.php';

session_start();

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

/** @var Produto[] $produtos */
$produtos = $_SESSION['produtos'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar nova Compra</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <form action="../../index.php?classe=Compra&metodo=store" method="post">
            <h1>Nova Compra</h1>
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <?php
                foreach ($clientes as $cliente) {
                    echo "<option value='{$cliente->getId()}'>{$cliente->getNome()}</option>";
                }
                ?>
            </select>
            <label for="produto_id">Produto:</label>
            <select name="produto_id" id="produto_id" required>
                <?php
                foreach ($produtos as $produto) {
                    echo "<option value='{$produto->getId()}'>{$produto->getNome()}</option>";
                }
                ?>
            </select>
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required>
            <label for="horario">Horário:</label>
            <input type="time" name="horario" id="horario" required>
            <label for="qtd">Quantidade:</label>
            <input type="number" name="qtd" id="qtd" required>
            <button type="submit">Salvar</button>
        </form>
        <dialog>
            <p>Compra inserida com sucesso!</p>
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
                .then(response => {
                    if (response.ok) {
                        dialog.showModal(); // Mostra o diálogo após a submissão
                    } else {
                        alert('Erro ao inserir compra.');
                    }
                });
        });

        dialogButton.addEventListener('click', () => {
            dialog.close();
        });

        // Adiciona evento para redirecionar após fechar o diálogo
        dialog.addEventListener('close', () => {
            window.location.href = '../../index.php?classe=Compra&metodo=index';
        });
    </script>
</body>

</html>
