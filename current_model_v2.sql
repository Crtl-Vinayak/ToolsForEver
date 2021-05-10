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
  `verkoopprijs` DOUBLE NOT NULL,
  PRIMARY KEY (`idproduct`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `toolsforever`.`vestiging_locatie`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `toolsforever`.`vestiging_locatie` ;

CREATE TABLE IF NOT EXISTS `toolsforever`.`vestiging_locatie` (
  `idlocatie` INT NOT NULL AUTO_INCREMENT,
  `naam` VARCHAR(45) NOT NULL,
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
  `voorraad` INT NOT NULL,
  `minimumVoorraad` INT NOT NULL,
  `maximumVoorraad` INT NOT NULL,
  INDEX `idlocatie_idx` (`idlocatie` ASC),
  INDEX `idproduct_idx` (`idproduct` ASC),
  PRIMARY KEY (`idlocatie`, `idproduct`),
  CONSTRAINT `idlocatie`
    FOREIGN KEY (`idlocatie`)
    REFERENCES `toolsforever`.`vestiging_locatie` (`idlocatie`)
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
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (1, 'accuboorhamer', 'WX 382', 'Worx', 111.75);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (2, '4-in-1 schuurmachine', 'KA 280 K', 'Black & Decker', 67.95);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (3, 'verstekzaag', 'BT-MS 2112', 'Einhell', 67.49);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (4, 'alleszuiger', 'WD2.200', 'Kärcher', 47.96);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (5, 'accuboormachine', 'PSR 14.4', 'Bosch', 68.00);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (6, '33-delige borenset', ' ', 'Sencys', 15.20);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (7, 'Workmate', 'WM 536', 'Black & Decker', 63.20);
INSERT INTO `toolsforever`.`products` (`idproduct`, `product`, `type`, `fabriek`, `verkoopprijs`) VALUES (8, 'Kruislijnlaserset', 'PCL 20', 'Bosch', 122.40);

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`vestiging_locatie`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`vestiging_locatie` (`idlocatie`, `naam`) VALUES (1, 'Rotterdam');
INSERT INTO `toolsforever`.`vestiging_locatie` (`idlocatie`, `naam`) VALUES (2, 'Almere');
INSERT INTO `toolsforever`.`vestiging_locatie` (`idlocatie`, `naam`) VALUES (3, 'Eindhoven');

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`medewerkers`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (1, 'Lesley', ' ', 'Brandts', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (2, 'Tristan', ' ', 'Vincent', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (3, 'Issam', ' ', 'Jooren', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (4, 'Clara', ' ', 'Stuit', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (5, 'Jefta', ' ', 'Doldersum', DEFAULT, 0);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (6, 'Vasillisa', ' ', 'Bobrova', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (7, 'Makar', ' ', 'Bocharov', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (8, 'Vinayak', 'Shukla', 'Kalapnat', DEFAULT, 1);
INSERT INTO `toolsforever`.`medewerkers` (`idmedewerker`, `voornaam`, `tussenvoegsel`, `achternaam`, `wachtwoord`, `rol`) VALUES (9, 'Piet', 'de', 'Vries', DEFAULT, 1);

COMMIT;


-- -----------------------------------------------------
-- Data for table `toolsforever`.`locatie_has_products`
-- -----------------------------------------------------
START TRANSACTION;
USE `toolsforever`;
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 1, 10, 20, 18);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 1, 10, 20, 18);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 1, 10, 20, 18);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 2, 15, 10, 20);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 2, 15, 10, 20);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 2, 15, 10, 20);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 3, 2, 0, 2);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 3, 2, 0, 2);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 3, 2, 0, 2);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 4, 4, 10, 17);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 4, 4, 10, 17);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 4, 4, 10, 17);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 5, 12, 21, 24);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 5, 12, 21, 24);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 5, 12, 21, 24);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 6, 54, 0, 60);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 6, 54, 0, 60);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 6, 54, 0, 60);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 7, 14, 0, 42);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 7, 14, 0, 42);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 7, 14, 0, 42);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (1, 8, 11, 0, 11);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (2, 8, 11, 0, 11);
INSERT INTO `toolsforever`.`locatie_has_products` (`idlocatie`, `idproduct`, `voorraad`, `minimumVoorraad`, `maximumVoorraad`) VALUES (3, 8, 11, 0, 11);

COMMIT;

