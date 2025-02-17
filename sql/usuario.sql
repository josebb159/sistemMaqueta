ALTER TABLE usuarios
ADD id_sucursal INT;

ALTER TABLE usuarios
ADD COLUMN ip VARCHAR(25),
ADD COLUMN init_sesion DATETIME;