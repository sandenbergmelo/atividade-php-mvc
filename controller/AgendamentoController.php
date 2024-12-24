<?php

include_once __DIR__ . '/../model/Agendamento.php';
include_once __DIR__ . '/../model/DAO/AgendamentoDAO.php';

session_start();

class AgendamentoController
{
    private Agendamento $agendamento;
    private AgendamentoDAO $agendamentoDAO;

    public function __construct()
    {
        $this->agendamento = new Agendamento();
        $this->agendamentoDAO = new AgendamentoDAO();
    }

    public function index()
    {
        $agendamentos = $this->agendamentoDAO->getAll();
        $_SESSION['agendamentos'] = $agendamentos;

        header("Location: ../view/agendamento/mostrar_tudo.php");
    }

    public function create()
    {
        header("Location: ../view/agendamento/novo.php");
    }

    public function show(int $id)
    {
        $agendamento = $this->agendamentoDAO->getById($id);
        $_SESSION['agendamento'] = $agendamento;

        header("Location: ../view/agendamento/mostrar_registro.php?id=$id");
    }

    public function edit(int $id)
    {
        header("Location: ../view/agendamento/editar.php?id=$id");
    }

    public function store()
    {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $servico_id = $_POST['servico_id'] ?? null;
        $data = $_POST['data'] ?? null;
        $horario = $_POST['horario'] ?? null;
        $duracao = $_POST['duracao'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$cliente_id || !$servico_id || !$data || !$horario || !$duracao || !$status) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->agendamento->setClienteId($cliente_id);
        $this->agendamento->setServicoId($servico_id);
        $this->agendamento->setData($data);
        $this->agendamento->setHorario($horario);
        $this->agendamento->setDuracao($duracao);
        $this->agendamento->setStatus($status);

        $resp = $this->agendamentoDAO->insert($this->agendamento);

        if ($resp !== 'ok') {
            echo 'Erro ao inserir agendamento!';
            return;
        }

        echo 'Agendamento inserido com sucesso!';
    }

    public function update(int $id)
    {
        $cliente_id = $_POST['cliente_id'] ?? null;
        $servico_id = $_POST['servico_id'] ?? null;
        $data = $_POST['data'] ?? null;
        $horario = $_POST['horario'] ?? null;
        $duracao = $_POST['duracao'] ?? null;
        $status = $_POST['status'] ?? null;

        if (!$cliente_id || !$servico_id || !$data || !$horario || !$duracao || !$status) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->agendamento->setId($id);
        $this->agendamento->setClienteId($cliente_id);
        $this->agendamento->setServicoId($servico_id);
        $this->agendamento->setData($data);
        $this->agendamento->setHorario($horario);
        $this->agendamento->setDuracao($duracao);
        $this->agendamento->setStatus($status);

        $resp = $this->agendamentoDAO->update($this->agendamento);

        if ($resp !== 'ok') {
            echo 'Erro ao atualizar agendamento!';
            return;
        }

        echo 'Agendamento atualizado com sucesso!';
    }

    public function delete(int $id)
    {
        $resp = $this->agendamentoDAO->delete($id);

        if ($resp !== 'ok') {
            echo 'Erro ao deletar agendamento!';
            return;
        }

        echo 'Agendamento deletado com sucesso!';
    }
}