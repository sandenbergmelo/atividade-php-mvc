<?php

include_once __DIR__ . '/../../model/Servico.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Servico[] $servicos */
$servicos = $_SESSION['servicos'];

?>

<!DOCTYPE html>
<html lang=”pt-br”>

<head>
    <meta charset=”utf8”>
    <title>Lista de Serviços</title>
    <link rel="stylesheet" href="../css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Serviços</h1>
        <button onclick="window.location.href='../../index.php?classe=Servico&metodo=create'">Novo Serviço</button>
        <a href="../../index.php?classe=Servico&metodo=index" class="reload">⟳</a>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Descrição</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($servicos as $servico) {
                    $id = $servico->getId();
                    $nome = $servico->getNome();
                    $valor = formatarDinheiro($servico->getValor());
                    $descricao = $servico->getDescricao();

                    echo "<tr>";
                    echo "<td> $id </td>";
                    echo "<td> <a href='../../index.php?classe=Servico&metodo=show&id=$id'> $nome </a> </td>";
                    echo "<td> $valor </td>";
                    echo "<td> $descricao </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Servico&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='#' data-id='$id'>[Excluir]</a>";
                    echo "</td>";
                }
                ?>
            </tbody>
        </table>

        <button class="home" onclick="window.location.href='../../index.php'">Home</button>

        <dialog id="modal-confirmacao">
            <p>Deseja realmente excluir este serviço?</p>
            <button id="excluir">Excluir</button>
            <button id="cancelar">Cancelar</button>
        </dialog>

        <dialog id="modal-resposta">
            <p>Serviço excluído com sucesso!</p>
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

            // Obtém o ID do serviço a ser excluído
            const id = modalConfirm.getAttribute('data-id').trim();

            // Faz uma requisição para excluir o servico
            fetch(`../../index.php?classe=Servico&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal()); // Mostra o modal de resposta após a exclusão
        });

        // Adiciona evento para redirecionar após fechar o modal de resposta
        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Servico&metodo=index`;
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
