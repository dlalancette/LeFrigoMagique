-- phpMyAdmin SQL Dump
-- version 4.6.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 31, 2016 at 01:36 AM
-- Server version: 10.1.18-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id70286_db_frigomagique`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_AddRecipe` (IN `IN_NameRecipe` VARCHAR(30), IN `IN_Description` TEXT)  NO SQL
BEGIN
INSERT INTO tblRecipes
(NameRecipe, Description) 
VALUES
(IN_NameRecipe,
 IN_Description);
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_AuthentifierProfil` (IN `IN_UserName` VARCHAR(50), IN `IN_Password` VARCHAR(50), IN `OUT_IdUser` INT)  BEGIN
SELECT IdUser INTO OUT_IdUser FROM tblUsers WHERE UserName = IN_UserName AND Password = IN_Password;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_ConsulterIngredient` (IN `IN_IdIngredient` INT)  NO SQL
BEGIN
SELECT `tblIngredients`.*
FROM `tblIngredientsRecipes`
WHERE IdIngredient=IN_IdIngredient;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_ConsulterRecette` (IN `IN_IdRecette` INT)  BEGIN
SELECT `tblIngredientsRecipes`.*, `tblRecipes`.*, `tblIngredients`.*, `tblSteps`.*
FROM `tblIngredientsRecipes`
LEFT JOIN `tblIngredients` ON `tblIngredientsRecipes`.`IdIngredient` = `tblIngredients`.`IdIngredient` 
LEFT JOIN `tblRecipes` ON `tblIngredientsRecipes`.`IdRecipe` = `tblRecipes`.`IdRecipe` 
LEFT JOIN `tblSteps` ON `tblRecipes`.`IdRecipe` = `tblSteps`.`IdRecipe` WHERE IdRecipe=IN_IdRecette;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_CreateIngredient` (IN `IN_NameIngredient` VARCHAR(50), IN `IN_DaysFreezerMaxDuration` SMALLINT(6), IN `IN_DaysFridgeMaxDuration` SMALLINT(6))  NO SQL
BEGIN
INSERT INTO tblIngredients
(NameIngredient, DaysFreezerMaxDuration, DaysFridgeMaxDuration) 
VALUES
(IN_NameIngredient,
 IN_DaysFreezerMaxDuration,
 IN_DaysFridgeMaxDuration);
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_CreateProfil` (IN `IN_UserName` VARCHAR(50), IN `IN_NameUser` VARCHAR(50), IN `IN_Password` VARCHAR(50), IN `IN_FirstName` VARCHAR(50), IN `IN_Email` VARCHAR(50))  BEGIN
INSERT INTO tblUsers 
(UserName, NameUser, Password, FirstName, Email) 
VALUES
(IN_UserName,
 IN_NameUser,
 IN_Password,
 IN_FirstName,
 IN_Email);
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_DeleteIngredient` (IN `IN_IdIngredient` INT)  NO SQL
BEGIN
DELETE FROM tblIngredients
WHERE idIngredient=IN_IdIngredient;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_DeleteRecipe` (IN `IN_IdRecipe` INT)  NO SQL
BEGIN
DELETE FROM tblSteps
WHERE `tblSteps`.`IdRecipe`=IN_IdRecipe;
DELETE FROM tblRecipes
WHERE IdRecipe = IN_IdRecipe;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_GetEtapeByRecetteId` (IN `IN_RecipeId` VARCHAR(50))  BEGIN
SELECT `tblSteps`.*, `tblRecipes`.*
FROM `tblIngredients` , `tblSteps` , `tblRecipes`
LEFT JOIN `tblIngredientsFridge` ON `tblIngredients`.`IdIngredient` = `tblIngredientsFridge`.`IdIngredient` 
LEFT JOIN `tblFridge` ON `tblIngredientsFridge`.`IdFridge` = `tblFridge`.`IdFridge`
 WHERE IdRecipe=IN_RecipeId;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_GetIngrByFridgeId` (IN `IN_FridgeId` VARCHAR(50))  BEGIN
SELECT `tblIngredients`.*, `tblIngredientsFridge`.*, `tblFridge`.*
FROM `tblIngredients`
LEFT JOIN `tblIngredientsFridge` ON `tblIngredients`.`IdIngredient` = `tblIngredientsFridge`.`IdIngredient` 
LEFT JOIN `tblFridge` ON `tblIngredientsFridge`.`IdFridge` = `tblFridge`.`IdFridge` WHERE IdFridge=IN_FridgeId;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_GetRecetteByMultipleIngrId` (IN `IN_LstIngredientId` VARCHAR(255))  BEGIN
set @query = concat('SELECT `tblIngredients`.*, `tblIngredientsRecipes`.*, `tblRecipes`.* FROM `tblIngredients`
LEFT JOIN `tblIngredientsRecipes` ON `tblIngredients`.`IdIngredient` = `tblIngredientsRecipes`.`IdIngredient` 
LEFT JOIN `tblRecipes` ON `tblIngredientsRecipes`.`IdRecipe` = `tblRecipes`.`IdRecipe` where `tblIngredients`.`IdIngredient`  in (',IN_LstIngredientId,');');
prepare sql_query from @query;
execute sql_query;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_InitialiserFrigo` (IN `IN_IdUser` INT, IN `IN_NameFridge` VARCHAR(50), IN `IN_Description` TEXT)  BEGIN
INSERT INTO tblFridge (IdUser, NameFridge, Description) values (IN_IdUser, IN_NameFridge, IN_Description);
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_ModifyIngredient` (IN `IN_NameIngredient` VARCHAR(50), IN `IN_DaysFreezerMaxDuration` SMALLINT(6), IN `DaysFridgeMaxDuration` SMALLINT(6))  NO SQL
BEGIN
UPDATE tblIngredients
SET NameIngredient=IN_NameIngredient, DaysFreezerMaxDuration=IN_DaysFreezerMaxDuration, DaysFridgeMaxDuration=IN_DaysFridgeMaxDuration
WHERE idIngredient=IN_IdIngredient;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_ModifyRecipe` (IN `IN_IdRecipe` INT, IN `IN_NameRecipe` VARCHAR(30), IN `IN_Description` TEXT)  NO SQL
BEGIN
UPDATE tblRecipes
SET NameRecipe = IN_NameRecipe,
Description = IN_Description
WHERE IdRecipe = IN_IdRecipe;
END$$

CREATE DEFINER=`id70286_gestionprojet2016`@`%` PROCEDURE `Proc_RechercherterRecette` (IN `IN_NameRecette` VARCHAR(50), IN `IN_NameIngredientInRecipe` VARCHAR(50))  BEGIN
SELECT `tblIngredients`.*, `tblIngredientsRecipes`.*, `tblRecipes`.*
FROM `tblIngredients`
LEFT JOIN `tblIngredientsRecipes` ON `tblIngredients`.`IdIngredient` = `tblIngredientsRecipes`.`IdIngredient` 
LEFT JOIN `tblRecipes` ON `tblIngredientsRecipes`.`IdRecipe` = `tblRecipes`.`IdRecipe` 
WHERE `NameRecipe` LIKE IN_NameRecette AND `tblIngredients`.`NameIngredient` LIKE IN_NameIngredientInRecipe;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `tblFridge`
--

CREATE TABLE `tblFridge` (
  `IdFridge` int(11) NOT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `NameFridge` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblFridge`
--

INSERT INTO `tblFridge` (`IdFridge`, `IdUser`, `NameFridge`, `Description`) VALUES
(1, 5, 'Frigidaire a biere', 'QUE le nécessaire.'),
(2, 3, 'Vieux frigo', 'plutôt jaunie, un peu grafigné, odeurs étranges'),
(3, 1, 'Frigo a nourriture', 'un bon frigo simple'),
(4, 5, 'Frigo High-tek', 'Frigo avec téléviseur 1080p intégré, cadran extérieur décrivant la température intérieur et le niveau d\'humidité, bluetooth, connexion wi-fi, génératrice de secours 24h, contrôle a distance, contrôle des lumières, contrôle de la porte de garage, détecteur de mouvement.\r\n\r\nDirectement lié au système Frigo Magique.'),
(10, 6, NULL, NULL),
(1000, 1000, 'monFridge', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblIngredients`
--

CREATE TABLE `tblIngredients` (
  `IdIngredient` int(11) NOT NULL,
  `NameIngredient` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DaysFreezerMaxDuration` smallint(6) DEFAULT NULL,
  `DaysFridgeMaxDuration` smallint(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblIngredients`
--

INSERT INTO `tblIngredients` (`IdIngredient`, `NameIngredient`, `DaysFreezerMaxDuration`, `DaysFridgeMaxDuration`) VALUES
(1, 'Citrouille', 365, 30),
(2, 'Asperges', 365, 4),
(3, 'Aubergines', 365, 7),
(4, 'Betteraves', 365, 21),
(5, 'Bleuets', 365, 5),
(6, 'Brocoli', 365, 5),
(7, 'Canneberges', 365, 14),
(8, 'Carottes', 365, 90),
(9, 'Célerie', 365, 14),
(10, 'Cerises', 365, 3),
(11, 'Champignons', 365, 5),
(12, 'Choux', 365, 14),
(13, 'Choux de bruxelle', 365, 7),
(14, 'Chou-fleur', 365, 6),
(15, 'Concombre', 365, 7),
(16, 'Cougres', 365, 14),
(17, 'Endives', 365, 5),
(18, 'Épinards', 365, 7),
(19, 'Fèves germées', 365, 4),
(20, 'Fraises', 365, 7),
(21, 'Framboises', 365, 7),
(22, 'Mais entier', 365, 14),
(23, 'Haricots jaunes', 365, 5),
(24, 'Haricots verts', 365, 5),
(25, 'courgette', 365, 7),
(26, 'Biere rousse', 0, 90),
(27, 'Beurre', 365, 30),
(28, 'Pomme de terre', 365, 30),
(29, 'Oignon', 365, 30),
(30, 'Bouillon de legumes', 365, 14),
(31, 'estragon', NULL, NULL),
(32, 'biftecks', 4, 365),
(33, 'sel', NULL, NULL),
(34, 'poivre', NULL, NULL),
(35, 'Échalote francais', 7, 365),
(41, 'farine', NULL, NULL),
(42, 'Cassonade', NULL, NULL),
(43, 'Huile de canola', NULL, NULL),
(44, 'Cacao', NULL, NULL),
(45, 'Poudre à pâte', NULL, NULL),
(46, 'Lait', NULL, NULL),
(47, 'Vanille', NULL, NULL),
(48, 'Pépites de chocolat', NULL, NULL),
(90, 'riz blanc', NULL, NULL),
(91, 'lime', 7, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblIngredientsFridge`
--

CREATE TABLE `tblIngredientsFridge` (
  `IdIngredientFridge` int(11) NOT NULL,
  `IdFridge` int(11) DEFAULT NULL,
  `IdIngredient` int(11) DEFAULT NULL,
  `DateAddIngredient` date DEFAULT NULL,
  `DateRemoveIngredient` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblIngredientsFridge`
--

INSERT INTO `tblIngredientsFridge` (`IdIngredientFridge`, `IdFridge`, `IdIngredient`, `DateAddIngredient`, `DateRemoveIngredient`) VALUES
(1, 1, 26, '2016-10-22', NULL),
(2, 1, 26, '2016-10-28', NULL),
(3, 1, 26, '2016-10-25', NULL),
(4, 4, 8, '2016-10-24', NULL),
(5, 4, 30, '2016-10-26', NULL),
(6, 4, 29, '2016-10-20', NULL),
(7, 4, 28, '2016-10-26', NULL),
(8, 4, 27, '2016-10-30', NULL),
(9, 4, 1, '2016-10-24', NULL),
(10, 4, 27, '2016-10-23', NULL),
(11, 4, 31, '2016-10-26', NULL),
(12, 4, 32, '2016-10-27', NULL),
(13, 4, 33, '2016-10-27', NULL),
(14, 4, 34, '2016-10-30', NULL),
(15, 4, 35, '2016-10-28', NULL),
(97, 4, 90, '2016-10-26', NULL),
(98, 4, 91, '2016-10-27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblIngredientsRecipes`
--

CREATE TABLE `tblIngredientsRecipes` (
  `IdIngredientRecipe` int(11) NOT NULL,
  `IdIngredient` int(11) DEFAULT NULL,
  `IdRecipe` int(11) DEFAULT NULL,
  `Quantity` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblIngredientsRecipes`
--

INSERT INTO `tblIngredientsRecipes` (`IdIngredientRecipe`, `IdIngredient`, `IdRecipe`, `Quantity`) VALUES
(1, 30, 1, '1 litre'),
(2, 1, 1, '1 kg'),
(3, 29, 1, '500 g'),
(4, 28, 1, '500 g'),
(6, 27, 1, '1 cuillere a soupe'),
(7, 27, 2, '125g'),
(8, 31, 2, '5ml'),
(9, 32, 2, '4 gros morceaux'),
(10, 33, 2, '1ml'),
(11, 34, 2, '1ml'),
(12, 35, 2, '15ml'),
(20, 44, 6, '30 g'),
(21, 45, 6, '50 g'),
(22, 46, 6, '10 g'),
(23, 47, 6, '2 ml'),
(24, 48, 6, '500 g'),
(27, 41, 6, '500 g'),
(28, 42, 6, '30 mg'),
(29, 43, 6, '1 cuillere a soupe'),
(30, 90, 3, '2 tasses'),
(31, 91, 3, '1 entiere'),
(93, 30, 3, '3 tasses');

-- --------------------------------------------------------

--
-- Table structure for table `tblRecipes`
--

CREATE TABLE `tblRecipes` (
  `IdRecipe` int(11) NOT NULL,
  `NameRecipe` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblRecipes`
--

INSERT INTO `tblRecipes` (`IdRecipe`, `NameRecipe`, `Description`) VALUES
(1, 'Potage a la citrouille', 'un bon potage de base.'),
(2, 'T-Bone BBQ', 'De la viande sur le barbecue!'),
(3, 'Sauté de légumes', 'Un mélange végétarien de légumes sur le feux'),
(4, 'Riz a la lime', 'Accompagnement sympathique'),
(5, 'Nachos maison', 'Alors qu\'on n\'oserait souvent pas manger ceux des restaurants si l\'on en connaissait la teneur et sel et en matières grasses, les nachos maison peuvent quant à eux demeurer respectables en terme de valeur nutritive (à défaut de santé).\r\n\r\nOn les déguste avec de la salsa, du guacamole ou des trempettes, en version végé ou avec viandes, gratinés ou nature; voici 15 recettes pour des nachos maison gagnants!'),
(6, 'mug cake', 'Oubliez les cupcakes, la nouvelle tendance de l’heure est le mug cake (littéralement, un gâteau dans une tasse). Ce qu’il y a d’intéressant avec ce dessert, c’est qu’il ne demande pas de vaisselle (une tasse et une cuillère!), se cuit rapidement au micro-ondes et se présente en portion individuelle.');

-- --------------------------------------------------------

--
-- Table structure for table `tblSteps`
--

CREATE TABLE `tblSteps` (
  `IdStep` int(11) NOT NULL,
  `IdRecipe` int(11) DEFAULT NULL,
  `NumberStep` int(11) DEFAULT NULL,
  `NameStep` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Description` text COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblSteps`
--

INSERT INTO `tblSteps` (`IdStep`, `IdRecipe`, `NumberStep`, `NameStep`, `Description`) VALUES
(1, 1, 1, 'Ramollir les ingrédients', 'Dans une casserole, faire fondre le beurre à feu moyen. Faire revenir les oignons quelques minutes. Ajouter les cubes de citrouille et de pommes de terre.\r\n'),
(2, 1, 2, 'Attendre', 'Laisser cuire de 5 à 8 minutes. Verser le bouillon et porter à ébullition. Assaisonner.\r\n\r\n'),
(3, 1, 3, 'Attendre encore plus', 'Couvrir et laisser mijoter à feu doux de 20 à 30 minutes, jusqu\'à tendreté.\r\n\r\n'),
(4, 1, 4, 'Mélange moi ça!', 'Réduire le potage en purée à l\'aide du mélangeur ou du robot culinaire.\r\n'),
(5, 2, 1, 'Préparation 1/2', 'Dans un bol, mélanger tous les ingrédients.'),
(6, 2, 2, 'Préparation 2/2', 'Sur une pellicule de plastique, déposer le beurre à l’échalote et former un cylindre d’environ 4 cm (1 ½ po) de long. Refermer le cylindre en nouant les deux extrémités de la pellicule de plastique. Réfrigérer 2 heures ou jusqu’à ce qu’il soit ferme au toucher.'),
(7, 2, 3, 'Préparer le BBQ', 'Préchauffer le barbecue à puissance élevée. Huiler la grille.'),
(8, 2, 4, 'Cuisson', 'Sur un plan de travail, frotter le mélange d’épices sur les deux côtés des biftecks. Griller de 2 à 3 minutes de chaque côté pour une cuisson saignante ou poursuivre jusqu’à la cuisson désirée. Laisser reposer 5 minutes.'),
(9, 2, 5, 'Présentation', 'Couper le beurre en rondelles. Déposer une rondelle sur chaque bifteck. Délicieux avec le riz a la lime'),
(90, 3, 1, 'Si simple', 'Dans une casserole, faire revenir le riz dans l\'huile environ 2 minutes sans coloration. Ajouter le bouillon et le zeste de lime. Saler et poivrer. Porter à ébullition. Réduire le feu au minimum. Remuer et couvrir. Cuire de 15 à 20 minutes ou jusqu\'à ce que le riz soit tendre. '),
(2001, 6, 1, NULL, 'Dans une tasse à café d’une contenance d’environ 250 ml (1 tasse), mélange la farine, la cassonade, le cacao et la poudre à pâte. Ajoute le lait, l’huile et la vanille.'),
(2002, 6, 2, NULL, 'Avec une fourchette, brasse délicatement jusqu’à ce que la pâte n’ait plus de grumeaux. Dépose les pépites de chocolat sur le dessus.'),
(2003, 6, 3, NULL, 'Cuis le gâteau au micro-ondes 45 secondes. Laisse tiédir 5 minutes pour permettre au gâteau de terminer sa cuisson.');

-- --------------------------------------------------------

--
-- Table structure for table `tblUsers`
--

CREATE TABLE `tblUsers` (
  `IdUser` int(11) NOT NULL,
  `UserName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `NameUser` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Password` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `FirstName` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblUsers`
--

INSERT INTO `tblUsers` (`IdUser`, `UserName`, `NameUser`, `Password`, `FirstName`, `Email`) VALUES
(1, 'Bob56', 'Tremblay', 'MonFrigo', 'Robert', 'robert.tremblay@lefrigo.ca'),
(2, 'Dan_ftw64', 'Fortin Simard', 'Imtheteacher', 'Dany', 'danyfortinsimard@lesitedesprofs.ca'),
(3, 'pyglidden', 'Glidden', '12345', 'Pierre-Yves', 'pierreyves.glidden@lefrigo.ca'),
(4, 'd.lalancette01', 'Lalancette Guay', '54321', 'Dany', 'dany@masterofdb.org'),
(5, 'Jsamsong', 'Samson', 'abcde', 'Julien', 'Julien_levoyageur@gmail.com'),
(6, 'p.pearson', 'Pearson', 'edcba', 'Patrick', 'p.pearson@pearsonenterprice.com'),
(7, 'lemoine150', 'Lemoine', 'abcde12345', 'Ingrid', 'I.lemoine@themonk.fr'),
(1000, 'ppears', 'pearson', '1234', 'patrick', 'p.pears@outlook.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblFridge`
--
ALTER TABLE `tblFridge`
  ADD PRIMARY KEY (`IdFridge`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indexes for table `tblIngredients`
--
ALTER TABLE `tblIngredients`
  ADD PRIMARY KEY (`IdIngredient`);

--
-- Indexes for table `tblIngredientsFridge`
--
ALTER TABLE `tblIngredientsFridge`
  ADD PRIMARY KEY (`IdIngredientFridge`),
  ADD KEY `IdFridge` (`IdFridge`),
  ADD KEY `IdIngredient` (`IdIngredient`);

--
-- Indexes for table `tblIngredientsRecipes`
--
ALTER TABLE `tblIngredientsRecipes`
  ADD PRIMARY KEY (`IdIngredientRecipe`),
  ADD KEY `IdIngredient` (`IdIngredient`),
  ADD KEY `IdRecipe` (`IdRecipe`);

--
-- Indexes for table `tblRecipes`
--
ALTER TABLE `tblRecipes`
  ADD PRIMARY KEY (`IdRecipe`);

--
-- Indexes for table `tblSteps`
--
ALTER TABLE `tblSteps`
  ADD PRIMARY KEY (`IdStep`),
  ADD KEY `IdRecipe` (`IdRecipe`);

--
-- Indexes for table `tblUsers`
--
ALTER TABLE `tblUsers`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblFridge`
--
ALTER TABLE `tblFridge`
  MODIFY `IdFridge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
--
-- AUTO_INCREMENT for table `tblIngredients`
--
ALTER TABLE `tblIngredients`
  MODIFY `IdIngredient` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `tblIngredientsFridge`
--
ALTER TABLE `tblIngredientsFridge`
  MODIFY `IdIngredientFridge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `tblIngredientsRecipes`
--
ALTER TABLE `tblIngredientsRecipes`
  MODIFY `IdIngredientRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `tblRecipes`
--
ALTER TABLE `tblRecipes`
  MODIFY `IdRecipe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `tblSteps`
--
ALTER TABLE `tblSteps`
  MODIFY `IdStep` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2004;
--
-- AUTO_INCREMENT for table `tblUsers`
--
ALTER TABLE `tblUsers`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1001;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblFridge`
--
ALTER TABLE `tblFridge`
  ADD CONSTRAINT `tblFridge_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `tblUsers` (`IdUser`);

--
-- Constraints for table `tblIngredientsFridge`
--
ALTER TABLE `tblIngredientsFridge`
  ADD CONSTRAINT `tblIngredientsFridge_ibfk_1` FOREIGN KEY (`IdFridge`) REFERENCES `tblFridge` (`IdFridge`),
  ADD CONSTRAINT `tblIngredientsFridge_ibfk_2` FOREIGN KEY (`IdIngredient`) REFERENCES `tblIngredients` (`IdIngredient`);

--
-- Constraints for table `tblIngredientsRecipes`
--
ALTER TABLE `tblIngredientsRecipes`
  ADD CONSTRAINT `tblIngredientsRecipes_ibfk_1` FOREIGN KEY (`IdIngredient`) REFERENCES `tblIngredients` (`IdIngredient`),
  ADD CONSTRAINT `tblIngredientsRecipes_ibfk_2` FOREIGN KEY (`IdRecipe`) REFERENCES `tblRecipes` (`IdRecipe`);

--
-- Constraints for table `tblSteps`
--
ALTER TABLE `tblSteps`
  ADD CONSTRAINT `tblSteps_ibfk_1` FOREIGN KEY (`IdRecipe`) REFERENCES `tblRecipes` (`IdRecipe`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
