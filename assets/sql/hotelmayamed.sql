--
-- Archivo SQL de la base de datos del hotel mayamed
--

--CREACIÓN DE LA BASE
CREATE DATABASE IF NOT EXISTS `hotelmayamed`;
USE `hotelmayamed`;

--CREACIÓN DE LA TABLA DE RESERVACIÓN
CREATE TABLE IF NOT EXISTS `t_reservacion` (
  `id_res` int(11) NOT NULL,
  `nom` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `email` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_hab` longtext COLLATE utf8_spanish_ci NOT NULL,
  `personas` int(2) NOT NULL,
  `checkin` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `checkout` char(10) COLLATE utf8_spanish_ci NOT NULL,
  `fecha_res` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `hora_res` varchar(10) COLLATE utf8_spanish_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--p
ALTER TABLE `t_reservacion`
  ADD PRIMARY KEY (`id_res`);

