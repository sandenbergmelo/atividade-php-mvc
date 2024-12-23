<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Cliente.php';

class ClienteDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function insert(Cliente $client): string
    {
        $sql = "INSERT INTO clientes (nome, cpf, dt_nasc, whatsapp, logradouro, num, bairro)
                VALUES (:nome, :cpf, :dt_nasc, :whatsapp, :logradouro, :num, :bairro)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':nome', $client->getNome());
        $stmt->bindParam(':cpf', $client->getCpf());
        $stmt->bindParam(':dt_nasc', $client->getDtNasc());
        $stmt->bindParam(':whatsapp', $client->getWhatsapp());
        $stmt->bindParam(':logradouro', $client->getLogradouro());
        $stmt->bindParam(':num', $client->getNum());
        $stmt->bindParam(':bairro', $client->getBairro());
        $stmt->execute();

        return 'ok';
    }

    public function update(Cliente $client): string
    {
        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, dt_nasc = :dt_nasc, whatsapp = :whatsapp,
                logradouro = :logradouro, num = :num, bairro = :bairro WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $client->getId());
        $stmt->bindParam(':nome', $client->getNome());
        $stmt->bindParam(':cpf', $client->getCpf());
        $stmt->bindParam(':dt_nasc', $client->getDtNasc());
        $stmt->bindParam(':whatsapp', $client->getWhatsapp());
        $stmt->bindParam(':logradouro', $client->getLogradouro());
        $stmt->bindParam(':num', $client->getNum());
        $stmt->bindParam(':bairro', $client->getBairro());
        $stmt->execute();

        return 'ok';
    }

    public function delete(int $id): string
    {
        $sql = "DELETE FROM clientes WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return 'ok';
    }

    public function getById(int $id): ?Cliente
    {
        $sql = "SELECT * FROM clientes WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $clientData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($clientData) {
            $client = new Cliente();
            $client->setId($clientData['id']);
            $client->setNome($clientData['nome']);
            $client->setCpf($clientData['cpf']);
            $client->setDtNasc($clientData['dt_nasc']);
            $client->setWhatsapp($clientData['whatsapp']);
            $client->setLogradouro($clientData['logradouro']);
            $client->setNum($clientData['num']);
            $client->setBairro($clientData['bairro']);

            return $client;
        }

        return null;
    }

    /**
     * Retorna um array de Clientes
     *
     * @return Cliente[]
     */
    public function getAll(): array
    {
        $sql = "SELECT * FROM clientes";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $clientsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $clients = [];

        foreach ($clientsData as $clientData) {
            $client = new Cliente();
            $client->setId($clientData['id']);
            $client->setNome($clientData['nome']);
            $client->setCpf($clientData['cpf']);
            $client->setDtNasc($clientData['dt_nasc']);
            $client->setWhatsapp($clientData['whatsapp']);
            $client->setLogradouro($clientData['logradouro']);
            $client->setNum($clientData['num']);
            $client->setBairro($clientData['bairro']);

            $clients[] = $client;
        }

        return $clients;
    }
}
