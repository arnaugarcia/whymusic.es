create table wm_concierto(
concierto_id 			int primary key not null auto_increment,
concierto_fecha			date,
concierto_precio		double(10,2),
concierto_asistentes	int(100),
concierto_duracion		int(100),
usuario_id				int not null,
constraint usuario_concierto foreign key (usuario_id) references wm_usuarios(usuario_id)); 