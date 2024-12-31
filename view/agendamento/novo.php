<?php
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../model/Servico.php';

session_start();

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

/** @var Servico[] $servicos */
$servicos = $_SESSION['servicos'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar novo Agendamento</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <form action="../../index.php?classe=Agendamento&metodo=store" method="post">
            <h1>Novo Agendamento</h1>
            <label for="cliente_id">Cliente:</label>
            <select name="cliente_id" id="cliente_id" required>
                <?php
                foreach ($clientes as $cliente) {
                    echo "<option value='{$cliente->getId()}'>{$cliente->getNome()}</option>";
                }
                ?>
            </select>
            <label for="servico_id">Serviço:</label>
            <select name="servico_id" id="servico_id" required>
                <?php
                foreach ($servicos as $servico) {
                    echo "<option value='{$servico->getId()}'>{$servico->getNome()}</option>";
                }
                ?>
            </select>
            <label for="data">Data:</label>
            <input type="date" name="data" id="data" required>
            <label for="horario">Horário:</label>
            <input type="time" name="horario" id="horario" required>
            <label for="duracao">Duração (minutos):</label>
            <input type="number" name="duracao" id="duracao" required>
            <label for="status">Status:</label>
            <input type="text" name="status" id="status" required>
            <button type="submit">Salvar</button>
        </form>
        <dialog>
            <p>Agendamento inserido com sucesso!</p>
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
            window.location.href = '../../index.php?classe=Agendamento&metodo=index';
        });
    </script>
</body>

</html>
