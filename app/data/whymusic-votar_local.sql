create table wm_votar_local(
id_voto_local					int primary key not null auto_increment,
fan_id							int not null,
local_id						int not null,
votar_fans_local_puntuacion		int(10),
votar_fans_local_comentario		varchar(255),
votar_fans_local_fecha			date,
constraint local_votar_local foreign key (fan_id) references wm_usuarios (usuario_id),
constraint local_votar_local foreign key (local_id)   references wm_usuarios  (usuario_id));