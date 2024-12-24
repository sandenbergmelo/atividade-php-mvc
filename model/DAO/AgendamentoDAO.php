<?php

include_once __DIR__ . '/../../db/Connection.php';
include_once __DIR__ . '/../Agendamento.php';

class AgendamentoDAO
{
    private PDO $connection;

    public function __construct()
    {
        $this->connection = Connection::getConnection();
    }

    public function inserir(Agendamento $agendamento): bool
    {
        $sql = "INSERT INTO agendamentos (cliente_id, servico_id, data, horario, duracao, status)
                VALUES (:cliente_id, :servico_id, :data, :horario, :duracao, :status)";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':cliente_id', $agendamento->getClienteId());
        $stmt->bindParam(':servico_id', $agendamento->getServicoId());
        $stmt->bindParam(':data', $agendamento->getData());
        $stmt->bindParam(':horario', $agendamento->getHorario());
        $stmt->bindParam(':duracao', $agendamento->getDuracao());
        $stmt->bindParam(':status', $agendamento->getStatus());

        return $stmt->execute();
    }

    public function alterar(Agendamento $agendamento): bool
    {
        $sql = "UPDATE agendamentos SET cliente_id = :cliente_id, servico_id = :servico_id, data = :data,
                horario = :horario, duracao = :duracao, status = :status WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $agendamento->getId());
        $stmt->bindParam(':cliente_id', $agendamento->getClienteId());
        $stmt->bindParam(':servico_id', $agendamento->getServicoId());
        $stmt->bindParam(':data', $agendamento->getData());
        $stmt->bindParam(':horario', $agendamento->getHorario());
        $stmt->bindParam(':duracao', $agendamento->getDuracao());
        $stmt->bindParam(':status', $agendamento->getStatus());

        return $stmt->execute();
    }

    public function excluir(int $id): bool
    {
        $sql = "DELETE FROM agendamentos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function buscar(int $id): ?Agendamento
    {
        $sql = "SELECT * FROM agendamentos WHERE id = :id";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $agendamentoData = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($agendamentoData) {
            $agendamento = new Agendamento();
            $agendamento->setId($agendamentoData['id']);
            $agendamento->setClienteId($agendamentoData['cliente_id']);
            $agendamento->setServicoId($agendamentoData['servico_id']);
            $agendamento->setData($agendamentoData['data']);
            $agendamento->setHorario($agendamentoData['horario']);
            $agendamento->setDuracao($agendamentoData['duracao']);
            $agendamento->setStatus($agendamentoData['status']);

            return $agendamento;
        }

        return null;
    }

    /**
     * Retorna um array de Agendamentos
     *
     * @return Agendamento[]
     */
    public function listarTudo(): array
    {
        $sql = "SELECT * FROM agendamentos";

        $stmt = $this->connection->query($sql);
        $stmt->execute();

        $agendamentosData = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $agendamentos = [];

        foreach ($agendamentosData as $agendamentoData) {
            $agendamento = new Agendamento();
            $agendamento->setId($agendamentoData['id']);
            $agendamento->setClienteId($agendamentoData['cliente_id']);
            $agendamento->setServicoId($agendamentoData['servico_id']);
            $agendamento->setData($agendamentoData['data']);
            $agendamento->setHorario($agendamentoData['horario']);
            $agendamento->setDuracao($agendamentoData['duracao']);
            $agendamento->setStatus($agendamentoData['status']);

            $agendamentos[] = $agendamento;
        }

        return $agendamentos;
    }
}
