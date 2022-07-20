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

CREATE TABLE IF NOT EXISTS hp_radio_horarios(
  id int auto_increment primary key not null,
  comeca time not null,
  termina time not null
);

CREATE TABLE IF NOT EXISTS hp_radio_horarios_marcados(
  id int auto_increment primary key not null,
  usuario varchar(255) not null default '',
  horario int not null,
  dia date not null default '0000-00-00'
);

CREATE TABLE IF NOT EXISTS hp_compras(
  id int auto_increment primary key not null,
  id_compravel int not null,
  nome_compravel varchar(255) not null,
  codigo varchar(255) not null,
  discord_usuario varchar(255) not null,
  resolvido enum('sim', 'nao') default 'nao'
);

ALTER TABLE hp_radio_horarios_marcados ADD CONSTRAINT fk_horario FOREIGN KEY(horario) REFERENCES hp_radio_horarios(id);

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
(null, 'GERENCIAR EVENTOS'), (null, 'MARCAR HORARIOS'),(null, 'GERENCIAR HORARIOS'),(null, 'GERENCIAR COMPRAVEIS'),(null, 'GERENCIAR VALORES'),(null, 'GERENCIAR HABBLETXD HOME')
(null, 'GERENCIAR COMPRAS'),(null, 'GERENCIAR EMBLEMAS'),(null, 'GERENCIAR PEDIDOS RADIO');

INSERT INTO hp_cargos_permissions VALUES(null, 1, 1), (null, 1, 2),(null, 1, 3),(null, 1, 4),(null, 1, 5),(null, 1, 6),(null, 1, 7),(null, 1, 8),(null, 9, 6),(null, 9, 7),
(null, 1, 9),(null, 1, 10);

INSERT INTO hp_radio_horarios(comeca, termina) VALUES('00:00', '01:00'),('01:00', '02:00'),('02:00', '03:00'),('03:00', '04:00'),
('04:00', '05:00'),('05:00', '06:00'),('06:00', '07:00'),('07:00', '08:00'),('08:00', '09:00'),('09:00', '10:00'),('10:00', '11:00'),
('11:00', '12:00'),('12:00', '13:00'),('13:00', '14:00'),('14:00', '15:00'),('15:00', '16:00'),('16:00', '17:00'),('17:00', '18:00'),
('18:00', '19:00'),('19:00', '20:00'),('20:00', '21:00'),('21:00', '22:00'),('22:00', '23:00'),('23:00', '00:00');

INSERT INTO hp_radio_horarios_marcados(usuario, horario, dia) VALUES('Geefi', 5, '2022-07-01');