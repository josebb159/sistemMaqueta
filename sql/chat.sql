Create table chat(
	id_chat int AUTO_INCREMENT,  
	chat varchar(100),
	usuario varchar(100),
	especialista varchar(100),
	estado_visto varchar(100),
	fecha_registro TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	fecha_actualizacion TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
	estado int,
	primary key(id_chat)
)
