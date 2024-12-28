<?php

include_once __DIR__ . '/../../model/Cliente.php';
include_once __DIR__ . '/../../utils/formatacoes.php';

session_start();

/** @var Cliente[] $clientes */
$clientes = $_SESSION['clientes'];

?>

<!DOCTYPE html>
<html lang=”pt-br”>

<head>
    <meta charset=”utf8”>
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="css/mostrar_tudo.css">
</head>

<body>
    <main>
        <h1>Lista de Clientes</h1>
        <button onclick="window.location.href='../../index.php?classe=Cliente&metodo=create'">Inserir Cliente</button>
        <table style="margin: auto;">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>CPF</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($clientes as $cliente) {
                    $id = $cliente->getId();
                    $nome = $cliente->getNome();
                    $cpf = formatarCpf($cliente->getCpf());
                    $dtNasc = formatarData($cliente->getDtNasc());

                    echo "<tr>";
                    echo "<td> $id </td>";
                    echo "<td> <a href='../../index.php?classe=Cliente&metodo=show&id=$id'> $nome </a> </td>";
                    echo "<td> $cpf </td>";
                    echo "<td> $dtNasc </td>";
                    echo "<td>";
                    echo "<a class='editar' href='../../index.php?classe=Cliente&metodo=edit&id=$id'>[Editar]</a> ";
                    echo "<a class='excluir' href='../../index.php?classe=Cliente&metodo=delete&id=$id'>[Excluir]</a>";
                    echo "</td>";
                }
                ?>
            </tbody>
        </table>
    </main>

</body>

</html>
