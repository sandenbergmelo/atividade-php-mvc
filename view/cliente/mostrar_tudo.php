<?php

include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

?>

<!DOCTYPE html>
<html lang=”pt-br”>

<head>
    <meta charset=”utf8”>
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="../css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Clientes</h1>
        <button onclick="window.location.href='../../index.php?classe=Cliente&metodo=create'">Novo Cliente</button>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clientes as $cliente) {
                    $id = $cliente->getId();
                    $nome = $cliente->getNome();
                    $cpf = formatarCpf($cliente->getCpf());
                    $dtNasc = formatarData($cliente->getDtNasc());

                    echo "<tr>";
                    echo "<td> $id </td>";
                    echo "<td> <a href='../../index.php?classe=Cliente&metodo=show&id=$id'> $nome </a> </td>";
                    echo "<td> $cpf </td>";
                    echo "<td> $dtNasc </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Cliente&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='#' data-id='$id'>[Excluir]</a>";
                    echo "</td>";
                }
                ?>
            </tbody>
        </table>

        <dialog id="modal-confirmacao">
            <p>Deseja realmente excluir este cliente?</p>
            <button id="excluir">Excluir</button>
            <button id="cancelar">Cancelar</button>
        </dialog>

        <dialog id="modal-resposta">
            <p>Cliente excluído com sucesso!</p>
            <button id="ok">OK</button>
        </dialog>
    </main>
    <script>
        // Seleciona todos os botões de exclusão
        const botoesExcluir = document.querySelectorAll('.excluir');

        // Seleciona o modal de confirmação e seus botões
        const modalConfirm = document.querySelector('#modal-confirmacao');
        const modalConfirmExcluir = modalConfirm.querySelector('#modal-confirmacao #excluir');
        const modalConfirmCancel = modalConfirm.querySelector('#modal-confirmacao #cancelar');

        // Seleciona o modal de resposta e seu botão
        const modalResposta = document.querySelector('#modal-resposta');
        const modalRespostaOk = modalResposta.querySelector('#modal-resposta #ok');

        // Adiciona evento de clique para cancelar a exclusão e fechar o modal de confirmação
        modalConfirmCancel.addEventListener('click', () => modalConfirm.close());

        // Adiciona evento de clique para confirmar a exclusão
        modalConfirmExcluir.addEventListener('click', () => {
            modalConfirm.close();

            // Obtém o ID do cliente a ser excluído
            const id = modalConfirm.getAttribute('data-id').trim();

            // Faz uma requisição para excluir o cliente
            fetch(`../../index.php?classe=Cliente&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal()); // Mostra o modal de resposta após a exclusão
        });

        // Adiciona evento para redirecionar após fechar o modal de resposta
        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Cliente&metodo=index`;
        });

        modalRespostaOk.addEventListener('click', () => {
            modalResposta.close();
        });

        // Adiciona evento de clique para cada botão de exclusão
        botoesExcluir.forEach((botao) => {
            botao.addEventListener('click', () => {
                const id = botao.getAttribute('data-id').trim();

                // Define o ID no modal de confirmação e exibe o modal
                modalConfirm.setAttribute('data-id', id);
                modalConfirm.showModal();
            });
        });
    </script>
</body>

</html>
