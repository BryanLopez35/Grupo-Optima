/*
 Navicat Premium Data Transfer

 Source Server         : DB Desarrollo
 Source Server Type    : MySQL
 Source Server Version : 50742 (5.7.42-log)
 Source Host           : localhost:3306
 Source Schema         : optima

 Target Server Type    : MySQL
 Target Server Version : 50742 (5.7.42-log)
 File Encoding         : 65001

 Date: 06/01/2024 03:51:41
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for autos
-- ----------------------------
DROP TABLE IF EXISTS `autos`;
CREATE TABLE `autos`  (
  `idAuto` int(11) NOT NULL AUTO_INCREMENT,
  `marca` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`idAuto`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 5 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of autos
-- ----------------------------
INSERT INTO `autos` VALUES (1, 'Honda');
INSERT INTO `autos` VALUES (2, 'KIA');
INSERT INTO `autos` VALUES (3, 'Ford');
INSERT INTO `autos` VALUES (4, 'Nissan');

-- ----------------------------
-- Table structure for modelos
-- ----------------------------
DROP TABLE IF EXISTS `modelos`;
CREATE TABLE `modelos`  (
  `idModelo` int(11) NOT NULL AUTO_INCREMENT,
  `modelo` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idAuto` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idModelo`) USING BTREE,
  INDEX `idAuto`(`idAuto`) USING BTREE,
  CONSTRAINT `modelos_ibfk_1` FOREIGN KEY (`idAuto`) REFERENCES `autos` (`idAuto`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 13 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of modelos
-- ----------------------------
INSERT INTO `modelos` VALUES (1, 'CRV', 1);
INSERT INTO `modelos` VALUES (2, 'HRV', 1);
INSERT INTO `modelos` VALUES (3, 'BRV', 1);
INSERT INTO `modelos` VALUES (4, 'SOUL', 2);
INSERT INTO `modelos` VALUES (5, 'RIO', 2);
INSERT INTO `modelos` VALUES (6, 'SPORTAGE', 2);
INSERT INTO `modelos` VALUES (7, 'MUSTANG', 3);
INSERT INTO `modelos` VALUES (8, 'ESCAPE', 3);
INSERT INTO `modelos` VALUES (9, 'FIESTA', 3);
INSERT INTO `modelos` VALUES (10, 'VERSA', 4);
INSERT INTO `modelos` VALUES (11, 'MARCH', 4);
INSERT INTO `modelos` VALUES (12, 'SENTRA', 4);

-- ----------------------------
-- Table structure for prospectos
-- ----------------------------
DROP TABLE IF EXISTS `prospectos`;
CREATE TABLE `prospectos`  (
  `idProspecto` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `apellido` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `edad` int(11) NOT NULL,
  `telefono` varchar(15) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `idAutoInteres` int(11) NULL DEFAULT NULL,
  `idModeloInteres` int(11) NULL DEFAULT NULL,
  PRIMARY KEY (`idProspecto`) USING BTREE,
  INDEX `idAutoInteres`(`idAutoInteres`) USING BTREE,
  INDEX `idModeloInteres`(`idModeloInteres`) USING BTREE,
  CONSTRAINT `prospectos_ibfk_1` FOREIGN KEY (`idAutoInteres`) REFERENCES `autos` (`idAuto`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `prospectos_ibfk_2` FOREIGN KEY (`idModeloInteres`) REFERENCES `modelos` (`idModelo`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 26 CHARACTER SET = latin1 COLLATE = latin1_swedish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of prospectos
-- ----------------------------
INSERT INTO `prospectos` VALUES (18, 'Bryan', 'Lopez', 26, '6642874134', 'example@icloud.com', 1, 2);
INSERT INTO `prospectos` VALUES (23, 'Carlos', 'Miranda', 63, '6632874321', 'example@gmail.com', 4, 12);
INSERT INTO `prospectos` VALUES (25, 'Evelyn', 'Haro', 23, '6649999999', 'example@hotmail.com', 3, 7);

-- ----------------------------
-- Procedure structure for getCars
-- ----------------------------
DROP PROCEDURE IF EXISTS `getCars`;
delimiter ;;
CREATE PROCEDURE `getCars`()
BEGIN
	#Routine body goes here...
	SELECT idAuto, marca FROM Autos;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getData
-- ----------------------------
DROP PROCEDURE IF EXISTS `getData`;
delimiter ;;
CREATE PROCEDURE `getData`()
BEGIN
	#Routine body goes here...
	SELECT 
    P.idProspecto,
    P.nombre,
		P.apellido,
    P.edad,
    P.telefono,
    P.email,
    A.marca AS marcaAuto,
    M.modelo AS modeloAuto
	FROM prospectos P
	LEFT JOIN Autos A ON P.idAutoInteres = A.idAuto
	LEFT JOIN Modelos M ON P.idModeloInteres = M.idModelo;

	
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getDataProspecto
-- ----------------------------
DROP PROCEDURE IF EXISTS `getDataProspecto`;
delimiter ;;
CREATE PROCEDURE `getDataProspecto`(IN in_idProspecto INT)
BEGIN
    SELECT 
        P.idProspecto,
        P.nombre,
        P.apellido,
        P.edad,
        P.telefono,
        P.email,
				P.idAutoInteres,
				P.idModeloInteres,
        A.marca AS marcaAuto,
        M.modelo AS modeloAuto
    FROM prospectos P
    LEFT JOIN Autos A ON P.idAutoInteres = A.idAuto
    LEFT JOIN Modelos M ON P.idModeloInteres = M.idModelo
    WHERE P.idProspecto = in_idProspecto;
END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getModels
-- ----------------------------
DROP PROCEDURE IF EXISTS `getModels`;
delimiter ;;
CREATE PROCEDURE `getModels`()
BEGIN
	#Routine body goes here...
	SELECT idModelo, modelo FROM modelos;

END
;;
delimiter ;

-- ----------------------------
-- Procedure structure for getModelsByCarId
-- ----------------------------
DROP PROCEDURE IF EXISTS `getModelsByCarId`;
delimiter ;;
CREATE PROCEDURE `getModelsByCarId`(IN carId INT)
BEGIN
    #Routine body goes here...
    SELECT idModelo, modelo FROM modelos WHERE idAuto = carId;
END
;;
delimiter ;

SET FOREIGN_KEY_CHECKS = 1;
