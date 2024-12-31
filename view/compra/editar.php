<?php
include_once __DIR__ . '/../../model/Compra.php';
include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../model/Produto.php';

session_start();

/** @var Compra $compra */
$compra = $_SESSION['compra'];

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

/** @var Produto[] $produtos */
$produtos = $_SESSION['produtos'];

$id = $compra->getId();
$cliente_id = $compra->getClienteId();
$produto_id = $compra->getProdutoId();
$data = htmlspecialchars($compra->getData());
$horario = htmlspecialchars($compra->getHorario());
$qtd = htmlspecialchars($compra->getQtd());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar informações da Compra</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <?php
        echo "<form action='../../index.php?classe=Compra&metodo=update&id=$id' method='post'>";
        echo "<h1>Editar informações da compra</h1>";
        echo "<label for='cliente_id'>Cliente:</label>";
        echo "<select name='cliente_id' id='cliente_id' required>";
        foreach ($clientes as $cliente) {
            $selected = ($cliente->getId() == $cliente_id) ? 'selected' : '';
            echo "<option value='{$cliente->getId()}' $selected>{$cliente->getNome()}</option>";
        }
        echo "</select>";
        echo "<label for='produto_id'>Produto:</label>";
        echo "<select name='produto_id' id='produto_id' required>";
        foreach ($produtos as $produto) {
            $selected = ($produto->getId() == $produto_id) ? 'selected' : '';
            echo "<option value='{$produto->getId()}' $selected>{$produto->getNome()}</option>";
        }
        echo "</select>";
        echo "<label for='data'>Data:</label>";
        echo "<input type='date' name='data' id='data' value='$data' required>";
        echo "<label for='horario'>Horário:</label>";
        echo "<input type='time' name='horario' id='horario' value='$horario' required>";
        echo "<label for='qtd'>Quantidade:</label>";
        echo "<input type='number' name='qtd' id='qtd' value='$qtd' required>";
        echo "<button type='submit'>Salvar</button>";
        echo "</form>";
        ?>
        <dialog>
            <p>Dados da compra atualizados com sucesso!</p>
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
            window.location.href = '../../index.php?classe=Compra&metodo=index';
        });
    </script>
</body>

</html>
