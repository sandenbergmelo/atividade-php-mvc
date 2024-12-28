<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">
</head>

<body>
    <h1>Bem-vindo ao Sistema de Gerenciamento</h1>
    <nav>
        <ul>
            <li>Clientes
                <ul>
                    <li><a href="../../index.php?classe=Cliente&action=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Cliente&action=create">Novo Cliente</a></li>
                </ul>
            </li>
            <li>Serviços
                <ul>
                    <li><a href="../../index.php?classe=Servico&action=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Servico&action=create">Novo Serviço</a></li>
                </ul>
            </li>
            <li>Produtos
                <ul>
                    <li><a href="../../index.php?classe=Produto&action=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Produto&action=create">Novo Produto</a></li>
                </ul>
            </li>
            <li>Agendamentos
                <ul>
                    <li><a href="../../index.php?classe=Agendamento&action=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Agendamento&action=create">Novo Agendamento</a></li>
                </ul>
            </li>
            <li>Compras
                <ul>
                    <li><a href="../../index.php?classe=Cliente&metodo=index">Listar Todas</a></li>
                    <li><a href="../../index.php?classe=Compra&action=create">Nova Compra</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</body>

</html>
