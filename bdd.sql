-- Cria o banco de dados
CREATE DATABASE IF NOT EXISTS cinemaDB;
USE cinemaDB;

CREATE TABLE filmes (
    id_filme INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(100) NOT NULL,
    genero VARCHAR(50),
    duracao INT, -- duração em minutos
    classificacao VARCHAR(10),
    sinopse TEXT
);

CREATE TABLE salas (
    id_sala INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(50),
    capacidade INT
);

CREATE TABLE sessoes (
    id_sessao INT AUTO_INCREMENT PRIMARY KEY,
    id_filme INT,
    id_sala INT,
    data DATE,
    horario TIME,
    preco DECIMAL(6,2),
    FOREIGN KEY (id_filme) REFERENCES filmes(id_filme),
    FOREIGN KEY (id_sala) REFERENCES salas(id_sala)
);

CREATE TABLE clientes (
    id_cliente INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    email VARCHAR(100),
    telefone VARCHAR(20)
);

CREATE TABLE ingressos (
    id_ingresso INT AUTO_INCREMENT PRIMARY KEY,
    id_sessao INT,
    id_cliente INT,
    quantidade INT,
    data_compra DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sessao) REFERENCES sessoes(id_sessao),
    FOREIGN KEY (id_cliente) REFERENCES clientes(id_cliente)
);

CREATE TABLE funcionarios (
    id_funcionario INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    cargo VARCHAR(50),
    salario DECIMAL(8,2)
);