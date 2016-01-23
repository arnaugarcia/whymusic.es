create table wm_puja(
puja_id 		int primary key not null auto_increment,
usuario_id		int not null,
concierto_id	int not null,
puja_cantidad	double(10,2),
constraint usuario_puja foreign key(usuario_id) references wm_usuarios(usuario_id),
constraint concierto_puja foreign key(concierto_id) references  wm_concierto(concierto_id));