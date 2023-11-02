-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 02-11-2023 a las 03:50:57
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `juanda`
--
drop database if exists juanDa;
CREATE DATABASE juanDa;
use juanDa;
DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `d_usr` (IN `id` INT)   BEGIN 
	DELETE FROM per WHERE per_id = (SELECT per_id FROM usr WHERE usr_id = id);
    DELETE from usr where usr_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `i_client` (IN `name` VARCHAR(80), IN `lastName` VARCHAR(80), IN `date` DATE, IN `sex` INT, IN `tyDoc` INT, IN `doc` DOUBLE, IN `usrName` VARCHAR(80), IN `ema` VARCHAR(80), IN `tel` DOUBLE, IN `pass` VARCHAR(60), IN `addr` VARCHAR(80))   BEGIN
        DECLARE idPer INT;

        INSERT INTO `per`(`per_nm`, `per_ltnm`, `per_bithDt`, `sex_id`, `tyDoc_id`, `per_doc`, `per_addr`) VALUES
        (`name`, lastName, `date`, sex, tyDoc, doc, addr);
        SET idPer = LAST_INSERT_ID();
        
        INSERT INTO `usr` 
        (`usr_nm`, `usr_ema`, `usr_tel`, `usr_pass`, `rol_id`, `per_id`, `sta_id`)  
        VALUES (usrName, ema, tel, `pass`, 2, idPer, 1);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `i_rol` (IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
	INSERT INTO `rol`(`rol_nm`, `rol_dsc`) VALUES (name,dsc);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `i_sex` (IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
	INSERT INTO `sex`(`sex_nm`, `sex_dsc`) VALUES (`name`,dsc);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `i_sta` (IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
	INSERT INTO sta VALUES (NULL,`name`,dsc);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `i_tyDoc` (IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
	INSERT INTO `tydoc`(`tyDoc_nm`, `tyDoc_dsc`) VALUES (`name`,dsc);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `login` (IN `typeData` VARCHAR(8), IN `data` VARCHAR(80))   BEGIN
    SELECT U.usr_id, U.usr_pass, U.rol_id, S.sta_id, S.sta_nm FROM usr U INNER JOIN sta S ON U.sta_id = S.sta_id
WHERE
    CASE typeData 
        WHEN 'usr_nm' THEN U.usr_nm
        WHEN 'usr_ema' THEN U.usr_ema
        WHEN 'usr_tel' THEN U.usr_tel
    END = `data`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_rol` (IN `id` INT, IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
    UPDATE rol SET `rol_nm` = name, `rol_dsc` = dsc WHERE rol_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_sex` (IN `id` INT, IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
    UPDATE `sex` SET `sex_nm` = `name`, `sex_dsc` = dsc WHERE `sex_id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_sta` (IN `id` INT, IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN
	UPDATE `sta` SET `sta_nm` = `name`, `sta_dsc` = dsc WHERE `sta_id` = id;
    
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_tyDoc` (IN `id` INT, IN `name` VARCHAR(40), IN `dsc` TEXT)   BEGIN 
	UPDATE `tydoc` SET `tyDoc_nm`= `name`,`tyDoc_dsc`=dsc WHERE `tyDoc_id` = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_usr` (IN `id` INT, IN `name` VARCHAR(80), IN `lastName` VARCHAR(80), IN `date` DATE, IN `sex` INT, IN `tyDoc` INT, IN `doc` DOUBLE, IN `addr` VARCHAR(80), IN `usrName` VARCHAR(80), IN `ema` VARCHAR(80), IN `tel` DOUBLE, IN `pass` VARCHAR(60), IN `sta` INT)   BEGIN
    UPDATE `usr`
    INNER JOIN `per` ON `usr`.`per_id` = `per`.`per_id`
    SET `usr`.`usr_nm` = `usrName`, `usr`.`usr_ema` = `ema`, `usr`.`usr_tel` = `tel`, `usr`.`usr_pass` = `pass`, `usr`.`sta_id` = `sta`,`per`.`per_nm` = `name`,`per`.`per_ltnm` = `lastName`,`per`.`sex_id` = `sex`,`per`.`tyDoc_id` = `tyDoc`,`per`.`per_doc` = `doc`,`per`.`per_bithDt` = `date`, `per`.`per_addr` = `addr`
    WHERE `usr`.`usr_id` = `id` AND `per`.`per_id` = `id`;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `u_usr_sta` (IN `id` INT, IN `sta` INT)   BEGIN
	UPDATE `usr` SET `sta_id`= sta WHERE usr_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_per` (IN `id` INT)   BEGIN
	SELECT U.usr_id, P.per_nm, P.per_ltnm, P.per_bithdt, P.sex_id, E.sex_nm, E.sex_dsc, P.tyDoc_id, T.tyDoc_nm, T.tyDoc_dsc, P.per_doc, P.per_addr FROM usr U 
    INNER JOIN per P ON U.per_id = P.per_id
    INNER JOIN sex E ON P.sex_id = E.sex_id
    INNER JOIN tyDoc T ON P.tyDoc_id = T.tyDoc_id
    WHERE U.usr_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_pro` (IN `id` INT)   BEGIN
	SELECT * FROM pro P WHERE P.pro_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_pros` ()   BEGIN
	SELECT * FROM pro P;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_pros_sta` (IN `sta` INT)   BEGIN
	SELECT * FROM pro P WHERE P.sta_id = sta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_rol` (IN `id` INT)   BEGIN 
	SELECT * FROM rol WHERE rol_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_rols` ()   BEGIN 
	SELECT * FROM rol;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_sex` (IN `id` INT)   BEGIN 
SELECT * FROM sex where sex_id = id; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_sexs` ()   BEGIN
	SELECT * FROM sex;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_sta` (IN `id` INT)   BEGIN
	SELECT * FROM sta where sta_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_stas` ()   BEGIN 
	SELECT*from sta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_tyDoc` (IN `id` INT)   BEGIN 
SELECT * FROM tydoc where tydoc_id = id; END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_tyDocs` ()   BEGIN
	SELECT * FROM tyDoc;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_usr` (IN `id` INT)   BEGIN
	SELECT U.usr_id, U.usr_nm, U.usr_ema, U.usr_tel, U.usr_pass, U.rol_id, R.rol_nm, R.rol_dsc, U.per_id, P.per_nm, P.per_ltnm, P.per_bithdt, P.sex_id, E.sex_nm, E.sex_dsc, P.tyDoc_id, T.tyDoc_nm, T.tyDoc_dsc, P.per_doc, P.per_addr, U.sta_id, S.sta_nm, S.sta_dsc 
    FROM usr U INNER JOIN per P ON U.per_id = P.per_id
    INNER JOIN rol R ON U.rol_id = R.rol_id
    INNER JOIN sta S ON U.sta_id = S.sta_id
    INNER JOIN sex E ON P.sex_id = E.sex_id
    INNER JOIN tyDoc T ON P.tyDoc_id = T.tyDoc_id
    WHERE U.usr_id = id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_usrs` ()   BEGIN
	SELECT U.usr_id, U.usr_nm, U.usr_ema, U.usr_tel, U.usr_pass, U.rol_id, R.rol_nm, R.rol_dsc, U.per_id, P.per_nm, P.per_ltnm, P.per_bithdt, P.sex_id, E.sex_nm, E.sex_dsc, P.tyDoc_id, T.tyDoc_nm, T.tyDoc_dsc, P.per_doc, P.per_addr, U.sta_id, S.sta_nm, S.sta_dsc 
    FROM usr U INNER JOIN per P ON U.per_id = P.per_id
    INNER JOIN rol R ON U.rol_id = R.rol_id
    INNER JOIN sta S ON U.sta_id = S.sta_id
    INNER JOIN sex E ON P.sex_id = E.sex_id
    INNER JOIN tyDoc T ON P.tyDoc_id = T.tyDoc_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_usrs_sta` (IN `sta` INT)   BEGIN
	SELECT U.usr_id, U.usr_nm, U.usr_ema, U.usr_tel, U.usr_pass, U.rol_id, R.rol_nm, R.rol_dsc, U.per_id, P.per_nm, P.per_ltnm, P.per_bithdt, P.sex_id, E.sex_nm, E.sex_dsc, P.tyDoc_id, T.tyDoc_nm, T.tyDoc_dsc, P.per_doc, P.per_addr, U.sta_id, S.sta_nm, S.sta_dsc 
    FROM usr U INNER JOIN per P ON U.per_id = P.per_id
    INNER JOIN rol R ON U.rol_id = R.rol_id
    INNER JOIN sta S ON U.sta_id = S.sta_id
    INNER JOIN sex E ON P.sex_id = E.sex_id
    INNER JOIN tyDoc T ON P.tyDoc_id = T.tyDoc_id
    WHERE U.sta_id = sta;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `v_usr_sta` (IN `id` INT, IN `sta` INT)   BEGIN
	SELECT U.usr_id, U.usr_nm, U.usr_ema, U.usr_tel, U.usr_pass, U.rol_id, R.rol_nm, R.rol_dsc, U.per_id, P.per_nm, P.per_ltnm, P.per_bithdt, P.sex_id, E.sex_nm, E.sex_dsc, P.tyDoc_id, T.tyDoc_nm, T.tyDoc_dsc, P.per_doc, P.per_addr, U.sta_id, S.sta_nm, S.sta_dsc 
    FROM usr U INNER JOIN per P ON U.per_id = P.per_id
    INNER JOIN rol R ON U.rol_id = R.rol_id
    INNER JOIN sta S ON U.sta_id = S.sta_id
    INNER JOIN sex E ON P.sex_id = E.sex_id
    INNER JOIN tyDoc T ON P.tyDoc_id = T.tyDoc_id
    WHERE U.usr_id = id AND U.sta_id = sta;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `per`
--

CREATE TABLE `per` (
  `per_id` int(11) NOT NULL,
  `per_nm` varchar(80) NOT NULL,
  `per_ltnm` varchar(80) NOT NULL,
  `per_bithdt` date DEFAULT NULL,
  `sex_id` int(11) NOT NULL,
  `tyDoc_id` int(11) NOT NULL,
  `per_doc` double NOT NULL,
  `per_addr` varchar(90) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `per`
--

INSERT INTO `per` (`per_id`, `per_nm`, `per_ltnm`, `per_bithdt`, `sex_id`, `tyDoc_id`, `per_doc`, `per_addr`) VALUES
(1, 'asdfdsaf', 'JAramillo', '2023-11-28', 3, 2, 123123, 'call#sapoxd'),
(4, 'Juan', 'Carlo', '2023-11-30', 2, 1, 12313, '123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pro`
--

CREATE TABLE `pro` (
  `pro_id` int(11) NOT NULL,
  `tyPro_id` int(11) DEFAULT NULL,
  `pro_nm` varchar(80) DEFAULT NULL,
  `pro_code` varchar(20) DEFAULT NULL,
  `pro_dsc` text DEFAULT NULL,
  `pro_img` text DEFAULT NULL,
  `pro_cost` double DEFAULT NULL,
  `sta_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pro`
--

INSERT INTO `pro` (`pro_id`, `tyPro_id`, `pro_nm`, `pro_code`, `pro_dsc`, `pro_img`, `pro_cost`, `sta_id`) VALUES
(1, 1, 'Hamburguesa magnum', 'CO_003', 'Una hamburguesa extra especial mas grande de lo habitual', 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/62/NCI_Visuals_Food_Hamburger.jpg/640px-NCI_Visuals_Food_Hamburger.jpg', 50000, 1),
(2, 1, 'Salchipapa', 'CO_004', 'Un salchipapas clasico para disfrutas', 'https://www.comedera.com/wp-content/uploads/2021/07/salchipapas.jpg', 15000, 1),
(3, 1, 'Pizza', 'CO_005', 'Una pizza perfecta para una persona', 'https://www.laespanolaaceites.com/wp-content/uploads/2019/06/pizza-con-chorizo-jamon-y-queso-1080x671.jpg', 25000, 1),
(4, 1, 'Pizza Familiar', 'CO_006', 'Una pizza perfecta para una Familia q se ama', 'https://www.laespanolaaceites.com/wp-content/uploads/2019/06/pizza-con-chorizo-jamon-y-queso-1080x671.jpg', 25000, 1),
(5, 1, 'Perro Caliente', 'CO_001', 'Un perro caliente rico y listo para comer', 'https://images-gmi-pmc.edge-generalmills.com/f5a517df-12c8-4d55-aa70-c882d99122e0.jpg', 45000, 1),
(6, 1, 'Coca-Cola', 'CO_002', 'Una Coca-Cola fria lista para un dia de calor', 'https://i0.wp.com/tucochinito.com/wp-content/uploads/2019/07/Coca-de-vidrio.jpg', 45000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nm` varchar(40) NOT NULL,
  `rol_dsc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nm`, `rol_dsc`) VALUES
(1, 'Administrador', 'Es la persona que está a cargo de la tienda y se encarga de tomar las decisiones importantes, como el inventario, el marketing y el personal.'),
(2, 'Cliente', 'Es la persona que visita la tienda para comprar productos o servicios.'),
(3, 'Guest', 'Este es un invitado (usuario no registrado)');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sex`
--

CREATE TABLE `sex` (
  `sex_id` int(11) NOT NULL,
  `sex_nm` varchar(40) NOT NULL,
  `sex_dsc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sex`
--

INSERT INTO `sex` (`sex_id`, `sex_nm`, `sex_dsc`) VALUES
(1, 'Masculino', 'Se identifica con las características sociales, culturales y psicológicas asociadas a los hombres.'),
(2, 'Femenino', 'Se identifica con las características sociales, culturales y psicológicas asociadas a las mujeres.'),
(3, 'No binario', 'No se identifica con ninguno de los géneros binarios, masculino o femenino.'),
(4, 'Intergénero', 'Se identifica con una combinación de características de ambos géneros binarios, masculino o femenino.'),
(5, 'Género fluido', 'Su identidad de género cambia con el tiempo.'),
(6, 'Agénero', 'No se identifica con ningún género.'),
(7, 'Bigénero', 'Se identifica con dos géneros, masculino y femenino.'),
(8, 'Poligénero', 'Se identifica con tres o más géneros.'),
(9, 'Demigénero', 'Se identifica parcialmente con un género, pero no completamente.'),
(10, 'Genderqueer', 'Se identifica con un género que no se ajusta a las normas sociales tradicionales.'),
(11, 'Ninguno de los anteriores', 'Escribe con que género te identificas que no corresponda a los que están en el formulario');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sta`
--

CREATE TABLE `sta` (
  `sta_id` int(11) NOT NULL,
  `sta_nm` varchar(40) NOT NULL,
  `sta_dsc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sta`
--

INSERT INTO `sta` (`sta_id`, `sta_nm`, `sta_dsc`) VALUES
(1, 'Activo', 'Este estado respecta a un usuario o servicio activo en la plataforma'),
(2, 'Inactivo', 'Este estado respecta a un usuario o servicio inactivo en la plataforma'),
(3, 'Por confirmar', 'Este estado respecta a un usuario o servicio en proceso de ser activado en la plataforma ya que requiere de un proceso para este mismo'),
(4, 'inhabilitado', 'Se \"Elimino\" el registro.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tydoc`
--

CREATE TABLE `tydoc` (
  `tyDoc_id` int(11) NOT NULL,
  `tyDoc_nm` varchar(40) NOT NULL,
  `tyDoc_dsc` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tydoc`
--

INSERT INTO `tydoc` (`tyDoc_id`, `tyDoc_nm`, `tyDoc_dsc`) VALUES
(1, 'Registro civil de nacimiento', 'Es un documento público que acredita la filiación de una persona. Es expedido por la Registraduría Nacional del Estado Civil, y contiene la información personal de la persona, como su nombre completo, fecha y lugar de nacimiento, sexo, filiación y nacionalidad.'),
(2, 'Tarjeta de identidad', 'Es un documento público que identifica a las personas menores de edad de 7 a 17 años. Es expedido por la Registraduría Nacional del Estado Civil, y contiene la información personal de la persona, como su nombre completo, fecha y lugar de nacimiento, sexo, filiación, huella dactilar y grupo sanguíneo.'),
(3, 'Cédula de ciudadanía', 'Es un documento público que identifica a las personas mayores de edad. Es expedido por la Registraduría Nacional del Estado Civil, y contiene la información personal de la persona, como su nombre completo, fecha y lugar de nacimiento, sexo, filiación, huella dactilar, grupo sanguíneo y número de identificación personal (NIP).'),
(4, 'Tarjeta de extranjería', 'Es un documento público que identifica a los extranjeros residentes en Colombia. Es expedido por la Unidad Administrativa Especial Migración Colombia, y contiene la información personal del extranjero, como su nombre completo, fecha y lugar de nacimiento, nacionalidad, documento de identidad extranjero y número de identificación de extranjería (NIE).'),
(5, 'Pasaporte', 'Es un documento público que permite a los ciudadanos colombianos viajar al exterior. Es expedido por la Unidad Administrativa Especial Migración Colombia, y contiene la información personal del titular, como su nombre completo, fecha y lugar de nacimiento, nacionalidad, foto, firma y número de pasaporte.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `typro`
--

CREATE TABLE `typro` (
  `tyPro_id` int(11) NOT NULL,
  `tyPro_nm` varchar(40) DEFAULT NULL,
  `tyPro_dsc` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `typro`
--

INSERT INTO `typro` (`tyPro_id`, `tyPro_nm`, `tyPro_dsc`) VALUES
(1, 'Construction', 'Construction'),
(2, 'Home', 'Home'),
(3, 'Technology', 'Technology');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usr`
--

CREATE TABLE `usr` (
  `usr_id` int(11) NOT NULL,
  `usr_nm` varchar(80) NOT NULL,
  `usr_ema` varchar(80) NOT NULL,
  `usr_tel` double NOT NULL,
  `usr_pass` varchar(60) NOT NULL,
  `rol_id` int(11) NOT NULL,
  `per_id` int(11) NOT NULL,
  `sta_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usr`
--

INSERT INTO `usr` (`usr_id`, `usr_nm`, `usr_ema`, `usr_tel`, `usr_pass`, `rol_id`, `per_id`, `sta_id`) VALUES
(1, 'armadillo', 'admin@gmail.com', 3054102953, '$2y$10$.iuDlEJQKUYWCQzDIJ2yaOLVk01eoCqr7GiQv8LLuJBRsjLCkjo12', 1, 1, 1),
(3, 'Juan', 'hola@gmail.com', 1231241, '$2y$10$E.b5IpPJzycBimdGZyu6yuuI./sbevxAe7iMLYP/WyZleyObOX3I.', 2, 4, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `per`
--
ALTER TABLE `per`
  ADD PRIMARY KEY (`per_id`),
  ADD UNIQUE KEY `per_doc` (`per_doc`),
  ADD KEY `tyDoc_id` (`tyDoc_id`,`sex_id`),
  ADD KEY `sex_idPK_per` (`sex_id`);

--
-- Indices de la tabla `pro`
--
ALTER TABLE `pro`
  ADD PRIMARY KEY (`pro_id`),
  ADD UNIQUE KEY `por_code` (`pro_code`),
  ADD KEY `tyPro_id` (`tyPro_id`,`sta_id`),
  ADD KEY `sta_idPk_pro` (`sta_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `sex`
--
ALTER TABLE `sex`
  ADD PRIMARY KEY (`sex_id`);

--
-- Indices de la tabla `sta`
--
ALTER TABLE `sta`
  ADD PRIMARY KEY (`sta_id`);

--
-- Indices de la tabla `tydoc`
--
ALTER TABLE `tydoc`
  ADD PRIMARY KEY (`tyDoc_id`);

--
-- Indices de la tabla `typro`
--
ALTER TABLE `typro`
  ADD PRIMARY KEY (`tyPro_id`);

--
-- Indices de la tabla `usr`
--
ALTER TABLE `usr`
  ADD PRIMARY KEY (`usr_id`),
  ADD UNIQUE KEY `usr_nm` (`usr_nm`,`usr_ema`,`usr_tel`,`per_id`),
  ADD UNIQUE KEY `usr_nm_2` (`usr_nm`,`usr_ema`,`usr_tel`),
  ADD UNIQUE KEY `usr_nm_3` (`usr_nm`,`usr_ema`,`usr_tel`),
  ADD KEY `per_id` (`per_id`,`rol_id`,`sta_id`),
  ADD KEY `rol_idPK_usr` (`rol_id`),
  ADD KEY `sta_idPK_usr` (`sta_id`),
  ADD KEY `per_idPk_usr` (`per_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `per`
--
ALTER TABLE `per`
  MODIFY `per_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `pro`
--
ALTER TABLE `pro`
  MODIFY `pro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `sex`
--
ALTER TABLE `sex`
  MODIFY `sex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `sta`
--
ALTER TABLE `sta`
  MODIFY `sta_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `tydoc`
--
ALTER TABLE `tydoc`
  MODIFY `tyDoc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `typro`
--
ALTER TABLE `typro`
  MODIFY `tyPro_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usr`
--
ALTER TABLE `usr`
  MODIFY `usr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `per`
--
ALTER TABLE `per`
  ADD CONSTRAINT `sex_idPK_per` FOREIGN KEY (`sex_id`) REFERENCES `sex` (`sex_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tyDoc_idPK_per` FOREIGN KEY (`tyDoc_id`) REFERENCES `tydoc` (`tyDoc_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pro`
--
ALTER TABLE `pro`
  ADD CONSTRAINT `sta_idPk_pro` FOREIGN KEY (`sta_id`) REFERENCES `sta` (`sta_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tyPro_idPk_pro` FOREIGN KEY (`tyPro_id`) REFERENCES `typro` (`tyPro_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usr`
--
ALTER TABLE `usr`
  ADD CONSTRAINT `per_idPK_usr` FOREIGN KEY (`per_id`) REFERENCES `per` (`per_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rol_idPK_usr` FOREIGN KEY (`rol_id`) REFERENCES `rol` (`rol_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sta_idPK_usr` FOREIGN KEY (`sta_id`) REFERENCES `sta` (`sta_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
