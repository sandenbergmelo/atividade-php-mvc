<?php

function formatarData(string $data): string
{
    $data = new DateTime($data);
    return $data->format('d/m/Y');
}

function formatarCpf(string $cpf): string
{
    return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
}

function formatarTelefone(string $telefone): string
{
    return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 1) . ' ' . substr($telefone, 3, 4) . '-' . substr($telefone, 7);
}

function formatarDinheiro(float $valor): string
{
    return 'R$ ' . number_format($valor, 2, ',', '.');
}
