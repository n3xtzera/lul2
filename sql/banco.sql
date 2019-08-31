CREATE DATABASE kids;

CREATE TABLE kids(
    id INT(11) PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(60) NOT NULL,
    idade INT NOT NULL,
    sexo VARCHAR(10) NOT NULL,
    parto BOOLEAN NOT NULL,
    etnia VARCHAR(10) NOT NULL,
    nomedamae VARCHAR(60) NOT NULL,
    email VARCHAR(60) NOT NULL,
    telefone INT NOT NULL
);

CREATE TABLE vacina(
    idv INT(11) PRIMARY KEY AUTO_INCREMENT,
    nomev VARCHAR(60) NOT NULL,
    lote VARCHAR(6) NOT NULL,
    dav DATE NOT NULL,
    idcri INT(11),
    FOREIGN KEY (idcri) REFERENCES crianca(id)
);