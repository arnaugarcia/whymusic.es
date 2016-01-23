create table wm_votar_grupo(
id_voto_grupo					int primary key not null auto_increment,
fan_id							int not null,
grupo_id						int not null,
votar_fans_grupo_puntuacion		int(10),
votar_fans_grupo_comentario		varchar(255),
votar_fans_grupo_fecha			date,
constraint fan_votar_grupo foreign key (fan_id) references wm_usuarios (usuario_id),
constraint grupo_votar foreign key (grupo_id)   references wm_usuarios  (usuario_id));