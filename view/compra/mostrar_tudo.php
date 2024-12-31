<?php

include_once __DIR__ . '/../../model/Compra.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Compra[] $compras */
$compras = $_SESSION['compras'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf8">
    <title>Lista de Compras</title>
    <link rel="stylesheet" href="../css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Compras</h1>
        <button onclick="window.location.href='../../index.php?classe=Compra&metodo=create'">Nova Compra</button>
        <a href="../../index.php?classe=Compra&metodo=index" class="reload">⟳</a>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Cliente</th>
                    <th>Produto</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Quantidade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($compras as $compra) {
                    $id = $compra->getId();
                    $cliente = $compra->getCliente();
                    $produto = $compra->getProduto();
                    $cliente_id = $compra->getClienteId();
                    $produto_id = $compra->getProdutoId();
                    $data = formatarData($compra->getData());
                    $horario = $compra->getHorario();
                    $qtd = $compra->getQtd();

                    echo "<tr>";
                    echo "<td> <a href='../../index.php?classe=Compra&metodo=show&id=$id'> $id </a> </td>";
                    echo "<td> <a href='../../index.php?classe=Cliente&metodo=show&id=$cliente_id'> {$cliente->getNome()} </a> </td>";
                    echo "<td> <a href='../../index.php?classe=Produto&metodo=show&id=$produto_id'> {$produto->getNome()} </a> </td>";
                    echo "<td> $data </td>";
                    echo "<td> $horario </td>";
                    echo "<td> $qtd </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Compra&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='#' data-id='$id'>[Excluir]</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

        <button class="home" onclick="window.location.href='../../index.php'">Home</button>

        <dialog id="modal-confirmacao">
            <p>Deseja realmente excluir esta compra?</p>
            <button id="excluir">Excluir</button>
            <button id="cancelar">Cancelar</button>
        </dialog>

        <dialog id="modal-resposta">
            <p>Compra excluída com sucesso!</p>
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
            fetch(`../../index.php?classe=Compra&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal());
        });

        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Compra&metodo=index`;
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
