<?php

$query = 'create table posts
(
	id int auto_increment,
	title varchar(255) null,
	picture_url varchar(255) null,
	content text null,
	user_id int(11) UNSIGNED  null,
	constraint posts_pk
		primary key (id)
);';