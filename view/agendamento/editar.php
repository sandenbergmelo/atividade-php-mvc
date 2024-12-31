<?php
include_once __DIR__ . '/../../model/Agendamento.php';
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../model/Servico.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Agendamento $agendamento */
$agendamento = $_SESSION['agendamento'];

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

/** @var Servico[] $servicos */
$servicos = $_SESSION['servicos'];

$id = $agendamento->getId();
$cliente_id = $agendamento->getClienteId();
$servico_id = $agendamento->getServicoId();
$data = htmlspecialchars($agendamento->getData());
$horario = htmlspecialchars($agendamento->getHorario());
$duracao = htmlspecialchars($agendamento->getDuracao());
$status = htmlspecialchars($agendamento->getStatus());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar informações do Agendamento</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <?php
        echo "<form action='../../index.php?classe=Agendamento&metodo=update&id=$id' method='post'>";
        echo "<h1>Editar informações do agendamento</h1>";
        echo "<label for='cliente_id'>Cliente:</label>";
        echo "<select name='cliente_id' id='cliente_id' required>";
        foreach ($clientes as $cliente) {
            $selected = ($cliente->getId() == $cliente_id) ? 'selected' : '';
            echo "<option value='{$cliente->getId()}' $selected>{$cliente->getNome()}</option>";
        }
        echo "</select>";
        echo "<label for='servico_id'>Serviço:</label>";
        echo "<select name='servico_id' id='servico_id' required>";
        foreach ($servicos as $servico) {
            $selected = ($servico->getId() == $servico_id) ? 'selected' : '';
            echo "<option value='{$servico->getId()}' $selected>{$servico->getNome()}</option>";
        }
        echo "</select>";
        echo "<label for='data'>Data:</label>";
        echo "<input type='date' name='data' id='data' value='$data' required>";
        echo "<label for='horario'>Horário:</label>";
        echo "<input type='time' name='horario' id='horario' value='$horario' required>";
        echo "<label for='duracao'>Duração (minutos):</label>";
        echo "<input type='number' name='duracao' id='duracao' value='$duracao' required>";
        echo "<label for='status'>Status:</label>";
        echo "<input type='text' name='status' id='status' value='$status' required>";
        echo "<button type='submit'>Salvar</button>";
        echo "</form>";
        ?>
        <dialog>
            <p>Dados do agendamento atualizados com sucesso!</p>
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
            // Não permite que o formulário seja submetido
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
