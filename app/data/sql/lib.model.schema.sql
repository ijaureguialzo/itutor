
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- profesor
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `profesor`;


CREATE TABLE `profesor`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`perfil_id` INTEGER,
	`nombre` VARCHAR(128)  NOT NULL,
	`codigo` VARCHAR(128)  NOT NULL,
	`email` VARCHAR(200),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `profesor_FI_1` (`perfil_id`),
	CONSTRAINT `profesor_FK_1`
		FOREIGN KEY (`perfil_id`)
		REFERENCES `perfil` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- asignatura
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `asignatura`;


CREATE TABLE `asignatura`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`profesor_id` INTEGER,
	`nombre` VARCHAR(200),
	`descripcion` VARCHAR(3000),
	`aula` VARCHAR(200),
	`porcentajepruebas` INTEGER default 80,
	`porcentajefaltas` INTEGER default 10,
	`porcentajecomportamiento` INTEGER default 10,
	`maximofaltas` INTEGER default 10,
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `asignatura_FI_1` (`profesor_id`),
	CONSTRAINT `asignatura_FK_1`
		FOREIGN KEY (`profesor_id`)
		REFERENCES `profesor` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- grupo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupo`;


CREATE TABLE `grupo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`profesor_id` INTEGER,
	`nombre` VARCHAR(200),
	`descripcion` VARCHAR(3000),
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `grupo_FI_1` (`profesor_id`),
	CONSTRAINT `grupo_FK_1`
		FOREIGN KEY (`profesor_id`)
		REFERENCES `profesor` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- perfil
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `perfil`;


CREATE TABLE `perfil`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`nombre` VARCHAR(200),
	`descripcion` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- hora
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `hora`;


CREATE TABLE `hora`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tramo` VARCHAR(200),
	`descanso` INTEGER default 0,
	`descripcion` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- horaperfil
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `horaperfil`;


CREATE TABLE `horaperfil`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`hora_id` INTEGER,
	`perfil_id` INTEGER,
	`orden` INTEGER,
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `horaperfil_FI_1` (`hora_id`),
	CONSTRAINT `horaperfil_FK_1`
		FOREIGN KEY (`hora_id`)
		REFERENCES `hora` (`id`)
		ON DELETE CASCADE,
	INDEX `horaperfil_FI_2` (`perfil_id`),
	CONSTRAINT `horaperfil_FK_2`
		FOREIGN KEY (`perfil_id`)
		REFERENCES `perfil` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- horario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `horario`;


CREATE TABLE `horario`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`profesor_id` INTEGER,
	`asignatura_id` INTEGER,
	`grupo_id` INTEGER,
	`dia` INTEGER,
	`hora` INTEGER,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `horario_FI_1` (`profesor_id`),
	CONSTRAINT `horario_FK_1`
		FOREIGN KEY (`profesor_id`)
		REFERENCES `profesor` (`id`)
		ON DELETE CASCADE,
	INDEX `horario_FI_2` (`asignatura_id`),
	CONSTRAINT `horario_FK_2`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE,
	INDEX `horario_FI_3` (`grupo_id`),
	CONSTRAINT `horario_FK_3`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- alumno
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `alumno`;


CREATE TABLE `alumno`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`grupo_id` INTEGER,
	`codigo` INTEGER,
	`nombre` VARCHAR(200),
	`email` VARCHAR(200),
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `alumno_FI_1` (`grupo_id`),
	CONSTRAINT `alumno_FK_1`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- evaluacion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `evaluacion`;


CREATE TABLE `evaluacion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`titulo` VARCHAR(200),
	`fechaini` DATE,
	`fechafin` DATE,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- grupoevaluacion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `grupoevaluacion`;


CREATE TABLE `grupoevaluacion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`grupo_id` INTEGER,
	`evaluacion_id` INTEGER,
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `grupoevaluacion_FI_1` (`grupo_id`),
	CONSTRAINT `grupoevaluacion_FK_1`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`)
		ON DELETE CASCADE,
	INDEX `grupoevaluacion_FI_2` (`evaluacion_id`),
	CONSTRAINT `grupoevaluacion_FK_2`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- falta
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `falta`;


CREATE TABLE `falta`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`alumno_id` INTEGER,
	`asignatura_id` INTEGER,
	`dia` INTEGER,
	`hora` INTEGER,
	`fecha` DATE,
	`justificado` INTEGER default 0,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `falta_FI_1` (`evaluacion_id`),
	CONSTRAINT `falta_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `falta_FI_2` (`alumno_id`),
	CONSTRAINT `falta_FK_2`
		FOREIGN KEY (`alumno_id`)
		REFERENCES `alumno` (`id`)
		ON DELETE CASCADE,
	INDEX `falta_FI_3` (`asignatura_id`),
	CONSTRAINT `falta_FK_3`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- retraso
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `retraso`;


CREATE TABLE `retraso`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`alumno_id` INTEGER,
	`asignatura_id` INTEGER,
	`dia` INTEGER,
	`hora` INTEGER,
	`fecha` DATE,
	`justificado` INTEGER default 0,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `retraso_FI_1` (`evaluacion_id`),
	CONSTRAINT `retraso_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `retraso_FI_2` (`alumno_id`),
	CONSTRAINT `retraso_FK_2`
		FOREIGN KEY (`alumno_id`)
		REFERENCES `alumno` (`id`)
		ON DELETE CASCADE,
	INDEX `retraso_FI_3` (`asignatura_id`),
	CONSTRAINT `retraso_FK_3`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- prueba
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `prueba`;


CREATE TABLE `prueba`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`asignatura_id` INTEGER,
	`dia` INTEGER,
	`hora` INTEGER,
	`fecha` DATE,
	`duracion` INTEGER,
	`porcentaje` INTEGER default 100,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `prueba_FI_1` (`evaluacion_id`),
	CONSTRAINT `prueba_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `prueba_FI_2` (`asignatura_id`),
	CONSTRAINT `prueba_FK_2`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- notaprueba
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notaprueba`;


CREATE TABLE `notaprueba`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`alumno_id` INTEGER,
	`prueba_id` INTEGER,
	`nota` FLOAT,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `notaprueba_FI_1` (`alumno_id`),
	CONSTRAINT `notaprueba_FK_1`
		FOREIGN KEY (`alumno_id`)
		REFERENCES `alumno` (`id`)
		ON DELETE CASCADE,
	INDEX `notaprueba_FI_2` (`prueba_id`),
	CONSTRAINT `notaprueba_FK_2`
		FOREIGN KEY (`prueba_id`)
		REFERENCES `prueba` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- notaevaluacion
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `notaevaluacion`;


CREATE TABLE `notaevaluacion`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`alumno_id` INTEGER,
	`asignatura_id` INTEGER,
	`nota` FLOAT,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `notaevaluacion_FI_1` (`evaluacion_id`),
	CONSTRAINT `notaevaluacion_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `notaevaluacion_FI_2` (`alumno_id`),
	CONSTRAINT `notaevaluacion_FK_2`
		FOREIGN KEY (`alumno_id`)
		REFERENCES `alumno` (`id`)
		ON DELETE CASCADE,
	INDEX `notaevaluacion_FI_3` (`asignatura_id`),
	CONSTRAINT `notaevaluacion_FK_3`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- comportamiento
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `comportamiento`;


CREATE TABLE `comportamiento`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`alumno_id` INTEGER,
	`evaluacion_id` INTEGER,
	`asignatura_id` INTEGER,
	`nota` FLOAT,
	`observaciones` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `comportamiento_FI_1` (`alumno_id`),
	CONSTRAINT `comportamiento_FK_1`
		FOREIGN KEY (`alumno_id`)
		REFERENCES `alumno` (`id`)
		ON DELETE CASCADE,
	INDEX `comportamiento_FI_2` (`evaluacion_id`),
	CONSTRAINT `comportamiento_FK_2`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `comportamiento_FI_3` (`asignatura_id`),
	CONSTRAINT `comportamiento_FK_3`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- festivo
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `festivo`;


CREATE TABLE `festivo`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`fecha` DATE,
	`motivo` VARCHAR(3000),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `festivo_FI_1` (`evaluacion_id`),
	CONSTRAINT `festivo_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- diario
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `diario`;


CREATE TABLE `diario`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`evaluacion_id` INTEGER,
	`asignatura_id` INTEGER,
	`grupo_id` INTEGER,
	`profesor_id` INTEGER,
	`fecha` DATE,
	`actividad` VARCHAR(3000),
	`udidactica` VARCHAR(200),
	`activo` INTEGER default 1,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	INDEX `diario_FI_1` (`evaluacion_id`),
	CONSTRAINT `diario_FK_1`
		FOREIGN KEY (`evaluacion_id`)
		REFERENCES `evaluacion` (`id`)
		ON DELETE CASCADE,
	INDEX `diario_FI_2` (`asignatura_id`),
	CONSTRAINT `diario_FK_2`
		FOREIGN KEY (`asignatura_id`)
		REFERENCES `asignatura` (`id`)
		ON DELETE CASCADE,
	INDEX `diario_FI_3` (`grupo_id`),
	CONSTRAINT `diario_FK_3`
		FOREIGN KEY (`grupo_id`)
		REFERENCES `grupo` (`id`)
		ON DELETE CASCADE,
	INDEX `diario_FI_4` (`profesor_id`),
	CONSTRAINT `diario_FK_4`
		FOREIGN KEY (`profesor_id`)
		REFERENCES `profesor` (`id`)
		ON DELETE CASCADE
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
