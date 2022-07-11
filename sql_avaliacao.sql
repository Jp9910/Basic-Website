CREATE DATABASE sindicato_trainees;

USE sindicato_trainees;
SELECT * FROM uso_usuarios;

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

DROP TABLE tse_teste, ts2_teste2

CREATE TABLE uso_usuarios(
	uso_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    uso_nome VARCHAR(55) NOT NULL,
    uso_login VARCHAR(30) UNIQUE NOT NULL,
    uso_senha VARCHAR(60) NOT NULL,
    uso_email VARCHAR(55),
    uso_isAdmin TINYINT NOT NULL DEFAULT 0
);
INSERT INTO 
uso_usuarios(uso_nome,uso_login,uso_senha) 
VALUES 
('userTeste2','teste2',SHA1('senha123'));
# SHA1 possui o mesmo problema do md5. o hash pra mesma string é sempre igual

DELETE FROM uso_usuarios WHERE uso_id = 1;

SELECT * FROM uso_usuarios WHERE uso_id = 2 && uso_nome = "userTeste" && uso_login = "teste" && uso_senha = SHA1("senha123");


INSERT INTO 
uso_usuarios(uso_nome,uso_login,uso_senha) 
VALUES 
('Admininistrador','admin',SHA1('123456'));

SELECT * FROM uso_usuarios WHERE uso_login = "admin" && uso_senha = SHA1("123456");

PREPARE stmt FROM 'SELECT * FROM uso_usuarios WHERE uso_login = ? and uso_senha = SHA1(?)';
SET @a = 'admin';
SET @b = '123456';
EXECUTE stmt USING @a, @b;

DROP TABLE uso_usuarios;
DELETE FROM uso_usuarios;

CREATE TABLE ema_empresa (
	ema_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ema_nome VARCHAR(55)
);

SELECT * FROM ema_empresa;
INSERT INTO ema_empresa (ema_nome) VALUES ("teste");
DELETE FROM ema_empresa;

CREATE TABLE cro_cargo (
	cro_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    cro_nome VARCHAR(55)
);

CREATE TABLE sto_situacao (
	sto_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sto_nome VARCHAR(55)
);

CREATE TABLE flo_filiado (
	flo_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    flo_nome VARCHAR(55) NOT NULL,
    flo_cpf VARCHAR(11) UNIQUE NOT NULL,
    flo_rg VARCHAR(60) UNIQUE NOT NULL,
    flo_data_nascimento DATE,
    flo_idade TINYINT UNSIGNED,
    flo_telefone VARCHAR(11),
    flo_celular VARCHAR(11),
    flo_data_ultima_atualizacao DATETIME,
    ema_id INT NOT NULL,
    cro_id INT NOT NULL,
    sto_id INT NOT NULL,
    FOREIGN KEY (ema_id) REFERENCES ema_empresa(ema_id),
    FOREIGN KEY (cro_id) REFERENCES cro_cargo(cro_id),
    FOREIGN KEY (sto_id) REFERENCES sto_situacao(sto_id)
);

SELECT * FROM flo_filiado;
DROP TABLE flo_filiado;

CREATE TABLE dpe_dependente (
	dpe_id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    dpe_nome VARCHAR(55) NOT NULL,
    dpe_data_nascimento DATE,
    dpe_parentesco VARCHAR(55) NOT NULL,
    flo_id INT NOT NULL,
    FOREIGN KEY (flo_id) REFERENCES flo_filiado(flo_id)
);

SELECT * FROM dpe_dependente;
DROP TABLE dpe_dependente;