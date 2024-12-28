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
                    <li><a href="../../index.php?classe=Cliente&metodo=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Cliente&metodo=create">Novo Cliente</a></li>
                </ul>
            </li>
            <li>Serviços
                <ul>
                    <li><a href="../../index.php?classe=Servico&metodo=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Servico&metodo=create">Novo Serviço</a></li>
                </ul>
            </li>
            <li>Produtos
                <ul>
                    <li><a href="../../index.php?classe=Produto&metodo=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Produto&metodo=create">Novo Produto</a></li>
                </ul>
            </li>
            <li>Agendamentos
                <ul>
                    <li><a href="../../index.php?classe=Agendamento&metodo=index">Listar Todos</a></li>
                    <li><a href="../../index.php?classe=Agendamento&metodo=create">Novo Agendamento</a></li>
                </ul>
            </li>
            <li>Compras
                <ul>
                    <li><a href="../../index.php?classe=Compra&metodo=index">Listar Todas</a></li>
                    <li><a href="../../index.php?classe=Compra&metodo=create">Nova Compra</a></li>
                </ul>
            </li>
        </ul>
    </nav>
</body>

</html>
