<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Compra.php';

class CompraDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert(Compra $compra): string
    {
        $sql = "INSERT INTO compras (cliente_id, produto_id, data, horario, qtd)
                VALUES (:cliente_id, :produto_id, :data, :horario, :qtd)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':cliente_id', $compra->getClienteId());
        $stmt->bindParam(':produto_id', $compra->getProdutoId());
        $stmt->bindParam(':data', $compra->getData());
        $stmt->bindParam(':horario', $compra->getHorario());
        $stmt->bindParam(':qtd', $compra->getQtd());
        $stmt->execute();

        return 'ok';
    }

    public function update(Compra $compra): string
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
        $stmt->execute();

        return 'ok';
    }

    public function delete(int $id): string
    {
        $sql = "DELETE FROM compras WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return 'ok';
    }

    public function getById(int $id): ?Compra
    {
        $sql = "SELECT * FROM compras WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $compraData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($compraData) {
            $compra = new Compra();
            $compra->setId($compraData['id']);
            $compra->setClienteId($compraData['cliente_id']);
            $compra->setProdutoId($compraData['produto_id']);
            $compra->setData($compraData['data']);
            $compra->setHorario($compraData['horario']);
            $compra->setQtd($compraData['qtd']);

            return $compra;
        }

        return null;
    }

    public function getAll(): array
    {
        $sql = "SELECT * FROM compras";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        $comprasData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $compras = [];

        foreach ($comprasData as $compraData) {
            $compra = new Compra();
            $compra->setId($compraData['id']);
            $compra->setClienteId($compraData['cliente_id']);
            $compra->setProdutoId($compraData['produto_id']);
            $compra->setData($compraData['data']);
            $compra->setHorario($compraData['horario']);
            $compra->setQtd($compraData['qtd']);

            $compras[] = $compra;
        }

        return $compras;
    }
}
