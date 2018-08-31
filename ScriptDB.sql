CREATE DATABASE EasyCardDB;

CREATE TABLE Cliente (
	Nombre char(100),
	Correo char(100),
	DPI_Cliente char(13),
	NIT char(7),
	Telefono char(12),
	PRIMARY KEY (DPI_Cliente)
);

CREATE TABLE Tarjeta(
	Numero_de_tarjeta char(16),
	Tipo_de_tarjeta char(1),
	Nombre_del_propietario char(30),
	Numero_de_seguridad char(3),
	Monto_Autorizado integer,
	Fecha_de_vencimiento date,
	Monto_gastado integer,
	DPI_Cliente char(13),
	PRIMARY KEY (Numero_de_tarjeta),
	FOREIGN KEY(DPI_Cliente) REFERENCES Cliente
);

CREATE TABLE Registro_de_uso (
	ID_de_transaccion serial,
	Monto_utilizado integer,
	Fecha_de_uso date,
	Tipo_de_Transaccion char(1),
	Numero_de_tarjeta char(16),
	PRIMARY KEY (ID_de_transaccion),
	FOREIGN KEY(Numero_de_tarjeta) REFERENCES Tarjeta
);

CREATE TABLE Tienda (
	Nombre char(100),
	Codigo serial,
	PRIMARY KEY (Codigo)
);

CREATE TABLE donde_se_uso (
	Codigo char(30),
	ID_de_transaccion serial,
	PRIMARY KEY(Codigo,ID_de_transaccion),
	FOREIGN KEY (Codigo) REFERENCES Tienda,
	FOREIGN KEY (ID_de_transaccion) REFERENCES Registro_de_uso
);

//SOLO PARA REFERENCIA// 
INSERT INTO Cliente (Nombre, Correo, DPI_Cliente, NIT, Telefono) 
VALUES ('Santiago', 'hola@gmail.com', '1234567859101', '1234567', '+50240471193');

INSERT INTO Tarjeta (Numero_de_tarjeta, Tipo_de_tarjeta, Nombre_del_propietario, 
	Numero_de_seguridad, Monto_Autorizado, Fecha_de_vencimiento, Monto_gastado, DPI_Cliente) 
VALUES ('1234123412341234', '0', 'Victor', '123', 5000, '2008-11-11', 0, '1234567859101');