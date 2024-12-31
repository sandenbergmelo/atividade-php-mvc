<?php
include_once __DIR__ . '/../../model/Agendamento.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Agendamento $agendamento */
$agendamento = $_SESSION['agendamento'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do agendamento</title>
    <link rel="stylesheet" href="../css/mostrar_registro.css">
</head>

<body>
    <main>
        <?php
        $id = $agendamento->getId();
        $cliente_id = $agendamento->getClienteId();
        $servico_id = $agendamento->getServicoId();
        $cliente = $agendamento->getCliente();
        $servico = $agendamento->getServico();
        $data = formatarData($agendamento->getData());
        $horario = $agendamento->getHorario();
        $duracao = $agendamento->getDuracao();
        $status = $agendamento->getStatus();
        echo "<h1>Mostrando dados do agendamento</h1>";
        echo "<p class='dado' id='p-id' data-id='$id'>Id: $id</p>";
        echo "<p class='dado'>Cliente: <a href='../../index.php?classe=Cliente&metodo=show&id=$cliente_id'>{$cliente->getNome()}</a></p>";
        echo "<p class='dado'>Serviço: <a href='../../index.php?classe=Servico&metodo=show&id=$servico_id'>{$servico->getNome()}</a></p>";
        echo "<p class='dado'>Data: $data</p>";
        echo "<p class='dado'>Horário: $horario</p>";
        echo "<p class='dado'>Duração: $duracao minutos</p>";
        echo "<p class='dado'>Status: $status</p>";
        ?>
    </main>

    <footer>
        <section>
            <button class="editar">Editar</button>
            <button class="excluir">Excluir</button>
        </section>
        <section>
            <button onclick="window.location.href='../../index.php?classe=Agendamento&metodo=index'">Voltar</button>
            <button class="home" onclick="window.location.href='../../index.php'">Home</button>
        </section>
    </footer>

    <dialog id="modal-confirmacao">
        <p>Deseja realmente excluir este agendamento?</p>
        <button class="modal" id="excluir">Excluir</button>
        <button class="modal" id="cancelar">Cancelar</button>
    </dialog>

    <dialog id="modal-resposta">
        <p>Agendamento excluído com sucesso!</p>
        <button class="modal" id="ok">OK</button>
    </dialog>

    <script>
        const botaoEditar = document.querySelector('.editar');
        botaoEditar.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();
            window.location.href = `../../index.php?classe=Agendamento&metodo=edit&id=${id}`;
        });

        const botaoExcluir = document.querySelector('.excluir');
        botaoExcluir.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();
            modalConfirm.showModal();
            modalConfirm.setAttribute('data-id', id);
        });

        const modalConfirm = document.querySelector('#modal-confirmacao');
        const modalConfirmExcluir = modalConfirm.querySelector('#excluir');
        const modalConfirmCancel = modalConfirm.querySelector('#cancelar');
        const modalResposta = document.querySelector('#modal-resposta');
        const modalRespostaOk = modalResposta.querySelector('#ok');

        modalConfirmCancel.addEventListener('click', () => modalConfirm.close());

        modalConfirmExcluir.addEventListener('click', () => {
            modalConfirm.close();
            const id = modalConfirm.getAttribute('data-id').trim();
            fetch(`../../index.php?classe=Agendamento&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal());
        });

        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Agendamento&metodo=index`;
        });

        modalRespostaOk.addEventListener('click', () => {
            modalResposta.close();
        });
    </script>
</body>

</html>
