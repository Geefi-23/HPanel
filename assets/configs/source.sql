CREATE DATABASE IF NOT EXISTS hpanel;
use hpanel;

CREATE TABLE IF NOT EXISTS hp_users(
  id bigint not null auto_increment,
  nome varchar(30) not null,
  senha varchar(16) not null,
  cargo int not null,
  ultimo_login int null,
  ultimo_ip varchar not null,
  primary key(id)
);

CREATE TABLE IF NOT EXISTS hp_cargos(
  id int not null auto_increment,
  nome varchar(30) not null,
  primary key(id)
);

CREATE TABLE IF NOT EXISTS hp_permissions(
  id int not null auto_increment,
  nome varchar(60) not null,
  primary key(id)
);

CREATE TABLE IF NOT EXISTS hp_cargos_permissions(
  id int not null auto_increment,
  cargo int not null,
  permission int not null,
  foreign key(cargo) references hp_cargos(id),
  foreign key(permission) references hp_permissions(id),
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

INSERT INTO hp_permissions VALUES(null, 'GERENCIAR NOTICIAS'),(null, 'GERENCIAR MEMBROS'),(null, 'GERENCIAR CARGOS'),(null, 'GERENCIAR PERMISSOES'),
(null, 'GERENCIAR EVENTOS');

INSERT INTO hp_cargos_permissions VALUES(null, 1, 1), (null, 1, 2),(null, 1, 3),(null, 1, 4),(null, 1, 5);