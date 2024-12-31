<?php

include_once __DIR__ . '/Cliente.php';
include_once __DIR__ . '/Servico.php';

class Agendamento
{
    private int $id;
    private int $cliente_id;
    private int $servico_id;
    private string $data;
    private string $horario;
    private int $duracao;
    private string $status;
    private Cliente $cliente;
    private Servico $servico;

    public function __construct() {}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getClienteId(): int
    {
        return $this->cliente_id;
    }

    public function setClienteId(int $cliente_id): self
    {
        $this->cliente_id = $cliente_id;
        return $this;
    }

    public function getServicoId(): int
    {
        return $this->servico_id;
    }

    public function setServicoId(int $servico_id): self
    {
        $this->servico_id = $servico_id;
        return $this;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;
        return $this;
    }

    public function getHorario(): string
    {
        return $this->horario;
    }

    public function setHorario(string $horario): self
    {
        $this->horario = $horario;
        return $this;
    }

    public function getDuracao(): int
    {
        return $this->duracao;
    }

    public function setDuracao(int $duracao): self
    {
        $this->duracao = $duracao;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getCliente(): Cliente
    {
        return $this->cliente;
    }

    public function setCliente(Cliente $cliente): self
    {
        $this->cliente = $cliente;

        return $this;
    }

    public function getServico(): Servico
    {
        return $this->servico;
    }

    public function setServico(Servico $servico): self
    {
        $this->servico = $servico;

        return $this;
    }
}
