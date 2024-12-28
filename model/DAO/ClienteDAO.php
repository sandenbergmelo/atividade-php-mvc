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

    public function inserir(Cliente $client): bool
    {
        $sql = "INSERT INTO clientes (nome, cpf, dt_nasc, whatsapp, logradouro, num, bairro)
                VALUES (:nome, :cpf, :dt_nasc, :whatsapp, :logradouro, :num, :bairro)";

        $stmt = $this->connection->prepare($sql);

        $nome = $client->getNome();
        $cpf = $client->getCpf();
        $dtNasc = $client->getDtNasc();
        $whatsapp = $client->getWhatsapp();
        $logradouro = $client->getLogradouro();
        $num = $client->getNum();
        $bairro = $client->getBairro();

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':dt_nasc', $dtNasc);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':bairro', $bairro);

        return $stmt->execute();
    }

    public function alterar(Cliente $client): bool
    {
        $sql = "UPDATE clientes SET nome = :nome, cpf = :cpf, dt_nasc = :dt_nasc, whatsapp = :whatsapp,
                logradouro = :logradouro, num = :num, bairro = :bairro WHERE id = :id";

        $stmt = $this->connection->prepare($sql);

        $id = $client->getId();
        $nome = $client->getNome();
        $cpf = $client->getCpf();
        $dtNasc = $client->getDtNasc();
        $whatsapp = $client->getWhatsapp();
        $logradouro = $client->getLogradouro();
        $num = $client->getNum();
        $bairro = $client->getBairro();

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':dt_nasc', $dtNasc);
        $stmt->bindParam(':whatsapp', $whatsapp);
        $stmt->bindParam(':logradouro', $logradouro);
        $stmt->bindParam(':num', $num);
        $stmt->bindParam(':bairro', $bairro);

        return $stmt->execute();
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM clientes WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function buscar(int $id): ?Cliente
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
    public function listarTudo(): array
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
