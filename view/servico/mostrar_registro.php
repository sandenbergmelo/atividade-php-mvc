<?php
include_once __DIR__ . '/../../model/Servico.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Servico $servico */
$servico = $_SESSION['servico'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do serviço</title>
    <link rel="stylesheet" href="../css/mostrar_registro.css">
</head>

<body>
    <main>
        <?php
        $id = $servico->getId();
        $nome = $servico->getNome();
        $valor = formatarDinheiro($servico->getValor());
        $descricao = $servico->getDescricao();
        echo "<h1>Mostrando dados de $nome</h1>";
        echo "<p class='dado' id='p-id' data-id='$id'>Id: $id</p>";
        echo "<p class='dado'>Nome: $nome</p>";
        echo "<p class='dado'>Valor: $valor</p>";
        echo "<p class='dado'>Descrição: $descricao</p>";
        ?>
    </main>

    <footer>
        <section>
            <button class="editar">Editar</button>
            <button class="excluir">Excluir</button>
        </section>
        <section>
            <button onclick="window.history.back()">Voltar</button>
            <button class="home" onclick="window.location.href='../../index.php'">Home</button>
        </section>
    </footer>

    <dialog id="modal-confirmacao">
        <p>Deseja realmente excluir este serviço?</p>
        <button class="modal" id="excluir">Excluir</button>
        <button class="modal" id="cancelar">Cancelar</button>
    </dialog>

    <dialog id="modal-resposta">
        <p>Serviço excluído com sucesso!</p>
        <button class="modal" id="ok">OK</button>
    </dialog>

    <script>
        const botaoEditar = document.querySelector('.editar');
        botaoEditar.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();
            window.location.href = `../../index.php?classe=Servico&metodo=edit&id=${id}`;
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
            fetch(`../../index.php?classe=Servico&metodo=delete&id=${id}`)
                .then(() => modalResposta.showModal());
        });

        modalResposta.addEventListener('close', () => {
            window.location.href = `../../index.php?classe=Servico&metodo=index`;
        });

        modalRespostaOk.addEventListener('click', () => {
            modalResposta.close();
        });
    </script>
</body>

</html>
