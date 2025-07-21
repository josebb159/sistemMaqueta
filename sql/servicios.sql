Create table servicios(
	id_servicios int AUTO_INCREMENT,  
	categorias_subcategorias int,
	detalle text,
	foto varchar(100),
	direccion varchar(256),
	solicitado_para int,
	oferta int,
	metodo_pago int,
	calificacion int,
	estado_servicio int,
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_servicios)
)
