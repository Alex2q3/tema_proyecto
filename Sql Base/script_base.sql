create database pry_honeypot character set utf8;
--Creación usuario de Base de datos
create user adproject@'localhost';
set PASSWORD for 'adproject'@'localhost' = 'Telecom321%';
--Dar privilegios al usuario
grant all on pry_honeypot.* to adproject@'localhost';
--Actualizar los cambios
flush privileges;


--Creación Tabla Usuarios (LOGIN)

CREATE TABLE `pry_honeypot`.`usuarios` (
  `idusuarios` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idusuarios`),
  UNIQUE INDEX `username_UNIQUE` (`username` ASC) VISIBLE)
COMMENT = 'Tabla que almacena a los Usuarios';

--Creación Tabla Usuarios Acceso 
CREATE TABLE `pry_honeypot`.`usuarios_acceso` (
  `id_usuarios_acceso` INT NOT NULL AUTO_INCREMENT,
  `username` VARCHAR(60) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `ip` VARCHAR(20) NOT NULL,
  `fecha_acceso` DATETIME NOT NULL,
  `logueo`VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id_usuarios_acceso`))
COMMENT = 'Tabla que almacena a los Usuarios autenticados y No autenticados';

INSERT INTO 'usuarios' ('idusuarios','username','password','email','nombre') VALUES (1,'Juan','123','andres.pazmino@gmail.com','Juan Carlos Arroyo');

--Creación Tabla Boletin
CREATE TABLE `pry_honeypot`.`boletin` (
  `idboletin` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `nombre_org_pry` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(10) NOT NULL,
  `email` VARCHAR(50) NOT NULL,
  `pentesting` BOOLEAN NULL,
  `sistema_backups` BOOLEAN NULL,
  `itil` BOOLEAN NULL,
  `owasp` BOOLEAN NULL,
  `desarrollo_seguro` BOOLEAN NULL,
  `ciudad` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(50) NOT NULL,
  `comentario` VARCHAR(100) NULL,
  PRIMARY KEY (`idboletin`));
  
  --Creacion Tabla de Clientes
  CREATE TABLE `pry_honeypot`.`cliente` (
  `idcliente` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `email_institucional` VARCHAR(45) NOT NULL,
  `telefono` VARCHAR(45) NOT NULL,
  `identificacion` VARCHAR(10) NOT NULL,
  `profesion` VARCHAR(50) NOT NULL,
  `institucion` VARCHAR(50) NOT NULL,
  `ciudad` VARCHAR(50) NOT NULL,
  `sexo` VARCHAR(1) NOT NULL,
   
  
  PRIMARY KEY (`idcliente`))
COMMENT = 'Tabla que almacena los clientes.';


