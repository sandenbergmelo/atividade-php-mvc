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
    <link rel="stylesheet" href="css/mostrar_registro.css">
</head>

<body>
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
    echo "<p>Id: $id</p>";
    echo "<p>Nome: $nome</p>";
    echo "<p>CPF: $cpf</p>";
    echo "<p>Data de Nascimento: $dtNasc</p>";
    echo "<p>Whatsapp: $whatsapp</p>";
    echo "<p>Logradouro: $logradouro</p>";
    echo "<p>Número: $numero</p>";
    echo "<p>Bairro: $bairro</p>";
    ?>

    <button onclick="window.location.href='../../index.php?classe=Cliente&metodo=index'">Voltar</button>
</body>

</html>
