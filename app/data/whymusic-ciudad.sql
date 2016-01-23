create table wm_ciudad(
ciudad_id 			int primary key not null auto_increment,
ciudad_nombre 		varchar(100),
habitantes			int(100),
ciudad_cp			int(10),
ciudad_comarca		varchar(100),
ciudad_provincia	varchar(100));