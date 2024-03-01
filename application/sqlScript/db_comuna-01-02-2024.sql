/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100425
 Source Host           : localhost:3306
 Source Schema         : db_comuna

 Target Server Type    : MySQL
 Target Server Version : 100425
 File Encoding         : 65001

 Date: 01/03/2024 13:44:50
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for casas
-- ----------------------------
DROP TABLE IF EXISTS `casas`;
CREATE TABLE `casas`  (
  `numero_casa` int NOT NULL,
  `direccion` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `valor` decimal(10, 2) NOT NULL,
  PRIMARY KEY (`numero_casa`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of casas
-- ----------------------------

-- ----------------------------
-- Table structure for censo_clap
-- ----------------------------
DROP TABLE IF EXISTS `censo_clap`;
CREATE TABLE `censo_clap`  (
  `censo_clap_id` int NOT NULL AUTO_INCREMENT,
  `familia_id` int NOT NULL,
  `cereales` tinyint(1) NOT NULL,
  `granos` tinyint(1) NOT NULL,
  `enlatados` tinyint(1) NOT NULL,
  `empaquetados` tinyint(1) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`censo_clap_id`) USING BTREE,
  INDEX `familia_id`(`familia_id` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of censo_clap
-- ----------------------------

-- ----------------------------
-- Table structure for censo_gas
-- ----------------------------
DROP TABLE IF EXISTS `censo_gas`;
CREATE TABLE `censo_gas`  (
  `censo_gas_id` int NOT NULL AUTO_INCREMENT,
  `gas_id` int NOT NULL,
  `familia_id` int NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `fecha` date NOT NULL,
  PRIMARY KEY (`censo_gas_id`) USING BTREE,
  INDEX `gas_id`(`gas_id` ASC) USING BTREE,
  INDEX `familia_id`(`familia_id` ASC) USING BTREE,
  CONSTRAINT `censo_gas_ibfk_1` FOREIGN KEY (`gas_id`) REFERENCES `gas` (`gas_id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `censo_gas_ibfk_2` FOREIGN KEY (`familia_id`) REFERENCES `familias` (`familia_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of censo_gas
-- ----------------------------

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config`  (
  `key` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `value` varchar(255) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`key`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('bgColor', '#aaaaaa');
INSERT INTO `config` VALUES ('favicon', 'favicon.png');
INSERT INTO `config` VALUES ('img', 'imagen.jpg');
INSERT INTO `config` VALUES ('logo', 'logo.png');

-- ----------------------------
-- Table structure for discapacitados
-- ----------------------------
DROP TABLE IF EXISTS `discapacitados`;
CREATE TABLE `discapacitados`  (
  `discapacitado_id` int NOT NULL,
  `posee_ayuda` tinyint(1) NOT NULL,
  `cedula` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `tipo_discapacidad_id` int NOT NULL,
  PRIMARY KEY (`discapacitado_id`) USING BTREE,
  INDEX `cedula`(`cedula` ASC) USING BTREE,
  INDEX `tipo_discapacidad_id`(`tipo_discapacidad_id` ASC) USING BTREE,
  CONSTRAINT `discapacitados_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `personas` (`cedula`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `discapacitados_ibfk_2` FOREIGN KEY (`tipo_discapacidad_id`) REFERENCES `tipo_discapacidad` (`tipo_discapacidad_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of discapacitados
-- ----------------------------

-- ----------------------------
-- Table structure for familias
-- ----------------------------
DROP TABLE IF EXISTS `familias`;
CREATE TABLE `familias`  (
  `familia_id` int NOT NULL COMMENT 'aqui va el numero de cedula del padre o madre de familia',
  `nombre_familia` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `numero_casa` int NOT NULL,
  PRIMARY KEY (`familia_id`) USING BTREE,
  INDEX `numero_casa`(`numero_casa` ASC) USING BTREE,
  CONSTRAINT `familias_ibfk_1` FOREIGN KEY (`numero_casa`) REFERENCES `casas` (`numero_casa`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of familias
-- ----------------------------

-- ----------------------------
-- Table structure for gas
-- ----------------------------
DROP TABLE IF EXISTS `gas`;
CREATE TABLE `gas`  (
  `gas_id` int NOT NULL AUTO_INCREMENT,
  `tipo` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `capacidad` decimal(4, 2) NOT NULL,
  `precio` decimal(5, 2) NOT NULL,
  PRIMARY KEY (`gas_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of gas
-- ----------------------------

-- ----------------------------
-- Table structure for persona_vacunada
-- ----------------------------
DROP TABLE IF EXISTS `persona_vacunada`;
CREATE TABLE `persona_vacunada`  (
  `cedula` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `vacuna_id` int NOT NULL,
  `dosis` int NOT NULL,
  `fecha` date NULL DEFAULT NULL,
  PRIMARY KEY (`cedula`, `vacuna_id`, `dosis`) USING BTREE,
  INDEX `vacuna_id`(`vacuna_id` ASC) USING BTREE,
  CONSTRAINT `persona_vacunada_ibfk_1` FOREIGN KEY (`cedula`) REFERENCES `personas` (`cedula`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `persona_vacunada_ibfk_2` FOREIGN KEY (`vacuna_id`) REFERENCES `vacunas` (`vacuna_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of persona_vacunada
-- ----------------------------

-- ----------------------------
-- Table structure for personas
-- ----------------------------
DROP TABLE IF EXISTS `personas`;
CREATE TABLE `personas`  (
  `cedula` varchar(10) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `nombres` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `edad` int NOT NULL,
  `es_jefe_familia` tinyint(1) NOT NULL,
  `familia_id` int NOT NULL,
  PRIMARY KEY (`cedula`) USING BTREE,
  INDEX `familia_id`(`familia_id` ASC) USING BTREE,
  CONSTRAINT `personas_ibfk_1` FOREIGN KEY (`familia_id`) REFERENCES `familias` (`familia_id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of personas
-- ----------------------------

-- ----------------------------
-- Table structure for tipo_discapacidad
-- ----------------------------
DROP TABLE IF EXISTS `tipo_discapacidad`;
CREATE TABLE `tipo_discapacidad`  (
  `tipo_discapacidad_id` int NOT NULL,
  `nombre_discapacidad` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tipo_discapacidad_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of tipo_discapacidad
-- ----------------------------
INSERT INTO `tipo_discapacidad` VALUES (1, 'Parálisis');
INSERT INTO `tipo_discapacidad` VALUES (2, 'Amputación');
INSERT INTO `tipo_discapacidad` VALUES (3, 'Espina bífida');
INSERT INTO `tipo_discapacidad` VALUES (4, 'Artritis');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `userName` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  `first_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `last_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_spanish_ci NULL DEFAULT NULL,
  `activo` enum('si','no') CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'si',
  `rol` varchar(20) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL DEFAULT 'user',
  PRIMARY KEY (`userName`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('admin12@pdg.com', '1234', 'fgghfg', 'hfgh', 'si', 'user');
INSERT INTO `users` VALUES ('admin2@pdg.com', 'aa', 'Eduardo', 'Carrasco', 'si', 'user');
INSERT INTO `users` VALUES ('carlos@gmail.com', '1234', NULL, NULL, 'si', 'user');

-- ----------------------------
-- Table structure for vacunas
-- ----------------------------
DROP TABLE IF EXISTS `vacunas`;
CREATE TABLE `vacunas`  (
  `vacuna_id` int NOT NULL,
  `nombre_vacuna` varchar(50) CHARACTER SET utf8 COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`vacuna_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_spanish_ci ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of vacunas
-- ----------------------------
INSERT INTO `vacunas` VALUES (1, 'Tetanos-difteria');
INSERT INTO `vacunas` VALUES (2, 'Triple Virica');
INSERT INTO `vacunas` VALUES (3, 'Hepatitis A');
INSERT INTO `vacunas` VALUES (4, 'Fiebre Amarilla');
INSERT INTO `vacunas` VALUES (5, 'Hepatitis B');
INSERT INTO `vacunas` VALUES (6, 'Rabia');
INSERT INTO `vacunas` VALUES (7, 'Tifoidea');
INSERT INTO `vacunas` VALUES (8, 'Gripe');
INSERT INTO `vacunas` VALUES (9, 'Neumococica');
INSERT INTO `vacunas` VALUES (10, 'Covid');

SET FOREIGN_KEY_CHECKS = 1;
