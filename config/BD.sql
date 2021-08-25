-- BD.sql

DROP SCHEMA IF EXISTS `tarefas_bd`;
CREATE SCHEMA `tarefas_bd`;
USE `tarefas_bd`;

CREATE TABLE tarefa (
	idTarefa INT NOT NULL AUTO_INCREMENT,
	nomeTarefa VARCHAR(50) NOT NULL,
	custoTarefa NUMERIC(10,2) NOT NULL,
	dataLimiteTarefa DATE NOT NULL,
	ordemApresentacaoTarefa INT UNIQUE NOT NULL,
	PRIMARY KEY (idTarefa)
);

INSERT INTO tarefa (nomeTarefa, custoTarefa, dataLimiteTarefa, ordemApresentacaoTarefa) VALUES
					("Lista de Tarefas em PHP", 999.00, "2021-08-23", 2),
					("Atividade Teste de Estágio", 128.00, "2021-08-24", 1),
					("Lista de Tarefas em PHP/Laravel", 1001.00, "2021-08-24", 3),
					("Hospedagem de site", 2048.00, "2021-08-23", 4),
					("Envio de Trabalhos anteriores", 1536.00, "2021-08-24", 5);