<?php
include_once __DIR__ . '/../../model/Compra.php';
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../model/Produto.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Compra $compra */
$compra = $_SESSION['compra'];

$id = $compra->getId();
$cliente_id = $compra->getClienteId();
$produto_id = $compra->getProdutoId();
$cliente = $compra->getCliente();
$produto = $compra->getProduto();
$data = formatarData($compra->getData());
$horario = $compra->getHorario();
$qtd = $compra->getQtd();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados da compra</title>
    <link rel="stylesheet" href="../css/mostrar_registro.css">
</head>

<body>
    <main>
        <?php
        echo "<h1>Mostrando dados da compra</h1>";
        echo "<p class='dado' id='p-id' data-id='$id'>Id: $id</p>";
        echo "<p class='dado'>Cliente: <a href='../../index.php?classe=Cliente&metodo=show&id=$cliente_id'>{$cliente->getNome()}</a></p>";
        echo "<p class='dado'>Produto: <a href='../../index.php?classe=Produto&metodo=show&id=$produto_id'>{$produto->getNome()}</a></p>";
        echo "<p class='dado'>Data: $data</p>";
        echo "<p class='dado'>Horário: $horario</p>";
        echo "<p class='dado'>Quantidade: $qtd</p>";
        ?>
    </main>

    <footer>
        <section>
            <button class="editar">Editar</button>
            <button class="excluir">Excluir</button>
        </section>
        <section>
            <button onclick="window.location.href='../../index.php?classe=Compra&metodo=index'">Voltar</button>
            <button class="home" onclick="window.location.href='../../index.php'">Home</button>
        </section>
    </footer>

    <dialog id="modal-confirmacao">
        <p>Deseja realmente excluir esta compra?</p>
        <button class="modal" id="excluir">Excluir</button>
        <button class="modal" id="cancelar">Cancelar</button>
    </dialog>

    <dialog id="modal-resposta">
        <p>Compra excluída com sucesso!</p>
        <button class="modal" id="ok">OK</button>
    </dialog>

    <script>
        const botaoEditar = document.querySelector('.editar');
        botaoEditar.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();
            window.location.href = `../../index.php?classe=Compra&metodo=edit&id=${id}`;
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
            fetch(`../../index.php?classe=Compra&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal());
        });

        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Compra&metodo=index`;
        });

        modalRespostaOk.addEventListener('click', () => {
            modalResposta.close();
        });
    </script>
</body>

</html>
