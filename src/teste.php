<?php

namespace Jp\SindicatoTrainees;
use PDO;

$connection = new PDO('mysql:host=db;dbname=sindicato_trainees','root','password');
echo 'Conectado' . PHP_EOL;

$sql = 'SELECT * FROM sindicato_trainees.tse_teste';

$statement = $connection->query($sql);

$resultado = $statement->fetchAll(PDO::FETCH_ASSOC);

var_dump($resultado);

/**
CREATE DATABASE sindicato_trainees;

USE sindicato_trainees;
CREATE TABLE tse_teste (
	tse_id int not null auto_increment primary key,
    tse_nome varchar(55) not null,
    tse_ativo boolean
);

insert into teste (nome, ativo) values ('qualquer nome2', true)

insert into teste (nome, ativo) values ('qualquer nome2', false)

DROP TABLE teste;

CREATE TABLE ts2_teste2 (
	ts2_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ts2_nome VARCHAR(55) not null,
    ts2_ativo BOOLEAN,
    tse_id INT,
    FOREIGN KEY (tse_id) REFERENCES tse_teste(tse_id)
);

insert into tse_teste(tse_nome,tse_ativo) values ('nome2', true)

insert into ts2_teste2(ts2_nome,ts2_ativo,tse_id) values ('nome46', true, 1)
 */