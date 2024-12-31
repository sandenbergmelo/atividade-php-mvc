<?php

include_once __DIR__ . '/../model/Produto.php';
include_once __DIR__ . '/../model/DAO/ProdutoDAO.php';

session_start();

class ProdutoController
{
    private Produto $produto;
    private ProdutoDAO $produtoDAO;

    public function __construct()
    {
        $this->produto = new Produto();
        $this->produtoDAO = new ProdutoDAO();
    }

    public function index()
    {
        $produtos = $this->produtoDAO->listarTudo();
        $_SESSION['produtos'] = $produtos;

        header("Location: ../view/produto/mostrar_tudo.php");
    }

    public function create()
    {
        header("Location: ../view/produto/novo.php");
    }

    public function show(int $id)
    {
        $produto = $this->produtoDAO->buscar($id);
        $_SESSION['produto'] = $produto;

        header("Location: ../view/produto/mostrar_registro.php?id=$id");
    }

    public function edit(int $id)
    {
        $produto = $this->produtoDAO->buscar($id);
        $_SESSION['produto'] = $produto;

        header("Location: ../view/produto/editar.php?id=$id");
    }

    public function store()
    {
        $nome = $_POST['nome'] ?? null;
        $valor = $_POST['valor'] ?? null;
        $marca = $_POST['marca'] ?? null;
        $categoria = $_POST['categoria'] ?? null;

        if (!$nome || !$valor) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->produto->setNome($nome);
        $this->produto->setValor($valor);
        $this->produto->setMarca($marca);
        $this->produto->setCategoria($categoria);

        $resp = $this->produtoDAO->inserir($this->produto);

        if (!$resp) {
            echo 'Erro ao inserir produto!';
            return;
        }

        echo 'Produto inserido com sucesso!';
    }

    public function update(int $id)
    {
        $nome = $_POST['nome'] ?? null;
        $valor = $_POST['valor'] ?? null;
        $marca = $_POST['marca'] ?? null;
        $categoria = $_POST['categoria'] ?? null;

        if (!$nome || !$valor) {
            echo 'Preencha todos os campos obrigatórios!';
            return;
        }

        $this->produto->setId($id);
        $this->produto->setNome($nome);
        $this->produto->setValor($valor);
        $this->produto->setMarca($marca);
        $this->produto->setCategoria($categoria);

        $resp = $this->produtoDAO->alterar($this->produto);

        if (!$resp) {
            echo 'Erro ao atualizar produto!';
            return;
        }

        echo 'Produto atualizado com sucesso!';
    }

    public function delete(int $id)
    {
        $resp = $this->produtoDAO->excluir($id);

        if (!$resp) {
            echo 'Erro ao deletar produto!';
            return;
        }

        echo 'Produto deletado com sucesso!';
    }
}
