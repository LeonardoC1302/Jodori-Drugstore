-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema farmacia_jodori
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema farmacia_jodori
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `farmacia_jodori` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `farmacia_jodori` ;

-- -----------------------------------------------------
-- Table `farmacia_jodori`.`promotions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`promotions` (
  `promotionID` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(50) NOT NULL,
  `percentage` DECIMAL(10,2) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`promotionID`),
  UNIQUE INDEX `promotionID_UNIQUE` (`promotionID` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`users` (
  `userID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `surname` VARCHAR(30) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `admin` TINYINT NOT NULL,
  `verified` TINYINT NOT NULL,
  `token` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`userID`),
  UNIQUE INDEX `userID_UNIQUE` (`userID` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`cart` (
  `cartID` INT NOT NULL AUTO_INCREMENT,
  `userID` INT NOT NULL,
  `active` TINYINT NOT NULL,
  `promotionID` INT NOT NULL,
  PRIMARY KEY (`cartID`),
  UNIQUE INDEX `cartID_UNIQUE` (`cartID` ASC) VISIBLE,
  INDEX `fk_cart_users1_idx` (`userID` ASC) VISIBLE,
  INDEX `fk_cart_promotions1_idx` (`promotionID` ASC) VISIBLE,
  CONSTRAINT `fk_cart_promotions1`
    FOREIGN KEY (`promotionID`)
    REFERENCES `farmacia_jodori`.`promotions` (`promotionID`),
  CONSTRAINT `fk_cart_users1`
    FOREIGN KEY (`userID`)
    REFERENCES `farmacia_jodori`.`users` (`userID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`products` (
  `productID` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `cantidad` INT NOT NULL,
  `image` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`productID`),
  UNIQUE INDEX `productID_UNIQUE` (`productID` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`productsxcart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`productsxcart` (
  `cartID` INT NOT NULL,
  `productID` INT NOT NULL,
  PRIMARY KEY (`cartID`, `productID`),
  INDEX `fk_cart_has_products_products1_idx` (`productID` ASC) VISIBLE,
  INDEX `fk_cart_has_products_cart1_idx` (`cartID` ASC) VISIBLE,
  CONSTRAINT `fk_cart_has_products_cart1`
    FOREIGN KEY (`cartID`)
    REFERENCES `farmacia_jodori`.`cart` (`cartID`),
  CONSTRAINT `fk_cart_has_products_products1`
    FOREIGN KEY (`productID`)
    REFERENCES `farmacia_jodori`.`products` (`productID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`sales` (
  `salesID` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `discount` DECIMAL(10,2) NULL DEFAULT NULL,
  PRIMARY KEY (`salesID`),
  UNIQUE INDEX `ventasID_UNIQUE` (`salesID` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`productsxsale`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`productsxsale` (
  `salesID` INT NOT NULL,
  `productID` INT NOT NULL,
  `quantity` INT NOT NULL,
  PRIMARY KEY (`salesID`, `productID`),
  INDEX `fk_sales_has_products_products1_idx` (`productID` ASC) VISIBLE,
  INDEX `fk_sales_has_products_sales1_idx` (`salesID` ASC) VISIBLE,
  CONSTRAINT `fk_sales_has_products_products1`
    FOREIGN KEY (`productID`)
    REFERENCES `farmacia_jodori`.`products` (`productID`),
  CONSTRAINT `fk_sales_has_products_sales1`
    FOREIGN KEY (`salesID`)
    REFERENCES `farmacia_jodori`.`sales` (`salesID`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
