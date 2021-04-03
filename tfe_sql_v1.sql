-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`products` ;

CREATE TABLE IF NOT EXISTS `mydb`.`products` (
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
-- Table `mydb`.`locatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`locatie` ;

CREATE TABLE IF NOT EXISTS `mydb`.`locatie` (
  `idlocatie` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
  `address` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`idlocatie`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`medewerkers`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`medewerkers` ;

CREATE TABLE IF NOT EXISTS `mydb`.`medewerkers` (
  `idmedewerker` INT NOT NULL AUTO_INCREMENT,
  `voornaam` VARCHAR(45) NOT NULL,
  `tussenvoegsel` VARCHAR(45) NULL,
  `achternaam` VARCHAR(45) NOT NULL,
  `wachtwoord` VARCHAR(100) NOT NULL,
  `rol` TINYINT NOT NULL,
  PRIMARY KEY (`idmedewerker`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`locatie_has_products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`locatie_has_products` ;

CREATE TABLE IF NOT EXISTS `mydb`.`locatie_has_products` (
  `idlocatie` INT NOT NULL,
  `idproduct` INT NOT NULL,
  `voorraad` INT NOT NULL,
  PRIMARY KEY (`idproduct`, `idlocatie`),
  INDEX `voorraad_idx` (`voorraad` ASC),
  INDEX `naam_idx` (`idlocatie` ASC),
  CONSTRAINT `idlocatie`
    FOREIGN KEY (`idlocatie`)
    REFERENCES `mydb`.`locatie` (`idlocatie`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `idproduct`
    FOREIGN KEY (`idproduct`)
    REFERENCES `mydb`.`products` (`idproduct`)
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `voorraad`
    FOREIGN KEY (`voorraad`)
    REFERENCES `mydb`.`products` (`voorraad`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`products`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (1, 'accuboorhamer', 'WX 382', 'Worx', 10, 5, 111,75);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (2, '4-in-1 schuurmachine', 'KA 280 K', 'Black & Decker', 15, 7, 67,95);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (3, 'verstekzaag', 'BT-MS 2112', 'Einhell', 2, 2, 67,49);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (4, 'alleszuiger', 'WD2.200', 'Kärcher', 4, 3, 47,96);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (5, 'accuboormachine', 'PSR 14.4', 'Bosch', 12, 10, 68,00);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (6, '33-delige borenset', NULL, 'Sencys', 54, 15, 15,20);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (7, 'Workmate', 'WM 536', 'Black & Decker', 14, 3, 63,20);
INSERT INTO `mydb`.`products` (`idproduct`, `product`, `type`, `fabriek`, `voorraad`, `minimumVoorraad`, `verkoopprijs`) VALUES (8, 'Kruislijnlaserset', 'PCL 20', 'Bosch', 11, 10, 122,40);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`locatie`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (1, 'Rotterdam', '3401 VR');
INSERT INTO `mydb`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (2, 'Almere', '8102 IR');
INSERT INTO `mydb`.`locatie` (`idlocatie`, `naam`, `address`) VALUES (3, 'Eindhoven', '2771 TM');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`medewerkers`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (1, 'Lesley', NULL, 'Brandts', DEFAULT, 0);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (2, 'Tristan', NULL, 'Vincent', DEFAULT, 0);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (3, 'Issam', NULL, 'Jooren', DEFAULT, 0);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (4, 'Clara', NULL, 'Stuit', DEFAULT, 0);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (5, 'Jefta', NULL, 'Doldersum', DEFAULT, 0);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (6, 'Vasillisa', NULL, 'Bobrova', DEFAULT, 1);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (7, 'Makar', NULL, 'Bocharov', DEFAULT, 1);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (8, 'Vinayak', 'Shukla', 'Kalapnat', DEFAULT, 1);
INSERT INTO `mydb`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (9, 'Piet', 'de', 'Vries', DEFAULT, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`locatie_has_products`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (1, 1, 10);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (1, 2, 15);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (1, 3, 2);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (2, 4, 4);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (2, 5, 12);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (2, 6, 54);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (3, 7, 14);
INSERT INTO `mydb`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`) VALUES (3, 8, 11);

COMMIT;

