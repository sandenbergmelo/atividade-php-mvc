<?php

include_once __DIR__ . '/../model/Compra.php';
include_once __DIR__ . '/../model/DAO/CompraDAO.php';

session_start();

class CompraController
{
    private Compra $compra;
    private CompraDAO $compraDAO;

    public function __construct()
    {
        $this->compra = new Compra();
        $this->compraDAO = new CompraDAO();
    }

    public function index()
    {
        $compras = $this->compraDAO->getAll();
        $_SESSION['compras'] = $compras;

        header("Location: ../view/compra/mostrar_tudo.php");
    }

    public function create()
    {
        header("Location: ../view/compra/novo.php");
    }

    public function show(int $id)
    {
        $compra = $this->compraDAO->getById($id);
        $_SESSION['compra'] = $compra;

        header("Location: ../view/compra/mostrar_registro.php?id=$id");
    }

    public function edit(int $id)
    {
        header("Location: ../view/compra/editar.php?id=$id");
    }

    public function store()
    {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $produto_id = $_POST['produto_id'] ?? null;
        $data = $_POST['data'] ?? null;
        $horario = $_POST['horario'] ?? null;
        $qtd = $_POST['qtd'] ?? null;

        if (!$cliente_id || !$produto_id || !$data || !$horario || !$qtd) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->compra->setClienteId($cliente_id);
        $this->compra->setProdutoId($produto_id);
        $this->compra->setData($data);
        $this->compra->setHorario($horario);
        $this->compra->setQtd($qtd);

        $resp = $this->compraDAO->insert($this->compra);

        if ($resp !== 'ok') {
            echo 'Erro ao inserir compra!';
            return;
        }

        echo 'Compra inserida com sucesso!';
    }

    public function update(int $id)
    {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $produto_id = $_POST['produto_id'] ?? null;
        $data = $_POST['data'] ?? null;
        $horario = $_POST['horario'] ?? null;
        $qtd = $_POST['qtd'] ?? null;

        if (!$cliente_id || !$produto_id || !$data || !$horario || !$qtd) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->compra->setId($id);
        $this->compra->setClienteId($cliente_id);
        $this->compra->setProdutoId($produto_id);
        $this->compra->setData($data);
        $this->compra->setHorario($horario);
        $this->compra->setQtd($qtd);

        $resp = $this->compraDAO->update($this->compra);

        if ($resp !== 'ok') {
            echo 'Erro ao atualizar compra!';
            return;
        }

        echo 'Compra atualizada com sucesso!';
    }

    public function delete(int $id)
    {
        $resp = $this->compraDAO->delete($id);

        if ($resp !== 'ok') {
            echo 'Erro ao deletar compra!';
            return;
        }

        echo 'Compra deletada com sucesso!';
    }
}
