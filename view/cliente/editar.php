<?php
include_once __DIR__ . '/../../model/Cliente.php';

session_start();

/** @var Cliente $cliente */
$cliente = $_SESSION['cliente'];

$id = $cliente->getId();
$nome = htmlspecialchars($cliente->getNome());
$cpf = htmlspecialchars($cliente->getCpf());
$dtNasc = htmlspecialchars($cliente->getDtNasc());
$whatsapp = htmlspecialchars($cliente->getWhatsapp());
$logradouro = htmlspecialchars($cliente->getLogradouro());
$num = htmlspecialchars($cliente->getNum());
$bairro = htmlspecialchars($cliente->getBairro());

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar informações do Cliente</title>
    <link rel="stylesheet" href="../css/novo-editar.css">
</head>

<body>
    <main>
        <?php
        echo "<form action='../../index.php?classe=Cliente&metodo=update&id=$id' method='post'>";
        echo "<h1>Editar informações do cliente</h1>";
        echo "<label for='nome'>Nome:</label>";
        echo "<input type='text' name='nome' id='nome' value='$nome' required>";
        echo "<label for='cpf'>CPF:</label>";
        echo "<input type='text' name='cpf' id='cpf' pattern='\d*' minlength='11' maxlength='11' value='$cpf' required>";
        echo "<label for='dtNasc'>Data de Nascimento:</label>";
        echo "<input type='date' name='dtNasc' id='dtNasc' value='$dtNasc' required>";
        echo "<label for='whatsapp'>Whatsapp:</label>";
        echo "<input type='text' name='whatsapp' id='whatsapp' pattern='\d*' minlength='11' maxlength='11' value='$whatsapp' required>";
        echo "<label for='logradouro'>Logradouro:</label>";
        echo "<input type='text' name='logradouro' id='logradouro' value='$logradouro' required>";
        echo "<label for='num'>Número:</label>";
        echo "<input type='text' name='num' id='num' pattern='\d*' value='$num' required>";
        echo "<label for='bairro'>Bairro:</label>";
        echo "<input type='text' name='bairro' id='bairro' value='$bairro' required>";
        echo "<button type='submit'>Salvar</button>";
        echo "</form>";
        ?>
        <dialog>
            <p>Dados do cliente atualizados com sucesso!</p>
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
            window.location.href = '../../index.php?classe=Cliente&metodo=index';
        });
    </script>
</body>

</html>
