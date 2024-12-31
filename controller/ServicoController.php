<?php

include_once __DIR__ . '/../model/Servico.php';
include_once __DIR__ . '/../model/DAO/ServicoDAO.php';

session_start();

class ServicoController
{
    private Servico $servico;
    private ServicoDAO $servicoDAO;

    public function __construct()
    {
        $this->servico = new Servico();
        $this->servicoDAO = new ServicoDAO();
    }

    public function index()
    {
        $servicos = $this->servicoDAO->listarTudo();
        $_SESSION['servicos'] = $servicos;

        header("Location: ../view/servico/mostrar_tudo.php");
    }

    public function create()
    {
        header("Location: ../view/servico/novo.php");
    }

    public function show(int $id)
    {
        $servico = $this->servicoDAO->buscar($id);
        $_SESSION['servico'] = $servico;

        header("Location: ../view/servico/mostrar_registro.php?id=$id");
    }

    public function edit(int $id)
    {
        $servico = $this->servicoDAO->buscar($id);
        $_SESSION['servico'] = $servico;

        header("Location: ../view/servico/editar.php?id=$id");
    }

    public function store()
    {
        $nome = $_POST['nome'] ?? null;
        $valor = $_POST['valor'] ?? null;
        $descricao = $_POST['descricao'] ?? null;

        if (!$nome || !$valor) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->servico->setNome($nome);
        $this->servico->setValor($valor);
        $this->servico->setDescricao($descricao);

        $resp = $this->servicoDAO->inserir($this->servico);

        if (!$resp) {
            echo 'Erro ao inserir serviço!';
            return;
        }

        echo 'Serviço inserido com sucesso!';
    }

    public function update(int $id)
    {
        $nome = $_POST['nome'] ?? null;
        $valor = $_POST['valor'] ?? null;
        $descricao = $_POST['descricao'] ?? null;

        if (!$nome || !$valor) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->servico->setId($id);
        $this->servico->setNome($nome);
        $this->servico->setValor($valor);
        $this->servico->setDescricao($descricao);

        $resp = $this->servicoDAO->alterar($this->servico);

        if (!$resp) {
            echo 'Erro ao atualizar serviço!';
            return;
        }

        echo 'Serviço atualizado com sucesso!';
    }

    public function delete(int $id)
    {
        $resp = $this->servicoDAO->excluir($id);

        if (!$resp) {
            echo 'Erro ao deletar serviço!';
            return;
        }

        echo 'Serviço deletado com sucesso!';
    }
}
