<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Compra.php';
include_once __DIR__ . '/ClienteDAO.php';
include_once __DIR__ . '/ProdutoDAO.php';


class CompraDAO
{
    private PDO $connection;
    private ClienteDAO $clienteDAO;
    private ProdutoDAO $produtoDAO;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
        $this->clienteDAO = new ClienteDAO();
        $this->produtoDAO = new ProdutoDAO();
    }

    public function inserir(Compra $compra): bool
    {
        $sql = "INSERT INTO compras (cliente_id, produto_id, data, horario, qtd)
                VALUES (:cliente_id, :produto_id, :data, :horario, :qtd)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':cliente_id', $compra->getClienteId());
        $stmt->bindParam(':produto_id', $compra->getProdutoId());
        $stmt->bindParam(':data', $compra->getData());
        $stmt->bindParam(':horario', $compra->getHorario());
        $stmt->bindParam(':qtd', $compra->getQtd());

        return $stmt->execute();
    }

    public function alterar(Compra $compra): bool
    {
        $sql = "UPDATE compras SET cliente_id = :cliente_id, produto_id = :produto_id, data = :data,
                horario = :horario, qtd = :qtd WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $compra->getId());
        $stmt->bindParam(':cliente_id', $compra->getClienteId());
        $stmt->bindParam(':produto_id', $compra->getProdutoId());
        $stmt->bindParam(':data', $compra->getData());
        $stmt->bindParam(':horario', $compra->getHorario());
        $stmt->bindParam(':qtd', $compra->getQtd());

        return $stmt->execute();
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM compras WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function buscar(int $id): ?Compra
    {
        $sql = "SELECT * FROM compras WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $compraData = $stmt->fetch(PDO::FETCH_ASSOC);
        $cliente = $this->clienteDAO->buscar($compraData['cliente_id']);
        $produto = $this->produtoDAO->buscar($compraData['produto_id']);

        if ($compraData && $cliente && $produto) {
            $compra = new Compra();
            $compra->setId($compraData['id']);
            $compra->setClienteId($compraData['cliente_id']);
            $compra->setProdutoId($compraData['produto_id']);
            $compra->setData($compraData['data']);
            $compra->setHorario($compraData['horario']);
            $compra->setQtd($compraData['qtd']);
            $compra->setCliente($cliente);
            $compra->setProduto($produto);

            return $compra;
        }

        return null;
    }

    public function listarTudo(): array
    {
        $sql = "SELECT * FROM compras";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $comprasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $compras = [];

        foreach ($comprasData as $compraData) {
            $cliente = $this->clienteDAO->buscar($compraData['cliente_id']);
            $produto = $this->produtoDAO->buscar($compraData['produto_id']);

            $compra = new Compra();
            $compra->setId($compraData['id']);
            $compra->setClienteId($compraData['cliente_id']);
            $compra->setProdutoId($compraData['produto_id']);
            $compra->setData($compraData['data']);
            $compra->setHorario($compraData['horario']);
            $compra->setQtd($compraData['qtd']);
            $compra->setCliente($cliente);
            $compra->setProduto($produto);

            $compras[] = $compra;
        }

        return $compras;
    }
}
