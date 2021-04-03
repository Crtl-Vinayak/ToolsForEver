-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema toolsforever
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `toolsforever` ;

-- -----------------------------------------------------
-- Schema toolsforever
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `toolsforever` DEFAULT CHARACTER SET utf8 ;
USE `toolsforever` ;

-- -----------------------------------------------------
-- Table `toolsforever`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `toolsforever`.`products` ;

CREATE TABLE IF NOT EXISTS `toolsforever`.`products` (
  `idproduct` INT NOT NULL AUTO_INCREMENT,
  `product` VARCHAR(45) NOT NULL,
  `type` VARCHAR(45) NULL,
  `fabriek` VARCHAR(45) NOT NULL,
  `voorraad` INT NOT NULL,
  `minimumVoorraad` INT NOT NULL,
  `verkoopprijs` DOUBLE NOT NULL,
  PRIMARY KEY (`idproduct`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `toolsforever`.`locatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `toolsforever`.`locatie` ;

CREATE TABLE IF NOT EXISTS `toolsforever`.`locatie` (
  `idlocatie` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idlocatie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `toolsforever`.`medewerkers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `toolsforever`.`medewerkers` ;

CREATE TABLE IF NOT EXISTS `toolsforever`.`medewerkers` (
  `idmedewerker` INT NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(45) NOT NULL,
  `tussenvoegsel` VARCHAR(45) NULL,
  `achternaam` VARCHAR(45) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  `rol` TINYINT NOT NULL,
  PRIMARY KEY (`idmedewerker`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `toolsforever`.`locatie_has_products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `toolsforever`.`locatie_has_products` ;

CREATE TABLE IF NOT EXISTS `toolsforever`.`locatie_has_products` (
  `idlocatie` INT NOT NULL,
  `idproduct` INT NOT NULL,
  INDEX `idlocatie_idx` (`idlocatie` ASC),
  INDEX `idproduct_idx` (`idproduct` ASC),
  PRIMARY KEY (`idlocatie`, `idproduct`),
  CONSTRAINT `idlocatie`
    FOREIGN KEY (`idlocatie`)
    REFERENCES `toolsforever`.`locatie` (`idlocatie`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `idproduct`
    FOREIGN KEY (`idproduct`)
    REFERENCES `toolsforever`.`products` (`idproduct`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `toolsforever`.`products`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (1, 'accuboorhamer', 'WX 382', 'Worx', 10, 5, 111.75);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (2, '4-in-1 schuurmachine', 'KA 280 K', 'Black & Decker', 15, 7, 67.95);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (3, 'verstekzaag', 'BT-MS 2112', 'Einhell', 2, 2, 67.49);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (4, 'alleszuiger', 'WD2.200', 'Kärcher', 4, 3, 47.96);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (5, 'accuboormachine', 'PSR 14.4', 'Bosch', 12, 10, 68.00);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (6, '33-delige borenset', NULL, 'Sencys', 54, 15, 15.20);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (7, 'Workmate', 'WM 536', 'Black & Decker', 14, 3, 63.20);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (8, 'Kruislijnlaserset', 'PCL 20', 'Bosch', 11, 10, 122.40);

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`locatie`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (1, 'Rotterdam', '3401 VR');
INSERT INTO `toolsforever`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (2, 'Almere', '8102 IR');
INSERT INTO `toolsforever`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (3, 'Eindhoven', '2771 TM');

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`medewerkers`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (1, 'Lesley', NULL, 'Brandts', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (2, 'Tristan', NULL, 'Vincent', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (3, 'Issam', NULL, 'Jooren', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (4, 'Clara', NULL, 'Stuit', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (5, 'Jefta', NULL, 'Doldersum', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (6, 'Vasillisa', NULL, 'Bobrova', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (7, 'Makar', NULL, 'Bocharov', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (8, 'Vinayak', 'Shukla', 'Kalapnat', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (9, 'Piet', 'de', 'Vries', DEFAULT, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`locatie_has_products`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (1, 1);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (1, 2);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (1, 3);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (2, 4);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (2, 5);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (2, 6);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (3, 7);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`) VALUES (3, 8);

COMMIT;

