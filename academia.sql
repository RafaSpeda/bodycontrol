-- Criação do banco de dados
CREATE DATABASE IF NOT EXISTS academia;

-- Seleção do banco de dados
USE academia;

-- Tabela de proprietários (com senha criptografada)
CREATE TABLE IF NOT EXISTS proprietarios (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	email VARCHAR(100) NOT NULL UNIQUE,
	senha VARCHAR(255) NOT NULL
);

-- Tabela de clientes
CREATE TABLE IF NOT EXISTS clientes (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nome VARCHAR(100) NOT NULL,
	cpf VARCHAR(14) NOT NULL UNIQUE,
	data_nascimento DATE NOT NULL,
	celular VARCHAR(15),
	email VARCHAR(100) NOT NULL UNIQUE,
	situacao_financeira ENUM('pago', 'Não Pago') NOT NULL
);


INSERT INTO academia.proprietarios (nome, email, senha)
VALUES ('suaacademia', 'suaacademia@bodycontrol.com', '$2y$10$5KYkDEyd3Qs.ATb8aLar4.dUaleWYEaeen73f9/hL80yQWcYxfhzK');
