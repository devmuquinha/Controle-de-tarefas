create database db_tarefas_TCC;
use db_tarefas_TCC;

create table tb_integrantes(
tb_integrante_id integer not null auto_increment primary key,
tb_integrante_nome varchar(100) not null,
tb_integrante_senha varchar(100) not null
);
 
create table tb_tarefas(
tb_tarefa_id integer not null auto_increment primary key,
tb_tarefa_nome varchar(64)not null,
tb_tarefa_descricao varchar(256)not null,
tb_tarefa_situacao int(2)not null
);

create table tb_grupos(
tb_grupo_id integer not null auto_increment primary key,
tb_integrante_id integer,
constraint fk_integrante_id foreign key(tb_integrante_id) REFERENCES tb_integrantes(tb_integrante_id),
tb_tarefa_id integer not null,
constraint fk_tarefa_id foreign key(tb_tarefa_id) REFERENCES tb_tarefas(tb_tarefa_id)
);

create table tb_logs(
tb_log_id integer not null auto_increment primary key,
tb_log_nome varchar(64) not null,
tb_log_integrante_nome varchar(100) not null,
tb_tarefa_id integer not null,
criadoEm timestamp default current_timestamp,
mudadoEm datetime default current_timestamp on update current_timestamp
);


/*TESTES;
insert into tb_integrantes(tb_integrante_nome, tb_integrante_senha) values ("Matheus", "123456");
insert into tb_integrantes(tb_integrante_nome, tb_integrante_senha) values ("Renan", "123456");
insert into tb_integrantes(tb_integrante_nome, tb_integrante_senha) values ("Samuel", "123456");
insert into tb_integrantes(tb_integrante_nome, tb_integrante_senha) values ("José", "123456");
insert into tb_integrantes(tb_integrante_nome, tb_integrante_senha) values ("Eduardo", "123456");

insert into tb_tarefas(tb_tarefa_nome, tb_tarefa_descricao) value ("Testa tal coisa", "Testa tall coisa assim");
insert into tb_tarefas(tb_tarefa_nome, tb_tarefa_descricao) value ("Testa alguma coisa", "Testa assim assim assado");
insert into tb_tarefas(tb_tarefa_nome, tb_tarefa_descricao) value ("Testa isso", "Testa daquele jeito");
insert into tb_grupos(tb_integrante_id, tb_tarefa_id) value ("1", "1");
insert into tb_grupos(tb_integrante_id, tb_tarefa_id) value ("2", "2");
insert into tb_grupos(tb_integrante_id, tb_tarefa_id) value ("1", "3");
insert into tb_grupos(tb_integrante_id, tb_tarefa_id) value ("2", "3");
SELECT * FROM tb_integrantes WHERE tb_integrantes.tb_integrante_nome = 'Matheus' AND tb_integrantes.tb_integrante_senha = ''or 1=1#';
*/

select * from tb_grupos;
select * from tb_integrantes;
select * from tb_tarefas;
select * from tb_logs;

select tb_tarefas.tb_tarefa_id, tb_tarefas.tb_tarefa_nome, tb_tarefas.tb_tarefa_descricao, tb_integrantes.tb_integrante_nome 
from tb_grupos
inner join tb_tarefas
on tb_grupos.tb_tarefa_id = tb_tarefas.tb_tarefa_id
inner join tb_integrantes
on tb_integrantes.tb_integrante_id = tb_grupos.tb_integrante_id
order by tb_tarefas.tb_tarefa_id;

/*drop database db_tarefas_tcc;*/