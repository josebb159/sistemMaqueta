Create table subcategories(
	id_subcategories int AUTO_INCREMENT,  
	id_categories int,
	nombre varchar(100),
	description varchar(100),
	valor_min varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_subcategories)
	,FOREIGN KEY(id_categories) REFERENCES categories(id_categories)
)
