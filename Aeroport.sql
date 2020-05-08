-- MySQL Script generated by MySQL Workbench
-- Tue May  5 00:43:23 2020
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema aeroport
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema aeroport
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `aeroport` DEFAULT CHARACTER SET utf8 ;
USE `aeroport` ;

-- -----------------------------------------------------
-- Table `aeroport`.`rute`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aeroport`.`rute` (
  `idRuta` INT NOT NULL AUTO_INCREMENT,
  `aeroport_plecare` VARCHAR(45) NULL,
  `aeroport_sosire` VARCHAR(45) NULL,
  PRIMARY KEY (`idRuta`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aeroport`.`avioane`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aeroport`.`avioane` (
  `idAvion` INT NOT NULL AUTO_INCREMENT,
  `model` VARCHAR(45) NULL,
  `marca` VARCHAR(45) NULL,
  `nume` VARCHAR(45) NULL,
  PRIMARY KEY (`idAvion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aeroport`.`angajati`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aeroport`.`angajati` (
  `idAngajat` INT NOT NULL AUTO_INCREMENT,
  `nume` VARCHAR(45) NULL,
  `prenume` VARCHAR(45) NULL,
  `email` VARCHAR(45) NULL,
  `cnp` VARCHAR(45) NULL,
  `data_angajare` DATE NULL,
  `salariu` INT NULL,
  `tip_angajat` VARCHAR(50) NULL,
  `calificari` TEXT NULL,
  PRIMARY KEY (`idAngajat`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aeroport`.`echipaje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aeroport`.`echipaje` (
  `idEchipaj` INT NOT NULL AUTO_INCREMENT,
  `idPilot` INT NULL,
  `idCopilot` INT NULL,
  `idSteward1` INT NULL,
  `idSteward2` INT NULL,
  PRIMARY KEY (`idEchipaj`),
  CONSTRAINT `pilot_fk`
    FOREIGN KEY (`idPilot`)
    REFERENCES `aeroport`.`angajati` (`idAngajat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `copilot_fk`
    FOREIGN KEY (`idCopilot`)
    REFERENCES `aeroport`.`angajati` (`idAngajat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `s1_fk`
    FOREIGN KEY (`idSteward1`)
    REFERENCES `aeroport`.`angajati` (`idAngajat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `s2_fk`
    FOREIGN KEY (`idSteward2`)
    REFERENCES `aeroport`.`angajati` (`idAngajat`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `aeroport`.`zboruri`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `aeroport`.`zboruri` (
  `idZbor` INT NOT NULL AUTO_INCREMENT,
  `idRuta` INT NOT NULL,
  `idAvion` INT NOT NULL,
  `idEchipaj` INT NOT NULL,
  `ora_plecare` DATETIME NULL,
  `ora_sosire` DATETIME NULL,
  `Observatii` VARCHAR(45) NULL,
  PRIMARY KEY (`idZbor`),

  CONSTRAINT `echipaj_fk`
    FOREIGN KEY (`idEchipaj`)
    REFERENCES `aeroport`.`echipaje` (`idEchipaj`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `avion_fk`
    FOREIGN KEY (`idAvion`)
    REFERENCES `aeroport`.`avioane` (`idAvion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `ruta_fk`
    FOREIGN KEY (`idRuta`)
    REFERENCES `aeroport`.`rute` (`idRuta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
