<?php
include_once __DIR__ . '/../../model/Servico.php';

session_start();

/** @var Servico $servico */
$servico = $_SESSION['servico'];

$id = $servico->getId();
$nome = htmlspecialchars($servico->getNome());
$valor = htmlspecialchars($servico->getValor());
$descricao = htmlspecialchars($servico->getDescricao());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar informações do Serviço</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <?php
        echo "<form action='../../index.php?classe=Servico&metodo=update&id=$id' method='post'>";
        echo "<h1>Editar informações do serviço</h1>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' name='nome' id='nome' value='$nome' required>";
        echo "<label for='valor'>Valor:</label>";
        echo "<input type='number' name='valor' id='valor' step='0.01' value='$valor' required>";
        echo "<label for='descricao'>Descrição:</label>";
        echo "<textarea name='descricao' id='descricao' required>$descricao</textarea>";
        echo "<button type='submit'>Salvar</button>";
        echo "</form>";
        ?>
        <dialog>
            <p>Dados do serviço atualizados com sucesso!</p>
            <button>OK</button>
        </dialog>
    </main>
    <script>
        const form = document.querySelector('form');
        const dialog = document.querySelector('dialog');
        const dialogButton = dialog.querySelector('button');

        form.addEventListener('submit', (event) => {
            event.preventDefault();
            const formData = new FormData(form);
            const url = form.getAttribute('action');

            fetch(url, {
                    method: 'POST',
                    body: formData
                })
                .then(data => dialog.showModal());
        });

        dialogButton.addEventListener('click', () => {
            dialog.close();
        });

        dialog.addEventListener('close', () => {
            window.location.href = '../../index.php?classe=Servico&metodo=index';
        });
    </script>
</body>

</html>
