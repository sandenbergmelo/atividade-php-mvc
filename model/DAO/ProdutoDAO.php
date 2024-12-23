<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Produto.php';

class ProdutoDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert(Produto $produto): string
    {
        $sql = "INSERT INTO produtos (nome, valor, marca, categoria) VALUES (:nome, :valor, :marca, :categoria)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome', $produto->getNome());
        $stmt->bindParam(':valor', $produto->getValor());
        $stmt->bindParam(':marca', $produto->getMarca());
        $stmt->bindParam(':categoria', $produto->getCategoria());
        $stmt->execute();

        return 'ok';
    }

    public function update(Produto $produto): string
    {
        $sql = "UPDATE produtos SET nome = :nome, valor = :valor, marca = :marca, categoria = :categoria WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $produto->getId());
        $stmt->bindParam(':nome', $produto->getNome());
        $stmt->bindParam(':valor', $produto->getValor());
        $stmt->bindParam(':marca', $produto->getMarca());
        $stmt->bindParam(':categoria', $produto->getCategoria());
        $stmt->execute();

        return 'ok';
    }

    public function delete(int $id): string
    {
        $sql = "DELETE FROM produtos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return 'ok';
    }

    public function getById(int $id): ?Produto
    {
        $sql = "SELECT * FROM produtos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $produtoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($produtoData) {
            $produto = new Produto();
            $produto->setId($produtoData['id']);
            $produto->setNome($produtoData['nome']);
            $produto->setValor($produtoData['valor']);
            $produto->setMarca($produtoData['marca']);
            $produto->setCategoria($produtoData['categoria']);

            return $produto;
        }

        return null;
    }

    /**
     * Retorna um array de Produtos
     *
     * @return Produto[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM produtos";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $produtosData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $produtos = [];

        foreach ($produtosData as $produtoData) {
            $produto = new Produto();
            $produto->setId($produtoData['id']);
            $produto->setNome($produtoData['nome']);
            $produto->setValor($produtoData['valor']);
            $produto->setMarca($produtoData['marca']);
            $produto->setCategoria($produtoData['categoria']);

            $produtos[] = $produto;
        }

        return $produtos;
    }
}
