<?php
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Cliente $cliente */
$cliente = $_SESSION['cliente'];
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados do cliente</title>
    <link rel="stylesheet" href="../css/mostrar_registro.css">
</head>

<body>
    <main>
        <?php
        $id = $cliente->getId();
        $nome = $cliente->getNome();
        $cpf = formatarCpf($cliente->getCpf());
        $dtNasc = formatarData($cliente->getDtNasc());
        $whatsapp = formatarTelefone($cliente->getWhatsapp());
        $logradouro = $cliente->getLogradouro();
        $numero = $cliente->getNum();
        $bairro = $cliente->getBairro();
        echo "<h1>Mostrando dados de $nome</h1>";
        echo "<p class='dado' id='p-id' data-id='$id'>Id: $id</p>";
        echo "<p class='dado'>Nome: $nome</p>";
        echo "<p class='dado'>CPF: $cpf</p>";
        echo "<p class='dado'>Data de Nascimento: $dtNasc</p>";
        echo "<p class='dado'>Whatsapp: $whatsapp</p>";
        echo "<p class='dado'>Logradouro: $logradouro</p>";
        echo "<p class='dado'>Número: $numero</p>";
        echo "<p class='dado'>Bairro: $bairro</p>";
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
        <p>Deseja realmente excluir este cliente?</p>
        <button class="modal" id="excluir">Excluir</button>
        <button class="modal" id="cancelar">Cancelar</button>
    </dialog>

    <dialog id="modal-resposta">
        <p>Cliente excluído com sucesso!</p>
        <button class="modal" id="ok">OK</button>
    </dialog>

    <script>
        // Seleciona o botão de edição
        const botaoEditar = document.querySelector('.editar');

        // Adiciona evento de clique para redirecionar para a página de edição
        botaoEditar.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();
            window.location.href = `../../index.php?classe=Cliente&metodo=edit&id=${id}`;
        });

        // Seleciona o botão de exclusão
        const botaoExcluir = document.querySelector('.excluir');

        // Adiciona evento de clique para cada botão de exclusão
        botaoExcluir.addEventListener('click', () => {
            const id = document.querySelector('#p-id').getAttribute('data-id').trim();

            modalConfirm.showModal();
            modalConfirm.setAttribute('data-id', id);
        });

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
    </script>
</body>

</html>
