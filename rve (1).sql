-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-03-2016 a las 19:55:38
-- Versión del servidor: 5.6.17
-- Versión de PHP: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `rve`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `campana`
--

CREATE TABLE IF NOT EXISTS `campana` (
  `id_campana` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_campana`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `campana`
--

INSERT INTO `campana` (`id_campana`, `nombre`) VALUES
(1, 'Campaña autos'),
(2, 'Campaña 02'),
(3, 'Campaña aviones'),
(4, 'Campaña 04'),
(5, 'Campaña bicicletas'),
(6, 'Campaña 06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `exhibicion`
--

CREATE TABLE IF NOT EXISTS `exhibicion` (
  `id_exhibicion` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  PRIMARY KEY (`id_exhibicion`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Volcado de datos para la tabla `exhibicion`
--

INSERT INTO `exhibicion` (`id_exhibicion`, `nombre`) VALUES
(1, 'Exhibicion Sillas'),
(2, 'Exhibicion 02'),
(3, 'Exhibicion Muebles'),
(4, 'Exhibicion 04'),
(5, 'Exhibicion Lamparas'),
(6, 'Exhibicion 06');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `members`
--

CREATE TABLE IF NOT EXISTS `members` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(65) DEFAULT NULL,
  `password` varchar(65) DEFAULT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `tipo_user` varchar(20) DEFAULT NULL,
  `id_sala` int(3) DEFAULT NULL,
  `celular` varchar(50) DEFAULT NULL,
  `cargo` varchar(100) DEFAULT NULL,
  `anexo` varchar(50) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=142 ;

--
-- Volcado de datos para la tabla `members`
--

INSERT INTO `members` (`id`, `username`, `password`, `nombre`, `tipo_user`, `id_sala`, `celular`, `cargo`, `anexo`, `foto_perfil`) VALUES
(1, 'hugo.plaza@easy.cl', '389', 'Hugo Plaza Vilches', 'user', 1, '84671389', 'Jefe de Visual', '', NULL),
(2, 'alejandro.molina@easy.cl', '927', 'Alejandro Molina', 'user', 2, '78090927', 'Jefe de Visual', '', NULL),
(3, 'flor.opitz@easy.cl', '288', 'Flor Opitz', 'user', 3, '94421288', 'Jefe de Visual', '', NULL),
(4, 'tomas.gonzalez@easy.cl', '472', 'Tomas Gonzalez Venegas ', 'user', 4, '954460472', 'Jefe de Visual', '', NULL),
(5, 'carolina.ibarrasalgado@easy.cl', '380', 'Carolina Ibarra Salgado ', 'user', 5, '82219380', 'Jefe de Visual', '', NULL),
(6, 'oscar.saavedra@easy.cl', '736', 'Oscar Saavedra', 'user', 6, '985057736', 'Jefe de Visual', '', NULL),
(7, '', '', '', 'user', 7, '', 'Jefe de Visual', '', NULL),
(8, 'rudy.casas@easy.cl', '254', 'Rudy Casas Gonzalez', 'user', 8, '977462254', 'Jefe de Visual', '', NULL),
(9, '', '', '', 'user', 9, '', 'Jefe de Visual', '', NULL),
(10, '', '', '', 'user', 10, '', 'Jefe de Visual', '', NULL),
(11, '', '', '', 'user', 11, '', 'Jefe de Visual', '', NULL),
(12, 'josefa.osoriogodoy@easy.cl', '657', 'Josefa Osorio', 'user', 12, '91328657', 'Jefe de Visual', '', NULL),
(13, '', '', '', 'user', 13, '', 'Jefe de Visual', '', NULL),
(14, 'debora.montecinos@easy.cl', '777', 'Debora Montecinos', 'user', 14, '79459777', 'Jefe de Visual', '', NULL),
(15, 'nibaldo.duarte@easy.cl', '168', 'Nibaldo Duarte A.', 'user', 15, '997463168', 'Jefe de Visual', '', NULL),
(16, 'claudio.carrera@easy.cl', '281', 'Claudio Carrera', 'user', 16, '42412281', 'Jefe de Visual', '', NULL),
(17, 'fernando.moyano@easy.cl', '370', 'Fernando Moyano', 'user', 17, '97270370', 'Jefe de Visual', '', NULL),
(18, '', '', '', 'user', 18, '', 'Jefe de Visual', '', NULL),
(19, 'patricia.zambrano@easy.cl', '670', 'Patricia Zambrano', 'user', 19, '74321670', 'Jefe de Visual', '', NULL),
(20, 'alvaro.sandoval@easy.cl', '947', 'Alvaro Vega Sandoval', 'user', 20, '982118947', 'Jefe de Visual', '', NULL),
(21, 'patricio.yanez@easy.cl', '154', 'Patricio Yañez Cantero', 'user', 21, '966917154', 'Jefe de Visual', '', NULL),
(22, '', '', '', 'user', 22, '', 'Jefe de Visual', '', NULL),
(23, 'patricia.vallette@easy.cl', '640', 'Patricia Vallette', 'user', 23, '997290640', 'Jefe de Visual', '', NULL),
(24, 'alvaro.munoz@easy.cl', '354', 'Alvaro Muñoz', 'user', 24, '50961354', 'Jefe de Visual', '', NULL),
(25, 'veronica.garces@easy.cl', '505', 'Veronica Garces', 'user', 25, '988376505', 'Jefe de Visual', '', NULL),
(26, '', '', '', 'user', 26, '', 'Jefe de Visual', '', NULL),
(27, 'thiare.nunes@easy.cl', '461', 'Thyare Nuñez Matamoro', 'user', 27, '93367461', 'Jefe de Visual', '', NULL),
(28, 'mario.salgadoarriagda@easy.cl', '665', 'Mario Salgado A', 'user', 28, '998949665', 'Jefe de Visual', '', NULL),
(29, '', '', '', 'user', 29, '', 'Jefe de Visual', '', NULL),
(30, 'norma.correa@easy.cl', '419', 'Norma Correa', 'user', 30, '64566419', 'Jefe de Visual', '', NULL),
(31, 'miguel.smart@easy.cl', '828', 'Miguel Smart Diaz ', 'user', 31, '63034828', 'Jefe de Visual', '', NULL),
(32, 'sergio.gallardo@easy.cl', '301', 'Sergio Gallardo Farias', 'user', 32, '99999301', 'Jefe de Visual', '', NULL),
(33, 'patricio.galarce@easy.cl', '013', 'Patricio Galarce Macaya', 'user', 33, '999139013', 'Jefe de Visual', '', NULL),
(34, 'paula.escobar@easy.cl', '285', 'Paula Escobar ', 'user', 34, '94181285', 'Jefe de Visual', '', NULL),
(35, '', '', '', 'user', 35, '', '', '', NULL),
(36, 'consuelo.quezada@easy.cl', '538', 'Consuelo Quezada  Valenzuela', 'user', 1, '91034538', 'Publicista', '', NULL),
(37, 'hans.huapaya@easy.cl', '695', 'Hans Huapaya', 'user', 2, '59962695', 'Publicista', '', NULL),
(38, 'cristian.rojas@easy.cl', '516', 'Cristian Rojas', 'user', 3, '82443516', 'Publicista', '', NULL),
(39, 'grisel.araya@easy.cl', '761', 'Grisel Araya Caceres', 'user', 4, '957400761', 'Publicista', '', NULL),
(40, '', '', '', 'user', 5, '', 'Publicista', '', NULL),
(41, 'pablo.galdamesrebolledo@easy.cl', '300', 'Pablo Galdames', 'user', 6, '514 300', 'Publicista', '', NULL),
(42, 'victor.marin@easy.cl', '279', 'Victor Marin', 'user', 7, '64312279', 'Publicista', '', NULL),
(43, 'Carlos.Maturana@easy.cl', '123', 'Carlos Maturana Reyes', 'user', 8, '', 'Publicista', '', NULL),
(44, 'felipe.fuentes@easy.cl', '199', 'Felipe Fuentes Olave', 'user', 9, '986169199', 'Publicista', '', NULL),
(45, 'cristian.peralta@easy.cl', '312', 'Cristian Peralta Lucero', 'user', 10, '759312', 'Publicista', '', NULL),
(46, 'ricardo.roldanrequena@easy.cl', '312', 'Ricardo Roldan', 'user', 11, '743312', 'Publicista', '', NULL),
(47, 'miguel.pilarvelasquez@easy.cl', '735', 'Miguel Pilar', 'user', 12, '76876735', 'Publicista', '', NULL),
(48, 'elliette.guzman@easy.cl', '312', 'Elliette Guzman Caro', 'user', 13, '543312', 'Publicista', '', NULL),
(49, 'luis.padro@easy.cl', '596', 'Luis Ariel Prado ', 'user', 14, '72920596', 'Publicista', '', NULL),
(50, 'hector.antileo@easy.cl', '629', 'Hector Antileo A.', 'user', 15, '998409629', 'Publicista', '', NULL),
(51, '', '', '', 'user', 16, '', 'Publicista', '', NULL),
(52, 'mario.oliva@easy.cl', '094', 'Mario Oliva', 'user', 17, '98264094', 'Publicista', '', NULL),
(53, 'gonzalo.norambuenanorambuena@easy.cl', '091', 'Gonzalo Norambuena', 'user', 18, '99213091', 'Publicista', '', NULL),
(54, 'fernando.delgado@easy.cl', '500', 'Fernando Delgado', 'user', 19, '87334500', 'Publicista', '', NULL),
(55, 'karen.loyola@easy.cl', '674', 'Karen Loyola', 'user', 20, '973291674', 'Publicista', '', NULL),
(56, '', '', '', 'user', 21, '', 'Publicista', '', NULL),
(57, 'natalia.valenzuelaroa@easy.cl', '312', 'Natalia Valenzuela Roa', 'user', 22, '583312', 'Publicista', '', NULL),
(58, 'leonel.sotosegura@easy.cl', '957', 'Sebastian Soto', 'user', 23, '958236957', 'Publicista', '', NULL),
(59, 'javier.altamirano@easy.cl', '615', 'Javier Altamirano', 'user', 24, '63503615', 'Publicista', '', NULL),
(60, '', '', '', 'user', 25, '', 'Publicista', '', NULL),
(61, 'rodrigo.saavedra@easy.cl', '651', 'Rodrigo Saavedra', 'user', 26, '98958651', 'Publicista', '', NULL),
(62, 'gustavo.urtubia@easy.cl', '108', 'Gustavo Urtubia Torres', 'user', 27, '99769108', 'Publicista', '', NULL),
(63, 'francisco.moralesferruzola@easy.cl', '713', 'Francisco Morales F', 'user', 28, '61437713', 'Publicista', '', NULL),
(64, 'mauricio.robles@easy.cl', '553', 'Mauricio Robles Barra', 'user', 29, '997387553', 'Publicista', '', NULL),
(65, 'marcelo.lopez@easy.cl', '419', 'Marcelo Lopez C.', 'user', 30, '64566419', 'Publicista', '', NULL),
(66, 'cecilia.ortiz@easy.cl', '855', 'Cecilia Gomez Ortiz', 'user', 31, '93044855', 'Publicista', '', NULL),
(67, '', '', '', 'user', 32, '', 'Publicista', '', NULL),
(68, 'patricia.villagra@easy.cl', '312', 'Patricia Villagra Tapia', 'user', 33, '521312', 'Publicista', '', NULL),
(69, 'hernan.rodriguez@easy.cl', '265', 'Hernan Rodriguez', 'user', 34, '98085265', 'Publicista', '', NULL),
(70, 'jorge.chinchilla@easy.cl', '933', 'Jorge Yañez Chinchilla', 'user', 35, '69084933', 'Publicista', '', NULL),
(71, '', '', '', 'user', 1, '', 'Flejista', '', NULL),
(72, 'maria.vasquez.soto@easy.cl', '123', 'Maria Vasquez', 'user', 2, '', 'Flejista', '518326', NULL),
(73, 'leonel.sanmartin@easy.cl', '364', 'Leonel Serrano', 'user', 3, '96138364 / 503311', 'Flejista', '503311', NULL),
(74, 'elsa.chambe@cencosud.cl', '123', 'Elsa Chambe Lorca', 'user', 4, '', 'Flejista', '510312', NULL),
(75, 'juancarlos.reyes@easy.cl', '123', 'Juan Carlos Reyes Brito', 'user', 5, '', 'Flejista', '512335', NULL),
(76, 'Katherine.williams@easy.cl', '123', 'Katherine Williams ', 'user', 6, '', 'Flejista', '514320', NULL),
(77, 'marlene.rozas@easy.cl', '123', 'Marlene Rozas', 'user', 7, '', 'Flejista', '513312', NULL),
(78, 'Daniela.Flor@easy.cl', '123', 'Daniela Flores Vera', 'user', 8, '', 'Flejista', '522312', NULL),
(79, 'romina.diazochoa@easy.cl', '862', 'Romina Diaz Ochoa', 'user', 9, '954755862', 'Flejista', '655355', NULL),
(80, 'karen.munoz@easy.cl', '123', 'Karen Muñoz Lecaros', 'user', 10, '', 'Flejista', '759312', NULL),
(81, 'muriel.moraga.t@easy.cl', '123', 'Muriel Moraga', 'user', 11, '', 'Flejista', '743312', NULL),
(82, '', '793', 'Natalia Perez', 'user', 12, '61938793', 'Flejista', '511312', NULL),
(83, 'paulina.sanchezfarias@easy.cl', '123', 'Paulina Sanchez', 'user', 13, '', 'Flejista', '543312', NULL),
(84, 'iaacev@cencosud.corp', '123', 'Ines Alvarez ', 'user', 14, '', 'Flejista', '788312', NULL),
(85, 'brenda.zuniga@easy.cl', '092', 'Brenda Zuñiga Z.', 'user', 15, '972528092', 'Flejista', '777443', NULL),
(86, 'ricardo.correa@easy.cl', '110', 'Ricardo Correa', 'user', 16, '88340110', 'Flejista', '592312', NULL),
(87, 'francisco.espinoza@easy.cl', '192', 'Francisco Espinoza', 'user', 17, '978027192', 'Flejista', '591312', NULL),
(88, 'maria.freire@easy.cl', '123', 'Maria Alicia Freire', 'user', 18, '', 'Flejista', '724319', NULL),
(89, 'monica.manriquez@easy.cl', '123', 'Monica Manriquez', 'user', 19, '', 'Flejista', '525316', NULL),
(90, 'katherine.cifuentes@easy.cl', '999', 'Katherin Cifuentes', 'user', 20, '999966999', 'Flejista', '529306', NULL),
(91, 'olivia.figueroa@easy.cl', '854', 'Olivia Figueroa Quezada', 'user', 21, '961869854', 'Flejista', '733312', NULL),
(92, 'michael.navarrete@easy.cl', '123', 'Michael Navarrete', 'user', 22, '', 'Flejista', '583313', NULL),
(93, 'pefloresh@cencosud.cl', '950', 'Patricio Flores', 'user', 23, '989052950', 'Flejista', '517312', NULL),
(94, '', '', '', 'user', 24, '', 'Flejista', '585312', NULL),
(95, 'nancy.almonacid@easy.cl', '123', 'Nancy Almonacid ', 'user', 25, '', 'Flejista', '507312', NULL),
(96, 'pendiente', '518', ' Jonathan Fuentes', 'user', 26, '976938518', 'Flejista', '790317', NULL),
(97, 'carmen.vargas@easy.cl', '369', 'Carmen Vargas Lucero', 'user', 27, '982981369', 'Flejista', '700312', NULL),
(98, 'isabelluz.briones@easy.cl', '941', 'Isabel Briones C', 'user', 28, '984863941', 'Flejista', '508320', NULL),
(99, 'tamara.pimentel@easy.cl', '804', 'Tamara Pimentel Saavedra', 'user', 29, '987433804', 'Flejista', '646312', NULL),
(100, 'marcelo.ortiz@easy.cl', '123', 'Marcelo Ortiz G.', 'user', 30, '', 'Flejista', '520312', NULL),
(101, 'piscila.cortes@easy.cl', '123', 'Priscila Cortes Fernadez', 'user', 31, '', 'Flejista', '760312', NULL),
(102, 'katixa.delgado@easy.cl', '092', 'Katixa Delgado Borquez', 'user', 32, '942302092', 'Flejista', '534312', NULL),
(103, 'luis.gonzalezpalma@easy.cl', '123', 'Luis Gonzalez Palma', 'user', 33, '', 'Flejista', '521312', NULL),
(104, '', '', '', 'user', 34, '', 'Flejista', '', NULL),
(105, '', '', '', 'user', 35, '', 'Flejista', '', NULL),
(106, 'rodrigo.tobalina@easy.cl', '305', 'Rodrigo Tobalina', 'user', 1, '502305', 'Gerente', '', NULL),
(107, 'Douglas.Ribeiro@easy.cl', '', 'Douglas Ribeiro', 'user', 2, '', 'Gerente', '', NULL),
(108, 'uriel.hernandez@easy.com.ar', '529', 'Uriel Hernandez', 'user', 3, '992257529 / 503301', 'Gerente', '', NULL),
(109, 'rodrigo.escobar@easy.cl', '338', 'Rodrigo Escobar/Eduardo Salcedo', 'user', 4, '510338', 'Gerente', '', NULL),
(110, 'lorenzo.iacopetti@easy.cl', '737', 'Lorenzo Iacopetti', 'user', 5, '995465737', 'Gerente', '', NULL),
(111, 'jonathan.troncoso@easy.cl', '441', 'Jonathan Pacheco', 'user', 6, '992257441', 'Gerente', '', NULL),
(112, 'hector.romero@easy.cl', '618', 'Hector Romero', 'user', 7, '64313618', 'Gerente', '', NULL),
(113, 'miguel.pizarro@easy.cl', '928', 'Miguel Pizarro', 'user', 8, '991394928 / 522301', 'Gerente', '', NULL),
(114, 'rodrigo.lagos@easy.cl', '301', 'Rodrigo Lagos', 'user', 9, '25626301 / 94629998', 'Gerente', '', NULL),
(115, 'jorge.moya @easy.cl', '567', 'Jorge Moya Campos', 'user', 10, '94486567', 'Gerente', '', NULL),
(116, 'carlos.sanchez@easy.cl', '123', 'Carlos Sanchez', 'user', 11, '', 'Gerente', '', NULL),
(117, 'francisco.moralescuadra@easy.cl', '866', 'Francisco Morales', 'user', 12, '63062866', 'Gerente', '', NULL),
(118, 'fernando.calderon@easy.cl', '301', 'Fernando Calderon', 'user', 13, '543301', 'Gerente', '', NULL),
(119, 'pablo.aravena@easy.cl', '990', 'Pablo Aravena', 'user', 14, '92438990', 'Gerente', '', NULL),
(120, 'wagner.salinas@easy.cl', '123', 'Wagner Salinas O.', 'user', 15, '', 'Gerente', '', NULL),
(121, 'paulo.toro@easy.cl', '462', 'Paulo Toro', 'user', 16, '94434462', 'Gerente', '', NULL),
(122, 'german.bastidas@easy.cl', '301', 'German Bastidas', 'user', 17, '987752099 / 591301', 'Gerente', '', NULL),
(123, 'carlos.roca@easy.cl', '151', 'Carlos Roca Gonzalez', 'user', 18, '996430151', 'Gerente', '', NULL),
(124, 'luis.farfan@easy.cl', '123', 'Luis Farfan Arenas', 'user', 19, '', 'Gerente', '', NULL),
(125, 'jorge.lopez@easy.cl', '399', 'Jorge Lopez Soto', 'user', 20, '996457399', 'Gerente', '', NULL),
(126, 'frank.meza@easy.cl', '301', 'Frank Meza Lucic', 'user', 21, '733301', 'Gerente', '', NULL),
(127, 'cristian.nunez@easy.cl', '301', 'Cristian Nuñez Quezada', 'user', 22, '583301', 'Gerente', '', NULL),
(128, 'carlos.torres@easy.cl', '810', 'Carlos Torres Riquelme', 'user', 23, '992257810', 'Gerente', '', NULL),
(129, 'plinio.cerna@easy.cl', '438', 'Plinio Cerna ', 'user', 24, '94446438', 'Gerente', '', NULL),
(130, 'david.huenupe@easy.cl', '285', 'David Huenupe', 'user', 25, '985969285', 'Gerente', '', NULL),
(131, 'yuri.bastias@easy.cl', '636', 'Yuri Bastidas', 'user', 26, '956664636', 'Gerente', '', NULL),
(132, 'ingrid.venegas@easy.cl', '616', 'Ingrid Venegas Salazar', 'user', 27, '61207616', 'Gerente', '', NULL),
(133, 'daniel.fernandez@easy.cl', '141', 'Daniel Fernandez', 'user', 28, '996471141 / 508301', 'Gerente', '', NULL),
(134, 'Marcelo.estay@easy.cl', '980', 'Marcelo Estay', 'user', 29, '974799980', 'Gerente', '', NULL),
(135, 'pablo.diazmunoz@easy.cl', '301', 'Pablo Diaz', 'user', 30, '520301', 'Gerente', '', NULL),
(136, 'alberto.mansilla@easy.cl', '301', 'Alberto Mansilla', 'user', 31, '760301', 'Gerente', '', NULL),
(137, 'claudio.solavasquez@easy.cl', '739', 'Claudio Sola Vasquez', 'user', 32, '993208739', 'Gerente', '', NULL),
(138, 'oscar.jaramillo@easy.cl', '123', 'Osca Jaramillo Novoa', 'user', 33, '992276007', 'Gerente', '', NULL),
(139, 'felipe.arancibia@easy.cl', '800', 'Felipe Arancibia', 'user', 34, '547800', 'Gerente', '', NULL),
(140, 'carlos.krugger@easy.cl', '123', 'Carlos Krugger Silva', 'user', 35, '', 'Gerente', '', NULL),
(141, 'lsaez@pm.cl', '123', 'Luis Saez', 'user', 1, '951165236', 'Gerente', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE IF NOT EXISTS `registro` (
  `id_registro` int(11) NOT NULL AUTO_INCREMENT,
  `id_member` int(4) NOT NULL,
  `id_supervisor` int(4) DEFAULT NULL,
  `id_sala` int(4) NOT NULL,
  `id_campana` int(4) DEFAULT NULL,
  `id_exhibicion` int(4) DEFAULT NULL,
  `nombre_foto` varchar(100) NOT NULL,
  `fecha` timestamp NOT NULL,
  `comentario` varchar(400) DEFAULT NULL,
  PRIMARY KEY (`id_registro`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Volcado de datos para la tabla `registro`
--

INSERT INTO `registro` (`id_registro`, `id_member`, `id_supervisor`, `id_sala`, `id_campana`, `id_exhibicion`, `nombre_foto`, `fecha`, `comentario`) VALUES
(1, 141, NULL, 1, 1, 0, '56e5e8a616ca9auto01.jpg', '2016-03-13 22:24:38', 'auto rapido gris test 5'),
(2, 141, NULL, 1, 1, 0, '56e5e8aeae499auto02.jpg', '2016-03-13 22:24:46', '2do auto descapotable'),
(3, 141, NULL, 1, 1, 0, '56e5e8b69cfbcauto03.jpg', '2016-03-13 22:24:54', '3er auto, rojo...'),
(4, 2, NULL, 2, 3, 0, '56e5e8d968a4aavion01.jpg', '2016-03-13 22:25:29', 'avion blanco'),
(5, 2, NULL, 2, 3, 0, '56e5e8e0429ebavion02.jpg', '2016-03-13 22:25:36', NULL),
(6, 2, NULL, 2, 3, 0, '56e5e8e6bbf8davion03.jpg', '2016-03-13 22:25:42', NULL),
(7, 3, NULL, 3, 5, 0, '56e5e8fd27c6abici01.jpg', '2016-03-13 22:26:05', '1ra bicicleta'),
(8, 3, NULL, 3, 5, 0, '56e5e903b4d14bici02.jpg', '2016-03-13 22:26:11', NULL),
(9, 3, NULL, 3, 5, 0, '56e5e90af101cbici03.jpg', '2016-03-13 22:26:18', NULL),
(10, 5, NULL, 5, 1, 0, '56e5f35749b14auto04.jpg', '2016-03-13 23:10:15', 'auto blanco'),
(11, 5, NULL, 5, 1, 0, '56e5f35f92802auto05.jpg', '2016-03-13 23:10:23', 'auto muscle'),
(12, 141, NULL, 1, 0, 1, '56e6bd36ee2e2silla01.jpg', '2016-03-14 13:31:34', NULL),
(13, 141, NULL, 1, 0, 1, '56e6bd3cb7544silla02.jpg', '2016-03-14 13:31:40', NULL),
(14, 141, NULL, 1, 0, 1, '56e6bd4224eb9silla03.jpg', '2016-03-14 13:31:46', NULL),
(15, 2, NULL, 2, 0, 3, '56e6bd5b7ab93mueble01.jpg', '2016-03-14 13:32:11', NULL),
(16, 2, NULL, 2, 0, 3, '56e6bd5f848bamueble02.jpg', '2016-03-14 13:32:15', NULL),
(17, 2, NULL, 2, 0, 3, '56e6bd63c702fmueble03.jpg', '2016-03-14 13:32:19', NULL),
(18, 3, NULL, 3, 0, 5, '56e6bd7eb8fbclampara01.jpg', '2016-03-14 13:32:46', NULL),
(19, 3, NULL, 3, 0, 5, '56e6bd82d4627lampara02.jpg', '2016-03-14 13:32:50', NULL),
(20, 3, NULL, 3, 0, 5, '56e6bd86ed969lampara03.jpg', '2016-03-14 13:32:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sala`
--

CREATE TABLE IF NOT EXISTS `sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_sala` varchar(50) NOT NULL,
  PRIMARY KEY (`id_sala`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Volcado de datos para la tabla `sala`
--

INSERT INTO `sala` (`id_sala`, `nombre_sala`) VALUES
(1, 'Alto Las Condes'),
(2, 'Quilin'),
(3, 'Maipú'),
(4, 'La Florida'),
(5, 'La Reina'),
(6, 'La Dehesa'),
(7, 'El Llano'),
(8, 'Fisa'),
(9, 'Quilicura'),
(10, 'Puente Alto'),
(11, 'Ochagavia'),
(12, 'Costanera '),
(13, 'San Bernardo'),
(14, 'Chicureo'),
(15, 'Sur'),
(16, 'Rancagua'),
(17, 'Curicó'),
(18, 'Talca'),
(19, 'Linares'),
(20, 'Chillan'),
(21, 'Los Angeles'),
(22, 'Bio Bio'),
(23, 'Coronel'),
(24, 'Temuco'),
(25, 'Osorno'),
(26, 'Pto. Montt'),
(27, 'Chiguayante'),
(28, 'Norte'),
(29, 'Los Andes'),
(30, 'Viña Del Mar'),
(31, 'Quillota'),
(32, 'Valparaiso'),
(33, 'Copiapo'),
(34, 'Antofagasta'),
(35, 'La Serena'),
(36, 'El Belloto'),
(37, 'Calama');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `supervisor`
--

CREATE TABLE IF NOT EXISTS `supervisor` (
  `id_supervisor` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nombre` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `area` varchar(20) NOT NULL,
  PRIMARY KEY (`id_supervisor`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `supervisor`
--

INSERT INTO `supervisor` (`id_supervisor`, `username`, `password`, `nombre`, `email`, `foto_perfil`, `area`) VALUES
(1, 'vi', '123', 'Luis Saez', 'lsaez@pm.cl', 'user.png', 'visual'),
(2, 'ex', '123', 'Prueba Proveedor', 'prueba@test.cl', 'user.png', 'exhibicion');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
