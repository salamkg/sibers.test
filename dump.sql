CREATE DATABASE IF NOT EXISTS test;
use test;

CREATE table users (
	id int not null auto_increment,
	email varchar(255) not null,
	password varchar(255) not null,
	first_name varchar(255) not null,
	last_name varchar(255) not null,
	gender varchar(255) not null,
	birthday int not null,
	primary key (id)
);