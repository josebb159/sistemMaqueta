Create table categories(
	id_categories int AUTO_INCREMENT,  
	nombre varchar(100),
	description varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_categories)
)
