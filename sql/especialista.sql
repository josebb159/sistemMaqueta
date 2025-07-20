Create table especialista(
	id_especialista int AUTO_INCREMENT,  
	id_usuarios int,
	foto varchar(100),
	nombre_completo varchar(100),
	telefono varchar(100),
	correo varchar(100),
	categories_selected varchar(100),
	anio_experiencia varchar(100),
	metodos_pago varchar(100),
	cartera varchar(100),
	antecedentes varchar(100),
	cedula_frontal varchar(100),
	cedula_trasera varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_especialista)
	,FOREIGN KEY(id_usuarios) REFERENCES usuarios(id_usuarios)
)
