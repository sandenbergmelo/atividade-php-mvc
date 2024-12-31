<?php

include_once __DIR__ . '/../../model/Agendamento.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Agendamento[] $agendamentos */
$agendamentos = $_SESSION['agendamentos'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf8">
    <title>Lista de Agendamentos</title>
    <link rel="stylesheet" href="../css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Agendamentos</h1>
        <button onclick="window.location.href='../../index.php?classe=Agendamento&metodo=create'">Novo Agendamento</button>
        <a href="../../index.php?classe=Agendamento&metodo=index" class="reload">⟳</a>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Serviço</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Duração</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($agendamentos as $agendamento) {
                    $id = $agendamento->getId();
                    $cliente = $agendamento->getCliente();
                    $servico = $agendamento->getServico();
                    $cliente_id = $agendamento->getClienteId();
                    $servico_id = $agendamento->getServicoId();
                    $data = formatarData($agendamento->getData());
                    $horario = $agendamento->getHorario();
                    $duracao = $agendamento->getDuracao();
                    $status = $agendamento->getStatus();

                    echo "<tr>";
                    echo "<td> <a href='../../index.php?classe=Agendamento&metodo=show&id=$id'> $id </a> </td>";
                    echo "<td> <a href='../../index.php?classe=Cliente&metodo=show&id=$cliente_id'> {$cliente->getNome()} </a> </td>";
                    echo "<td> <a href='../../index.php?classe=Servico&metodo=show&id=$servico_id'> {$servico->getNome()} </a> </td>";
                    echo "<td> $data </td>";
                    echo "<td> $horario </td>";
                    echo "<td> $duracao minutos </td>";
                    echo "<td> $status </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Agendamento&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='#' data-id='$id'>[Excluir]</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button class="home" onclick="window.location.href='../../index.php'">Home</button>

        <dialog id="modal-confirmacao">
            <p>Deseja realmente excluir este agendamento?</p>
            <button id="excluir">Excluir</button>
            <button id="cancelar">Cancelar</button>
        </dialog>

        <dialog id="modal-resposta">
            <p>Agendamento excluído com sucesso!</p>
            <button id="ok">OK</button>
        </dialog>
    </main>
    <script>
        const botoesExcluir = document.querySelectorAll('.excluir');
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

        botoesExcluir.forEach((botao) => {
            botao.addEventListener('click', () => {
                const id = botao.getAttribute('data-id').trim();
                modalConfirm.setAttribute('data-id', id);
                modalConfirm.showModal();
            });
        });
    </script>
</body>

</html>
