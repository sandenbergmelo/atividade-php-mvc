CREATE DATABASE barber2men;
USE barber2men;
CREATE TABLE IF NOT EXISTS clientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    cpf VARCHAR(14) NOT NULL,
    dt_nasc DATE NOT NULL,
    whatsapp VARCHAR(15),
    logradouro VARCHAR(255),
    num VARCHAR(10),
    bairro VARCHAR(100)
);
CREATE TABLE IF NOT EXISTS servicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    descricao TEXT
);
CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255) NOT NULL,
    valor DECIMAL(10, 2) NOT NULL,
    marca VARCHAR(100),
    categoria VARCHAR(100)
);
CREATE TABLE IF NOT EXISTS agendamentos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    servico_id INT NOT NULL,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    duracao INT NOT NULL,
    status VARCHAR(50) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (servico_id) REFERENCES servicos(id)
);
CREATE TABLE IF NOT EXISTS compras (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT NOT NULL,
    produto_id INT NOT NULL,
    data DATE NOT NULL,
    horario TIME NOT NULL,
    qtd INT NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES clientes(id),
    FOREIGN KEY (produto_id) REFERENCES produtos(id)
);
