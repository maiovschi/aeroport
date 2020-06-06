DROP  DATABASE IF EXISTS aeroport;
CREATE DATABASE IF NOT EXISTS aeroport;
USE `aeroport` ;


CREATE TABLE  `aeroport`.`rute` (
`idRuta` INT NOT NULL AUTO_INCREMENT,
`aeroport_plecare` VARCHAR(45) NULL,
`aeroport_sosire` VARCHAR(45) NULL,
PRIMARY KEY (`idRuta`));




CREATE TABLE  `aeroport`.`avioane` (
`idAvion` INT NOT NULL AUTO_INCREMENT,
`model` VARCHAR(45) NULL,
`marca` VARCHAR(45) NULL,
`nume` VARCHAR(45) NULL UNIQUE,
`data_fabricatie` DATE NULL,
`cale` VARCHAR(64) NULL,
PRIMARY KEY (`idAvion`));




CREATE TABLE  `aeroport`.`angajati` (
`idAngajat` INT NOT NULL AUTO_INCREMENT,
`nume` VARCHAR(45) NOT NULL,
`prenume` VARCHAR(45) NOT NULL,
`email` VARCHAR(45) NOT NULL UNIQUE,
`cnp` VARCHAR(45) NOT NULL UNIQUE,
`data_angajare` DATE NOT NULL,
`salariu` INT NULL,
`tip_angajat` VARCHAR(50) NOT NULL,
`calificari` VARCHAR(45) NULL,
`username` VARCHAR(45) NOT NULL UNIQUE,
`parola` VARCHAR(45) NOT NULL,
PRIMARY KEY (`idAngajat`));


CREATE TABLE `aeroport`.`zboruri` (
`idZbor` INT NOT NULL PRIMARY KEY  AUTO_INCREMENT,
`idRuta` INT NULL,
`idAvion` INT NULL,
`nrZbor` VARCHAR(45) NOT NULL UNIQUE,
`data_ora_plecare` DATETIME NOT NULL,
`data_ora_sosire` DATETIME NOT NULL,
`Observatii` VARCHAR(45) NULL,
`stareZbor` VARCHAR(45) NOT NULL,

CONSTRAINT `avion_fk`
FOREIGN KEY (`idAvion`)
REFERENCES `aeroport`.`avioane` (`idAvion`)
ON DELETE SET NULL
ON UPDATE NO ACTION,
CONSTRAINT `ruta_fk`
FOREIGN KEY (`idRuta`)
REFERENCES `aeroport`.`rute` (`idRuta`)
ON DELETE SET NULL
ON UPDATE NO ACTION);




CREATE TABLE  `aeroport`.`programe` (
`idProgram` INT NOT NULL AUTO_INCREMENT,
`tip_activitate` VARCHAR(64) NOT NULL,
`idZbor` INT NULL,
`idAngajat` INT NOT NULL,
'date' DATE,
PRIMARY KEY (`idProgram`),
CONSTRAINT `fk_zbor`
FOREIGN KEY (`idZbor`)
REFERENCES `aeroport`.`zboruri` (`idZbor`)
ON DELETE NO ACTION
ON UPDATE NO ACTION,
CONSTRAINT `fk_ang`
FOREIGN KEY (`idAngajat`)
REFERENCES `aeroport`.`angajati` (`idAngajat`)
ON DELETE CASCADE
ON UPDATE NO ACTION);



CREATE TABLE  `aeroport`.`documente` (
`idDocument` INT NOT NULL AUTO_INCREMENT,
`idAngajat` INT NOT NULL,
`cale` VARCHAR(45) NOT NULL,
`nume` VARCHAR(45) NOT NULL,
PRIMARY KEY (`idDocument`),
CONSTRAINT `fk_ang_doc`
FOREIGN KEY (`idAngajat`)
REFERENCES `aeroport`.`angajati` (`idAngajat`)
ON DELETE NO ACTION
ON UPDATE NO ACTION);

