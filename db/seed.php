<?php

include __DIR__ . '/Connection.php';

$clientes = [
    ['nome' => 'Leonardo da Vinci', 'cpf' => '123.456.789-00', 'dt_nasc' => '1452-04-15', 'whatsapp' => '1234567890', 'logradouro' => 'Rua A', 'num' => '1', 'bairro' => 'Centro'],
    ['nome' => 'Michelangelo Buonarroti', 'cpf' => '123.456.789-01', 'dt_nasc' => '1475-03-06', 'whatsapp' => '1234567891', 'logradouro' => 'Rua B', 'num' => '2', 'bairro' => 'Centro'],
    ['nome' => 'Rafael Sanzio', 'cpf' => '123.456.789-02', 'dt_nasc' => '1483-04-06', 'whatsapp' => '1234567892', 'logradouro' => 'Rua C', 'num' => '3', 'bairro' => 'Centro'],
    ['nome' => 'Donatello di Niccolò di Betto Bardi', 'cpf' => '123.456.789-03', 'dt_nasc' => '1386-09-13', 'whatsapp' => '1234567893', 'logradouro' => 'Rua D', 'num' => '4', 'bairro' => 'Centro'],
    ['nome' => 'Sandro Botticelli', 'cpf' => '123.456.789-04', 'dt_nasc' => '1445-03-01', 'whatsapp' => '1234567894', 'logradouro' => 'Rua E', 'num' => '5', 'bairro' => 'Centro']
];

$servicos = [
    ['nome' => 'Corte de Cabelo', 'valor' => 50.00, 'descricao' => 'Corte de cabelo masculino'],
    ['nome' => 'Manicure', 'valor' => 30.00, 'descricao' => 'Serviço de manicure'],
    ['nome' => 'Pedicure', 'valor' => 35.00, 'descricao' => 'Serviço de pedicure'],
    ['nome' => 'Massagem', 'valor' => 100.00, 'descricao' => 'Massagem relaxante'],
    ['nome' => 'Limpeza de Pele', 'valor' => 80.00, 'descricao' => 'Limpeza profunda da pele']
];

$produtos = [
    ['nome' => 'Shampoo', 'valor' => 20.00, 'marca' => 'Marca A', 'categoria' => 'Higiene'],
    ['nome' => 'Condicionador', 'valor' => 25.00, 'marca' => 'Marca B', 'categoria' => 'Higiene'],
    ['nome' => 'Creme Hidratante', 'valor' => 40.00, 'marca' => 'Marca C', 'categoria' => 'Beleza'],
    ['nome' => 'Esmalte', 'valor' => 15.00, 'marca' => 'Marca D', 'categoria' => 'Beleza'],
    ['nome' => 'Protetor Solar', 'valor' => 50.00, 'marca' => 'Marca E', 'categoria' => 'Cuidados com a Pele']
];

$agendamentos = [
    ['cliente_id' => 1, 'servico_id' => 1, 'data' => '2024-12-23', 'horario' => '10:00:00', 'duracao' => 60, 'status' => 'Agendado'],
    ['cliente_id' => 2, 'servico_id' => 2, 'data' => '2024-12-23', 'horario' => '11:00:00', 'duracao' => 30, 'status' => 'Agendado'],
    ['cliente_id' => 3, 'servico_id' => 3, 'data' => '2024-12-23', 'horario' => '12:00:00', 'duracao' => 45, 'status' => 'Agendado'],
    ['cliente_id' => 4, 'servico_id' => 4, 'data' => '2024-12-23', 'horario' => '13:00:00', 'duracao' => 90, 'status' => 'Agendado'],
    ['cliente_id' => 5, 'servico_id' => 5, 'data' => '2024-12-23', 'horario' => '14:00:00', 'duracao' => 60, 'status' => 'Agendado']
];

$compras = [
    ['cliente_id' => 1, 'produto_id' => 1, 'data' => '2024-12-23', 'horario' => '15:00:00', 'qtd' => 2],
    ['cliente_id' => 2, 'produto_id' => 2, 'data' => '2024-12-23', 'horario' => '16:00:00', 'qtd' => 1],
    ['cliente_id' => 3, 'produto_id' => 3, 'data' => '2024-12-23', 'horario' => '17:00:00', 'qtd' => 3],
    ['cliente_id' => 4, 'produto_id' => 4, 'data' => '2024-12-23', 'horario' => '18:00:00', 'qtd' => 1],
    ['cliente_id' => 5, 'produto_id' => 5, 'data' => '2024-12-23', 'horario' => '19:00:00', 'qtd' => 2]
];

try {
    $conn = Connection::getConnection();

    $tables = $conn->query("SHOW TABLES")->fetchAll(PDO::FETCH_COLUMN);

    $conn->exec("SET FOREIGN_KEY_CHECKS = 0");

    foreach ($tables as $table) {
        $conn->exec("DROP TABLE IF EXISTS $table");
    }

    $conn->exec("SET FOREIGN_KEY_CHECKS = 1");

    $conn->exec("CREATE TABLE IF NOT EXISTS clientes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        cpf VARCHAR(14) NOT NULL,
        dt_nasc DATE NOT NULL,
        whatsapp VARCHAR(15),
        logradouro VARCHAR(255),
        num VARCHAR(10),
        bairro VARCHAR(100)
    )");
    echo "Tabela clientes criada com sucesso\n";

    $conn->exec("CREATE TABLE IF NOT EXISTS servicos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        valor DECIMAL(10, 2) NOT NULL,
        descricao TEXT
    )");
    echo "Tabela servicos criada com sucesso\n";

    $conn->exec("CREATE TABLE IF NOT EXISTS produtos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        nome VARCHAR(255) NOT NULL,
        valor DECIMAL(10, 2) NOT NULL,
        marca VARCHAR(100),
        categoria VARCHAR(100)
    )");

    echo "Tabela produtos criada com sucesso\n";

    $conn->exec("CREATE TABLE IF NOT EXISTS agendamentos (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        servico_id INT NOT NULL,
        data DATE NOT NULL,
        horario TIME NOT NULL,
        duracao INT NOT NULL,
        status VARCHAR(50) NOT NULL,

        FOREIGN KEY (cliente_id) REFERENCES clientes(id),
        FOREIGN KEY (servico_id) REFERENCES servicos(id)
    )");
    echo "Tabela agendamentos criada com sucesso\n";

    $conn->exec("CREATE TABLE IF NOT EXISTS compras (
        id INT AUTO_INCREMENT PRIMARY KEY,
        cliente_id INT NOT NULL,
        produto_id INT NOT NULL,
        data DATE NOT NULL,
        horario TIME NOT NULL,
        qtd INT NOT NULL,

        FOREIGN KEY (cliente_id) REFERENCES clientes(id),
        FOREIGN KEY (produto_id) REFERENCES produtos(id)
    )");
    echo "Tabela compras criada com sucesso\n";

    // Inserir dados na tabela clientes
    foreach ($clientes as $cliente) {
        $sql = "INSERT INTO clientes (nome, cpf, dt_nasc, whatsapp, logradouro, num, bairro) VALUES (:nome, :cpf, :dt_nasc, :whatsapp, :logradouro, :num, :bairro)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($cliente);
    }

    // Inserir dados na tabela servicos
    foreach ($servicos as $servico) {
        $sql = "INSERT INTO servicos (nome, valor, descricao) VALUES (:nome, :valor, :descricao)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($servico);
    }

    // Inserir dados na tabela produtos
    foreach ($produtos as $produto) {
        $sql = "INSERT INTO produtos (nome, valor, marca, categoria) VALUES (:nome, :valor, :marca, :categoria)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($produto);
    }

    // Inserir dados na tabela agendamentos
    foreach ($agendamentos as $agendamento) {
        $sql = "INSERT INTO agendamentos (cliente_id, servico_id, data, horario, duracao, status) VALUES (:cliente_id, :servico_id, :data, :horario, :duracao, :status)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($agendamento);
    }

    // Inserir dados na tabela compras
    foreach ($compras as $compra) {
        $sql = "INSERT INTO compras (cliente_id, produto_id, data, horario, qtd) VALUES (:cliente_id, :produto_id, :data, :horario, :qtd)";
        $stmt = $conn->prepare($sql);
        $stmt->execute($compra);
    }

    echo "Dados inseridos com sucesso!\n";
} catch (PDOException $e) {
    echo "Erro ao inserir dados: \n{$e->getMessage()}\n";
}