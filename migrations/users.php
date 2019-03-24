<?php
$query = 'create table users
(
	id int auto_increment,
	name varchar(255) null,
	email varchar(255) null,
	password varchar(255) null,
	constraint users_pk
		primary key (id)
);

create unique index users_email_uindex
	on users (email);

';