<?php
include_once __DIR__ . '/../../model/Produto.php';

session_start();

/** @var Produto $produto */
$produto = $_SESSION['produto'];

$id = $produto->getId();
$nome = htmlspecialchars($produto->getNome());
$valor = htmlspecialchars($produto->getValor());
$marca = htmlspecialchars($produto->getMarca());
$categoria = htmlspecialchars($produto->getCategoria());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar informações do Produto</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <?php
        echo "<form action='../../index.php?classe=Produto&metodo=update&id=$id' method='post'>";
        echo "<h1>Editar informações do produto</h1>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' name='nome' id='nome' value='$nome' required>";
        echo "<label for='valor'>Valor:</label>";
        echo "<input type='number' name='valor' id='valor' step='0.01' value='$valor' required>";
        echo "<label for='marca'>Marca:</label>";
        echo "<input type='text' name='marca' id='marca' value='$marca' required>";
        echo "<label for='categoria'>Categoria:</label>";
        echo "<input type='text' name='categoria' id='categoria' value='$categoria' required>";
        echo "<button type='submit'>Salvar</button>";
        echo "</form>";
        ?>
        <dialog>
            <p>Dados do produto atualizados com sucesso!</p>
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
            window.location.href = '../../index.php?classe=Produto&metodo=index';
        });
    </script>
</body>

</html>
