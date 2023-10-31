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
  `id` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(50) NOT NULL,
  `percentage` DECIMAL(10,2) NOT NULL,
  `active` TINYINT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `promotionID_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(30) NOT NULL,
  `surname` VARCHAR(30) NOT NULL,
  `username` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(60) NOT NULL,
  `admin` TINYINT NOT NULL,
  `verified` TINYINT NOT NULL,
  `token` VARCHAR(15) NOT NULL,
  `phone` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `userID_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`cart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`cart` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `userId` INT NOT NULL,
  `active` TINYINT NOT NULL,
  `promotionID` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `cartID_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_cart_users1_idx` (`userId` ASC) VISIBLE,
  INDEX `fk_cart_promotions1_idx` (`promotionID` ASC) VISIBLE,
  CONSTRAINT `fk_cart_promotions1`
    FOREIGN KEY (`promotionID`)
    REFERENCES `farmacia_jodori`.`promotions` (`id`),
  CONSTRAINT `fk_cart_users1`
    FOREIGN KEY (`userId`)
    REFERENCES `farmacia_jodori`.`users` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`categories` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `id_UNIQUE` (`id` ASC) VISIBLE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`products`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`products` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` VARCHAR(45) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  `cantidad` INT NOT NULL,
  `imagen` VARCHAR(255) NOT NULL,
  `categoryID` INT NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `productID_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_products_categories1_idx` (`categoryID` ASC) VISIBLE,
  CONSTRAINT `fk_products_categories1`
    FOREIGN KEY (`categoryID`)
    REFERENCES `farmacia_jodori`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 13
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`productsxcart`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`productsxcart` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `cartID` INT NOT NULL,
  `productID` INT NOT NULL,
  `quantity` INT NOT NULL,
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_cart_has_products_products1_idx` (`productID` ASC) VISIBLE,
  INDEX `fk_cart_has_products_cart1_idx` (`cartID` ASC) VISIBLE,
  CONSTRAINT `fk_cart_has_products_cart1`
    FOREIGN KEY (`cartID`)
    REFERENCES `farmacia_jodori`.`cart` (`id`),
  CONSTRAINT `fk_cart_has_products_products1`
    FOREIGN KEY (`productID`)
    REFERENCES `farmacia_jodori`.`products` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `farmacia_jodori`.`sales`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `farmacia_jodori`.`sales` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descripcion` VARCHAR(100) NOT NULL,
  `monto` DECIMAL(10,2) NOT NULL,
  `fecha` DATETIME NOT NULL,
  `discount` DECIMAL(10,2) NULL DEFAULT NULL,
  `userId` INT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `ventasID_UNIQUE` (`id` ASC) VISIBLE,
  INDEX `fk_sales_users1_idx` (`userId` ASC) VISIBLE,
  CONSTRAINT `fk_sales_users1`
    FOREIGN KEY (`userId`)
    REFERENCES `farmacia_jodori`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
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
  `price` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`salesID`, `productID`),
  INDEX `fk_sales_has_products_products1_idx` (`productID` ASC) VISIBLE,
  INDEX `fk_sales_has_products_sales1_idx` (`salesID` ASC) VISIBLE,
  CONSTRAINT `fk_sales_has_products_products1`
    FOREIGN KEY (`productID`)
    REFERENCES `farmacia_jodori`.`products` (`id`),
  CONSTRAINT `fk_sales_has_products_sales1`
    FOREIGN KEY (`salesID`)
    REFERENCES `farmacia_jodori`.`sales` (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
