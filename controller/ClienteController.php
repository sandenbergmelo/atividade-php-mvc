<?php

include_once __DIR__ . '/../model/Cliente.php';
include_once __DIR__ . '/../model/DAO/ClienteDAO.php';

session_start();

class ClienteController
{
    private Cliente $cliente;
    private ClienteDAO $clienteDAO;

    public function __construct()
    {
        $this->cliente = new Cliente();
        $this->clienteDAO = new ClienteDAO();
    }

    public function index()
    {
        $clientes = $this->clienteDAO->listarTudo();
        $_SESSION['clientes'] = $clientes;

        header("Location: ../view/cliente/mostrar_tudo.php");
    }

    public function create()
    {
        header("Location: ../view/cliente/novo.php");
    }

    public function show(int $id)
    {
        $cliente = $this->clienteDAO->buscar($id);
        $_SESSION['cliente'] = $cliente;

        header("Location: ../view/cliente/mostrar_registro.php?id=$id");
    }

    public function edit(int $id)
    {
        header("Location: ../view/cliente/editar.php?id=$id");
    }

    public function store()
    {
        $nome = $_POST['nome'] ?? null;
        $cpf = $_POST['cpf'] ?? null;
        $dt_nasc = $_POST['dt_nasc'] ?? null;
        $whatsapp = $_POST['whatsapp'] ?? null;
        $logradouro = $_POST['logradouro'] ?? null;
        $num = $_POST['num'] ?? null;
        $bairro = $_POST['bairro'] ?? null;

        if (!$nome || !$cpf || !$dt_nasc) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->cliente->setNome($nome);
        $this->cliente->setCpf($cpf);
        $this->cliente->setDtNasc($dt_nasc);
        $this->cliente->setWhatsapp($whatsapp);
        $this->cliente->setLogradouro($logradouro);
        $this->cliente->setNum($num);
        $this->cliente->setBairro($bairro);

        $resp = $this->clienteDAO->inserir($this->cliente);

        if (!$resp) {
            echo 'Erro ao inserir cliente!';
            return;
        }

        echo 'Cliente inserido com sucesso!';
    }

    public function update(int $id)
    {
        $nome = $_POST['nome'] ?? null;
        $cpf = $_POST['cpf'] ?? null;
        $dt_nasc = $_POST['dt_nasc'] ?? null;
        $whatsapp = $_POST['whatsapp'] ?? null;
        $logradouro = $_POST['logradouro'] ?? null;
        $num = $_POST['num'] ?? null;
        $bairro = $_POST['bairro'] ?? null;

        if (!$nome || !$cpf || !$dt_nasc) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->cliente->setId($id);
        $this->cliente->setNome($nome);
        $this->cliente->setCpf($cpf);
        $this->cliente->setDtNasc($dt_nasc);
        $this->cliente->setWhatsapp($whatsapp);
        $this->cliente->setLogradouro($logradouro);
        $this->cliente->setNum($num);
        $this->cliente->setBairro($bairro);

        $resp = $this->clienteDAO->alterar($this->cliente);

        if (!$resp) {
            echo 'Erro ao atualizar cliente!';
            return;
        }

        echo 'Cliente atualizado com sucesso!';
    }

    public function delete(int $id)
    {
        $resp = $this->clienteDAO->excluir($id);

        if (!$resp) {
            echo 'Erro ao deletar cliente!';
            return;
        }

        echo 'Cliente deletado com sucesso!';
    }
}
