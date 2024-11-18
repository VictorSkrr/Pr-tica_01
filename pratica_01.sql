create database pratica_01;

use pratica_01;

create table Clientes(
id int auto_increment primary key ,
nome varchar(100) not null,
email varchar(100) not null,
telefone varchar (15) not null);

create table Colaboradores(
id int auto_increment primary key,
nome varchar(100) not null);

create table Chamados(
id int auto_increment primary key,
cliente_id int not null,
colaborador_id int not null,
descricao text not null,
criticidade enum('baixa','média','alta') not null,
status enum('aberto','em andamento','resolvido'),
data_abertura timestamp default current_timestamp,
foreign key(cliente_id) references Clientes(id),
foreign key(colaborador_id) references Colaboradores(id)
);



