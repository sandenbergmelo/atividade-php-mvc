<?php

include_once __DIR__ . '/../../model/Produto.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Produto[] $produtos */
$produtos = $_SESSION['produtos'];

?>

<!DOCTYPE html>
<html lang=”pt-br”>

<head>
    <meta charset=”utf8”>
    <title>Lista de Produtos</title>
    <link rel="stylesheet" href="../css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Produtos</h1>
        <button onclick="window.location.href='../../index.php?classe=Produto&metodo=create'">Novo Produto</button>
        <a href="../../index.php?classe=Produto&metodo=index" class="reload">⟳</a>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Valor</th>
                    <th>Marca</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($produtos as $produto) {
                    $id = $produto->getId();
                    $nome = $produto->getNome();
                    $valor = formatarDinheiro($produto->getValor());
                    $marca = $produto->getMarca();
                    $categoria = $produto->getCategoria();

                    echo "<tr>";
                    echo "<td> $id </td>";
                    echo "<td> <a href='../../index.php?classe=Produto&metodo=show&id=$id'> $nome </a> </td>";
                    echo "<td> $valor </td>";
                    echo "<td> $marca </td>";
                    echo "<td> $categoria </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Produto&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='#' data-id='$id'>[Excluir]</a>";
                    echo "</td>";
                }
                ?>
            </tbody>
        </table>

        <button class="home" onclick="window.location.href='../../index.php'">Home</button>

        <dialog id="modal-confirmacao">
            <p>Deseja realmente excluir este produto?</p>
            <button id="excluir">Excluir</button>
            <button id="cancelar">Cancelar</button>
        </dialog>

        <dialog id="modal-resposta">
            <p>Produto excluído com sucesso!</p>
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

            // Obtém o ID do produto a ser excluído
            const id = modalConfirm.getAttribute('data-id').trim();

            // Faz uma requisição para excluir o produto
            fetch(`../../index.php?classe=Produto&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal()); // Mostra o modal de resposta após a exclusão
        });

        // Adiciona evento para redirecionar após fechar o modal de resposta
        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Produto&metodo=index`;
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
