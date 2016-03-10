create table wm_fotos(
foto_id				int primary key not null auto_increment,
foto_nombre			varchar(255),
foto_descripcion	varchar(255),
foto_url			varchar(255),
usuario_id			int not null,
constraint usuarios_foto foreign key (usuario_id) references wm_usuarios(usuario_id));