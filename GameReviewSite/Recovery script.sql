-- -----------------------------------------------------
-- Table `Video Games`
-- -----------------------------------------------------



CREATE TABLE IF NOT EXISTS `Video Games` (
  `Video_Game_ID` INT NOT NULL,
  `Video_Game_Name` VARCHAR(45) NOT NULL,
  `Video Game Genre` VARCHAR(45) NULL,
  `Video_Game_Description/Comments` VARCHAR(255) NULL,
  PRIMARY KEY (`Video_Game_ID`));


-- -----------------------------------------------------
-- Table `Critics`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Critics` (
  `Critics_ID` INT NOT NULL,
  `Critics_Name` VARCHAR(55) NOT NULL,
  `Critics_Current_Employer` VARCHAR(55) NULL,
  `Critics_Comments` VARCHAR(255) NULL,
  `Rating?` INT NULL,
  PRIMARY KEY (`Critics_ID`));


-- -----------------------------------------------------
-- Table `Reviews`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Reviews` (
  `Review_ID` INT NOT NULL,
  `Critics_ID` INT NOT NULL,
  `Video_Game_ID` INT NOT NULL,
  `Review_Content` VARCHAR(2000) NULL,
  `Review_Comments` VARCHAR(255) NULL,
  PRIMARY KEY (`Review_ID`, `Critics_ID`, `Video_Game_ID`),
  INDEX `Critics_D_idx` (`Critics_ID` ASC),
  INDEX `Video_Game_ID_idx` (`Video_Game_ID` ASC),
  CONSTRAINT `Critics_ID`
    FOREIGN KEY (`Critics_ID`)
    REFERENCES `Critics` (`Critics_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Video_Game_ID`
    FOREIGN KEY (`Video_Game_ID`)
    REFERENCES `Video Games` (`Video_Game_ID`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);


-- -----------------------------------------------------
-- Table `Members`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTs `members` (
	`Member_ID` INT(11) NOT NULL AUTO_INCREMENT,
	`Member_Name` VARCHAR(45) NOT NULL,
	`Member_EMail` VARCHAR(45) NOT NULL,
	`Member_Username` VARCHAR(45) NOT NULL,
	`Member_Password` VARCHAR(45) NOT NULL,
	`Member_Image_Pathway` VARCHAR(100) NULL DEFAULT NULL,
	`Member_Comments` VARCHAR(255) NULL DEFAULT NULL,
	`Member_Confirm_Code` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`Member_ID`)
);



-- -----------------------------------------------------
-- Table `Video Games/Members Junction Table`
-- -----------------------------------------------------
CREATE TABLE `video games/members junction table` (
	`Video_Game_ID` INT(11) NOT NULL,
	`Member_ID` INT(11) NOT NULL,
	`Junction Comments` VARCHAR(255) NULL DEFAULT NULL,
	PRIMARY KEY (`Video_Game_ID`, `Member_ID`),
	INDEX `Member_ID_idx` (`Member_ID`)
)


-- -----------------------------------------------------
-- Table `Blocked Critics Junction`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `Blocked Critics Junction` (
  `Critics_ID` INT NOT NULL,
  `Member_ID` INT NOT NULL,
  `Blocked Critics Junction Comments` VARCHAR(255) NULL,
  PRIMARY KEY (`Critics_ID`, `Member_ID`),
  INDEX `Member_ID_idx` (`Member_ID` ASC));