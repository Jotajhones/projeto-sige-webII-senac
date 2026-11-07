CREATE DATABASE IF NOT EXISTS sige_db DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE sige_db;

CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT,
    data_evento DATE NOT NULL,
    local VARCHAR(150) NOT NULL
);

CREATE TABLE participantes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    telefone VARCHAR(20)
);

CREATE TABLE inscricoes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    participante_id INT NOT NULL,
    evento_id INT NOT NULL,
    data_inscricao DATETIME DEFAULT CURRENT_TIMESTAMP,
    status ENUM('Confirmada', 'Cancelada') DEFAULT 'Confirmada',
    FOREIGN KEY (participante_id) REFERENCES participantes(id) ON DELETE CASCADE,
    FOREIGN KEY (evento_id) REFERENCES eventos(id) ON DELETE CASCADE
);