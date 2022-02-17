CREATE DATABASE IF NOT EXISTS hpanel;
use hpanel;

CREATE TABLE IF NOT EXISTS hp_users(
  id bigint not null auto_increment,
  nome varchar(30) not null,
  senha varchar(16) not null,
  cargo int not null,
  primary key(id)
);

CREATE TABLE IF NOT EXISTS hp_cargos(
  id int not null auto_increment,
  nome varchar(30) not null,
  primary key(id)
);

ALTER TABLE hp_users ADD CONSTRAINT fk_cargo FOREIGN KEY(cargo) REFERENCES hp_cargos(id);

INSERT INTO hp_cargos VALUES (null, 'DIRETOR');
INSERT INTO hp_cargos VALUES (null, 'COORDENADOR');
INSERT INTO hp_cargos VALUES (null, 'WEB MASTER');
INSERT INTO hp_cargos VALUES (null, 'ADMIN. DE CONTEÚDO');
INSERT INTO hp_cargos VALUES (null, 'ADMIN. DE PROMOTORIA');
INSERT INTO hp_cargos VALUES (null, 'ADMIN. RÁDIO');
INSERT INTO hp_cargos VALUES (null, 'SUPERVISOR');
INSERT INTO hp_cargos VALUES (null, 'SUPERVISOR DE PROMOTORIA');
INSERT INTO hp_cargos VALUES (null, 'JORNALISTA');
INSERT INTO hp_cargos VALUES (null, 'PROMOTOR');
INSERT INTO hp_cargos VALUES (null, 'LOCUTOR');
INSERT INTO hp_cargos VALUES (null, 'SONOPLASTA');