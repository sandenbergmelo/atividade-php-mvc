<?php

class Compra
{
    private int $id;
    private int $cliente_id;
    private int $produto_id;
    private string $data;
    private string $horario;
    private int $qtd;

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

    public function getProdutoId(): int
    {
        return $this->produto_id;
    }

    public function setProdutoId(int $produto_id): self
    {
        $this->produto_id = $produto_id;
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

    public function getQtd(): int
    {
        return $this->qtd;
    }

    public function setQtd(int $qtd): self
    {
        $this->qtd = $qtd;
        return $this;
    }
}
