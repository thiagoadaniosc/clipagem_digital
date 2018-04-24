CREATE DATABASE clipagem_digital;

use clipagem_digital;
ALTER DATABASE `clipagem_digital` CHARSET = UTF8 COLLATE = utf8_general_ci;


CREATE TABLE clipagens (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    titulo varchar(255),
    veiculo varchar(255),
    editoria varchar(255),
    autor varchar(255),
    data varchar(255),
    pagina INT,
    tipo varchar(255),
    tags varchar(255)
);

CREATE TABLE arquivos (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    id_clipagem INT NOT NULL,
    nome varchar(255)    
);

CREATE TABLE usuarios (
	ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    display_name varchar(255),
    username varchar(255),
    password varchar(255),
    role INT
    
);