create table wm_votar_fans(
concierto_id 			int not null,
usuario_id				int not null,
votar_fans_puntuacion	int(10),
votar_fans_comentario	varchar(255),
votar_fans_fecha		date,
constraint primary key(concierto_id,usuario_id),
constraint concierto_votar_fans foreign key (concierto_id) references wm_concierto (concierto_id),
constraint usuarios_votar_fans  foreign key (usuario_id)   references wm_usuarios  (usuario_id));
