-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-09-2021 a las 22:33:25
-- Versión del servidor: 10.4.8-MariaDB
-- Versión de PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `intelcost_bienes`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `listbienes` ()  READS SQL DATA
    COMMENT 'Procedimiento que lista los bienes'
BEGIN
   select id, direccion, ciudad,telefono, codigo_postal,tipo, precio, idbien
   from inmueble
   order by id;
END$$

--
-- Funciones
--
CREATE DEFINER=`root`@`localhost` FUNCTION `deletebien` (`vid` INT) RETURNS INT(1) READS SQL DATA
    DETERMINISTIC
    COMMENT 'Funcion que elimina un Bien'
BEGIN 
    DECLARE res INT DEFAULT 0;
    DELETE FROM inmueble WHERE idbien = vid;
SET res = 1;
	RETURN res;
END$$

CREATE DEFINER=`root`@`localhost` FUNCTION `savebien` (`vid` INT(4), `vdireccion` VARCHAR(100), `vciudad` VARCHAR(50), `vtelefono` VARCHAR(50), `vcodigo_postal` VARCHAR(50), `vtipo` VARCHAR(50), `vprecio` VARCHAR(50), `vidbien` INT(4)) RETURNS INT(1) READS SQL DATA
    DETERMINISTIC
    COMMENT '	 Funcion que almacena un Bien'
BEGIN 
    DECLARE res INT DEFAULT 0;
    
IF NOT EXISTS(select idbien from inmueble where idbien=vidbien)
		THEN
			insert into inmueble(direccion,ciudad,telefono,codigo_postal,tipo,precio,idbien)
			VALUES (vdireccion,vciudad,vtelefono,vcodigo_postal,vtipo,vprecio,vidbien);
			set res = 1;
		END IF;
RETURN res;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inmueble`
--

CREATE TABLE `inmueble` (
  `id` int(4) UNSIGNED NOT NULL,
  `direccion` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `ciudad` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `codigo_postal` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `tipo` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `precio` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `idbien` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `inmueble`
--

INSERT INTO `inmueble` (`id`, `direccion`, `ciudad`, `telefono`, `codigo_postal`, `tipo`, `precio`, `idbien`) VALUES
(2, '347-866 Laoreet Road', 'Los Angeles', '997-640-8188', '94526-134', 'Casa de Campo', '$16,048', 4),
(3, 'P.O. Box 497, 8679 Turpis. St.', 'New York', '870-559-3430', '7029', 'Casa', '$17,759', 10),
(4, 'P.O. Box 847, 2589 In Av.', 'Washington', '390-713-8687', '70689', 'Apartamento', '$60,951', 8),
(5, 'P.O. Box 432, 4652 Proin Ave', 'Washington', '113-637-2816', '598072', 'Casa', '$42,804', 100),
(6, 'Ap #549-7395 Ut Rd.', 'New York', '334-052-0954', '85328', 'Casa', '$30,746', 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `inmueble`
--
ALTER TABLE `inmueble`
  MODIFY `id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
