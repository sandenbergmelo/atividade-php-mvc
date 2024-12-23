<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Servico.php';

class ServicoDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert(Servico $servico): string
    {
        $sql = "INSERT INTO servicos (nome, valor, descricao) VALUES (:nome, :valor, :descricao)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome', $servico->getNome());
        $stmt->bindParam(':valor', $servico->getValor());
        $stmt->bindParam(':descricao', $servico->getDescricao());
        $stmt->execute();

        return 'ok';
    }

    public function update(Servico $servico): string
    {
        $sql = "UPDATE servicos SET nome = :nome, valor = :valor, descricao = :descricao WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $servico->getId());
        $stmt->bindParam(':nome', $servico->getNome());
        $stmt->bindParam(':valor', $servico->getValor());
        $stmt->bindParam(':descricao', $servico->getDescricao());
        $stmt->execute();

        return 'ok';
    }

    public function delete(int $id): string
    {
        $sql = "DELETE FROM servicos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return 'ok';
    }

    public function getById(int $id): ?Servico
    {
        $sql = "SELECT * FROM servicos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $servicoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($servicoData) {
            $servico = new Servico();
            $servico->setId($servicoData['id']);
            $servico->setNome($servicoData['nome']);
            $servico->setValor($servicoData['valor']);
            $servico->setDescricao($servicoData['descricao']);

            return $servico;
        }

        return null;
    }

    /**
     * Retorna um array de Servicos
     *
     * @return Servico[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM servicos";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $servicosData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $servicos = [];

        foreach ($servicosData as $servicoData) {
            $servico = new Servico();
            $servico->setId($servicoData['id']);
            $servico->setNome($servicoData['nome']);
            $servico->setValor($servicoData['valor']);
            $servico->setDescricao($servicoData['descricao']);

            $servicos[] = $servico;
        }

        return $servicos;
    }
}
