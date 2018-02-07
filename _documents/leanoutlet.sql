-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-02-2018 a las 20:19:18
-- Versión del servidor: 10.1.28-MariaDB
-- Versión de PHP: 7.1.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `leanoutlet`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `articulo`
--

CREATE TABLE `articulo` (
  `id_articulo` int(11) NOT NULL,
  `titulo` varchar(128) NOT NULL,
  `id_tags` varchar(200) NOT NULL,
  `fecha` varchar(200) NOT NULL,
  `contenido` text,
  `urlv` varchar(128) DEFAULT NULL,
  `contenidod` text,
  `img` varchar(200) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `articulo`
--

INSERT INTO `articulo` (`id_articulo`, `titulo`, `id_tags`, `fecha`, `contenido`, `urlv`, `contenidod`, `img`, `url`, `orden`) VALUES
(1, '¿Qué es el lean manufacturing o manufactura esbelta?', 'Informativo', '19 ENERO DEL 2018', '<p>La <strong>manufactura esbelta</strong> es un conjunto de herramientas que ayuda a eliminar aquellas operaciones que no agregan valor al producto o servicio, mejorando los procesos y haci&eacute;ndolos cada vez m&aacute;s eficientes y productivos.</p>\r\n<p>&nbsp;</p>\r\n<p>Esta filosof&iacute;a tiene como objetivo proporcionar a las compa&ntilde;&iacute;as una filosof&iacute;a de Mejora Continua que les permita reducir sus costos, mejorar los procesos y eliminar los desperdicios, aumentando as&iacute; la satisfacci&oacute;n de sus clientes.</p>\r\n<p>La manufactura esbelta proporciona a las compa&ntilde;&iacute;as excelentes herramientas para sobrevivir en un mercado global competitivo, ya que conlleva rigurosos est&aacute;ndares de calidad, as&iacute; como entregas m&aacute;s r&aacute;pidas a menor precio en las cantidades y momentos requeridos.</p>\r\n<p>&nbsp;</p>\r\n<p>Durante su implementaci&oacute;n, es muy importante considerar las ideas y sugerencias de los operadores, ya que ellos son los m&aacute;s cercanos al proceso y en ocasiones sus aportaciones pueden hacer una gran diferencia.</p>', 'https://www.youtube.com/embed/cpf4JkxV4dE', '<p>Es sumamente recomendable hacerlos part&iacute;cipes de cualquier cambio siempre, ya que, al ser parte de esta transformaci&oacute;n, la resistencia ser&aacute; menor, se fortalecer&aacute; el trabajo en equipo, habr&aacute; mayor alineaci&oacute;n y los resultados obtenidos ser&aacute;n mejores.</p>\r\n<p>&nbsp;</p>\r\n<p><strong>Beneficios de la manufactura esbelta</strong></p>\r\n<p>La implementaci&oacute;n de la <strong>manufactura esbelta</strong> es importante en diferentes &aacute;reas, puesto que se emplean diferentes herramientas, beneficiando todos los niveles de la organizaci&oacute;n.&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Algunos de dichos beneficios son:</p>\r\n<p>&nbsp;</p>\r\n<ul>\r\n<li>Reducci&oacute;n de inventarios</li>\r\n<li>Reducci&oacute;n de movimientos innecesarios</li>\r\n<li>Disminuci&oacute;n de los desperdicios</li>\r\n<li>Reducci&oacute;n de tiempos de espera (que pueden provocar atrasos de la producci&oacute;n)</li>\r\n<li>Mejora de la calidad (en l&iacute;neas de producci&oacute;n)</li>\r\n<li>Reducci&oacute;n de costos y tiempos de transporte</li>\r\n<li>Reducci&oacute;n en tiempos de entrega al cliente</li>\r\n<li>Rendimiento &oacute;ptimo (hacer m&aacute;s con menos)</li>\r\n<li>Mayor eficiencia y productividad</li>\r\n</ul>', 'mue11.png', 'que-es-lean-manufacturing', 2),
(2, 'La manufactura esbelta en el sector maquilador', 'Manufactura Esbelta', '19 ENERO DEL 2018', '<p><strong>La manufactura esbelta en el sector maquilador</strong></p>\r\n<p>En el mundo competitivo y globalizado en el que vivimos, las empresas deben considerar varios factores para poder continuar activas en el mercado. La <strong>manufactura esbelta</strong> es precisamente ese conjunto de herramientas y pensamientos que te ayudar&aacute;n a hacerlo.</p>\r\n<p>&nbsp;</p>\r\n<p>Para lograr esto, las empresas se est&aacute;n dando a la tarea de capacitar a sus empleados en t&eacute;cnicas y metodolog&iacute;as lean, ya que estas mejoran de manera significativa diversos procesos tanto en &aacute;reas productivas como administrativas.</p>\r\n<p>&nbsp;</p>\r\n<p>Puesto que existen diferentes herramientas de manufactura esbelta, el conocerlas y saber implementarlas pueden darte una gran ventaja competitiva. Por esta raz&oacute;n es importante mantenernos actualizados en el tema, as&iacute; como implementar las herramientas necesarias en los procesos que as&iacute; lo requieran para potencializar nuestros resultados.</p>', '', '', 'mue12.png', 'la-manufactura-esbelta-en-el-sector-maquilador', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `blog`
--

CREATE TABLE `blog` (
  `id_blog` int(11) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `img` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `blog`
--

INSERT INTO `blog` (`id_blog`, `titulo_seo`, `description_seo`, `keywords_seo`, `img`, `orden`) VALUES
(1, 'Lean Outlet™', 'Consulte nuestro blog para mantenerse actualizado sobre las últimas novedades en manufactura esbelta (lean manufacturing).', 'Manufactura esbelta; lean manufacturing; noticias; novedades', 'footer.jpg', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nom_prod` varchar(200) NOT NULL,
  `mod_prod` varchar(128) NOT NULL,
  `img_prod` varchar(200) NOT NULL,
  `cant_prod` int(11) NOT NULL,
  `precio_prod` decimal(8,2) NOT NULL,
  `orden` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `carrito`
--

INSERT INTO `carrito` (`id_carrito`, `id_prod`, `email`, `nom_prod`, `mod_prod`, `img_prod`, `cant_prod`, `precio_prod`, `orden`) VALUES
(2, 1, 'luna@hotmail.com', 'Estructura Tubular', 'PGLP-6', 'fileimages/productos/mu9.png', 1, '18445.71', 3),
(3, 3, 'yovany@hotmail.com', 'asdads', 'aasdasd', 'fileimages/productos/m4.jpg', 3, '12000.00', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE `contacto` (
  `id_contacto` int(11) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `imgcont` varchar(200) DEFAULT NULL,
  `titcont_contacto` varchar(128) NOT NULL,
  `txtcont_contacto` text NOT NULL,
  `fracont_contacto` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `contacto`
--

INSERT INTO `contacto` (`id_contacto`, `titulo_seo`, `description_seo`, `keywords_seo`, `imgcont`, `titcont_contacto`, `txtcont_contacto`, `fracont_contacto`, `orden`) VALUES
(1, 'Lean Outlet™ - Contacto', 'Pónganse en contacto con los especialistas en manufactura esbelta y obtenga una cotización de forma rápida y sin compromiso.', 'Mobilario ergonómico; Controles visuales; Entrenamiento y Capacitación; Manufactura Esbelta; Lean Manufacturing; Lean Training; Lean Culture; Cultura Lean; Lego Serious Play, VSM, Kaizen, Maquiladora, Manufacturera.', 'footer.jpg', 'Contacto', '<p>Si desea informaci&oacute;n adicional sobre nuestros productos o requiere que uno de nuestros asesores le contacte o visite en instalaciones, puede enviarnos un mensaje y nosotros le brindaremos la atenci&oacute;n que merece.</p>', '¡Estamos para servirle!', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `destacados`
--

CREATE TABLE `destacados` (
  `id_destacados` int(11) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `nomprop_dest` varchar(200) NOT NULL,
  `precio_dest` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `destacados`
--

INSERT INTO `destacados` (`id_destacados`, `img`, `nomprop_dest`, `precio_dest`, `orden`) VALUES
(1, 'm1.jpg', 'Spantrack flujo Rack - 125 X 59', '1844779', 2),
(2, 'm2.jpg', 'prueba', 'prueba', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `home`
--

CREATE TABLE `home` (
  `id_home` int(11) NOT NULL,
  `titulo_seo` text,
  `desciption_seo` text,
  `keywords_seo` text,
  `img` varchar(200) DEFAULT NULL,
  `titu_home` varchar(128) NOT NULL,
  `imgd` varchar(200) DEFAULT NULL,
  `titd_home` varchar(128) DEFAULT NULL,
  `imgt` varchar(200) NOT NULL,
  `titt_home` varchar(128) DEFAULT NULL,
  `urlv` text,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `home`
--

INSERT INTO `home` (`id_home`, `titulo_seo`, `desciption_seo`, `keywords_seo`, `img`, `titu_home`, `imgd`, `titd_home`, `imgt`, `titt_home`, `urlv`, `orden`) VALUES
(1, 'Lean Outlet™ - Soluciones especializadas en Manufactura Esbelta y Cultura Lean', 'Somos una empresa especializada en proveer soluciones para la manufactura esbelta, tales como: mobiliario ergonómico, controles visuales y entrenamientos en lean manufacturing tales como Lego Serious Play.', 'Mobilario ergonómico; Controles visuales; Entrenamiento y Capacitación; Manufactura Esbelta; Lean Manufacturing; Lean Training; Lean Culture; Cultura Lean; Lego Serious Play, VSM, Kaizen, Maquiladora, Manufacturera', 'ml.jpg', 'Mobiliario Lean', 'cv.jpg', 'Controles Visuales', 'mpe.jpg', 'Materiales para Entretenimiento', 'https://www.youtube.com/embed/cpf4JkxV4dE', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `inicio`
--

CREATE TABLE `inicio` (
  `id_inicio` int(11) NOT NULL,
  `nombre` varchar(112) NOT NULL,
  `apellido` varchar(112) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `email` varchar(200) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `inicio`
--

INSERT INTO `inicio` (`id_inicio`, `nombre`, `apellido`, `tel`, `email`, `contrasena`, `orden`) VALUES
(1, 'luna', 'gutierrez', 2147483647, 'luna@hotmail.com', 'luna', 2),
(2, 'yovany', 'mora', 2147483647, 'yovany@hotmail.com', 'yovany', 3),
(5, 'Luna', 'Gutierrez', 2147483647, 'luna@bonzercreative.com', 'luna', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `materiales`
--

CREATE TABLE `materiales` (
  `id_materiales` int(11) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `titulo_mat` varchar(128) NOT NULL,
  `subt_mat` varchar(128) NOT NULL,
  `txt_mat` text NOT NULL,
  `subtd_mat` varchar(128) NOT NULL,
  `txtd_mat` text NOT NULL,
  `cat_mat` varchar(128) NOT NULL,
  `catd_mat` varchar(128) NOT NULL,
  `catt_mat` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `materiales`
--

INSERT INTO `materiales` (`id_materiales`, `titulo_seo`, `description_seo`, `keywords_seo`, `img`, `titulo_mat`, `subt_mat`, `txt_mat`, `subtd_mat`, `txtd_mat`, `cat_mat`, `catd_mat`, `catt_mat`, `orden`) VALUES
(1, 'Lean Outlet™', 'Consulte nuestro portafolio de entrenamientos, capacitaciones y talleres especializados en manufactura esbelta tales como Lego Serious Play.', 'VSM, Kaizen, 5 S, Lego Serious Play, Manufactura Esbelta, Lean Manufacturing, Cultura Lean, Maquiladora, Entrenamiento, Capacitación, Taller, ', 'footer.jpg', 'Aprendizaje dinámico', 'Kaizen', '<p>Filosof&iacute;a japonesa enfocada a la Mejora Continua mediante la eliminaci&oacute;n de residuos o desperdicios, los cuales son eliminados de forma sistem&aacute;tica mediante la ejecuci&oacute;n continua de mejoras.</p>', 'VSM', '<p>Los Mapas de Flujo de Valor (VSM, por sus siglas en ingl&eacute;s) son una t&eacute;cnica gr&aacute;fica que permite visualizar detalladamente todo un proceso, facilitando la comprensi&oacute;n de cualquier proceso, tanto en t&eacute;rminos de informaci&oacute;n como de materiales necesarios para que un producto o servicio sea ejecutado de manera &oacute;ptima.</p>', 'Estaciones de Trabajo', 'Moving carts', 'Racks de materiales', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mobiliario`
--

CREATE TABLE `mobiliario` (
  `id_mobiliario` int(12) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `titulo_mob` varchar(128) NOT NULL,
  `subt_mob` varchar(128) NOT NULL,
  `txt_mob` text NOT NULL,
  `subtd_mob` varchar(128) NOT NULL,
  `txtd_mob` text NOT NULL,
  `cat_mob` varchar(128) NOT NULL,
  `catd_mob` varchar(128) NOT NULL,
  `catt_mob` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `mobiliario`
--

INSERT INTO `mobiliario` (`id_mobiliario`, `titulo_seo`, `description_seo`, `keywords_seo`, `img`, `titulo_mob`, `subt_mob`, `txt_mob`, `subtd_mob`, `txtd_mob`, `cat_mob`, `catd_mob`, `catt_mob`, `orden`) VALUES
(1, 'Lean Outlet™ - Mobiliario ergonómico, racks y flow racks para optimizar tiempos y movimientos.', 'Las soluciones en mobiliario lean que ofrecemos, tales como estaciones, racks y flow racks, permiten a las empresa optimizar tiempos y esfuerzos en sus procesos de manufactura.', 'Mobiliario lean, ergonómico, racks, flow racks, moving carts, estructuras tubulares, manufactura esbelta, balanceo de línea, lean manufacturing.', 'footer.jpg', 'Estaciones de Trabajo', 'Estructuras tubulares', '<p>Las estructuras tubulares son un sistema moderno, vers&aacute;til y revolucionario que permite dise&ntilde;ar estaciones de trabajo y flujos de materiales en las l&iacute;neas de producci&oacute;n, siendo una soluci&oacute;n ligera y de gran movilidad.</p>', 'Estaciones de trabajo ', '<p>Estas estaciones facilitan el trabajo de sus operarios, colocando las herramientas y el material justo donde se necesita, agilizando los procesos y evitando los desperdicios. Contamos con meses para &aacute;reas de trabajo est&aacute;ndar o predise&ntilde;adas que se ajustan a las necesidades de su proyecto.</p>', 'Estaciones de Trabajo', 'Moving carts', 'Racks de materiales', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nosotros`
--

CREATE TABLE `nosotros` (
  `id_nosotros` int(11) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `titulo_nos` varchar(128) NOT NULL,
  `sub_nos` varchar(128) NOT NULL,
  `txtu_nos` text NOT NULL,
  `urlv` text NOT NULL,
  `txtd_nos` text NOT NULL,
  `imgcu` varchar(200) NOT NULL,
  `imgcd` varchar(200) NOT NULL,
  `imgct` varchar(200) NOT NULL,
  `titulo_nue` varchar(200) NOT NULL,
  `txtu_nue` text NOT NULL,
  `txtd_nue` text NOT NULL,
  `txtt_nue` text NOT NULL,
  `titulo_comp` varchar(128) NOT NULL,
  `txtu_comp` text NOT NULL,
  `txtd_comp` text NOT NULL,
  `txtt_comp` text NOT NULL,
  `tit_opc` varchar(200) NOT NULL,
  `frase_opc` varchar(200) NOT NULL,
  `txtu_opc` text NOT NULL,
  `frasd_opc` text NOT NULL,
  `txtd_opc` text NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nosotros`
--

INSERT INTO `nosotros` (`id_nosotros`, `titulo_seo`, `description_seo`, `keywords_seo`, `img`, `titulo_nos`, `sub_nos`, `txtu_nos`, `urlv`, `txtd_nos`, `imgcu`, `imgcd`, `imgct`, `titulo_nue`, `txtu_nue`, `txtd_nue`, `txtt_nue`, `titulo_comp`, `txtu_comp`, `txtd_comp`, `txtt_comp`, `tit_opc`, `frase_opc`, `txtu_opc`, `frasd_opc`, `txtd_opc`, `orden`) VALUES
(1, 'Lean Outlet™ - Especialistas en Cultura Lean', 'Nos integra un equipo de profesionales y consultores en manufactura esbelta con una experiencia inigualable en proyectos de transformación lean.', 'Consultoría; Consultores; Lean Manufacturing; Manufactura Esbelta; Especialistas Lean; Lean Assessment; Manufacturing', 'acercadenosotros.jpg', '¡La primera empresa especializada manufactura esbelta en México!', '¿Quiénes somos?', '<p>Lean Outlet&trade; provee soluciones especializadas en eficiencia, productividad y calidad, principalmente para las empresas del sector industrial que operan, o que desean hacerlo, bajo una cultura de manufactura esbelta o lean manufacturing. Nuestro empresa est&aacute; integrada por especialistas en lean, con experiencia en algunas de las principales compa&ntilde;&iacute;as manufactureras a nivel global, permiti&eacute;ndonos asesorar y acompa&ntilde;ar a nuestros clientes en sus proyectos de productividad y eficiencia. Como resultado, las compa&ntilde;&iacute;as eliminan desperdicios en sus procesos, adem&aacute;s de lograr grandes ahorros de espacio mediante los sistemas estrat&eacute;gicos de Lean Outlet&trade;.</p>', 'https://www.youtube.com/embed/cpf4JkxV4dE', '<p>Adicionalmente, ofrecemos materiales para el entrenamiento de personal en herramientas de manufactura esbelta, poniendo a su disposici&oacute;n programas pr&aacute;cticos y din&aacute;micos que facilitan el aprendizaje y la implementaci&oacute;n de la filosof&iacute;a lean en todos los niveles de su organizaci&oacute;n.</p>', 'mu1.jpg', 'mu2.jpg', 'mu3.jpg', 'Nuestro Objetivo', '<p>Nuestro objetivo fundamental consiste en asegurar que nuestros clientes logren una transformaci&oacute;n lean exitosa a trav&eacute;s del soporte que nuestros productos y servicios especializados le brindan.</p>', '<p>Como compa&ntilde;&iacute;a, estamos plenamente comprometidos con la calidad de nuestros productos y as&iacute; como la excelencia de nuestros servicios mediante los sistemas estrat&eacute;gicos de Lean Outlet&trade;.</p>', '<p>Adicionalmente, ofrecemos materiales para el entrenamiento de personal en herramientas de manufactura esbelta, poniendo a su disposici&oacute;n programas pr&aacute;cticos y din&aacute;micos que facilitan el aprendizaje y la implementaci&oacute;n de la filosof&iacute;a lean en todos los niveles de su organizaci&oacute;n.</p>', 'El compromiso de Lean Outlet™', '<p>Nuestra empresa est&aacute; integrada por especialistas en lean, con experiencia en algunas de las principales compa&ntilde;&iacute;as manufactureras a nivel global, permiti&eacute;ndonos asesorar y acompa&ntilde;ar a nuestros clientes en sus proyectos de productividad y eficiencia. Como resultado, las compa&ntilde;&iacute;as eliminan desperdicios en sus proces, adem&aacute;s de lograr grandes ahorros de especio mediante los sistemas estrat&eacute;gicos de Lean Outlet&trade;.</p>', '<p>Nuestra empresa est&aacute; integrada por especialistas en lean, con experiencia en algunas de las principales compa&ntilde;&iacute;as manufactureras a nivel global, permiti&eacute;ndonos asesorar y acompa&ntilde;ar a nuestros clientes en sus proyectos de productividad y eficiencia. Como resultado, las compa&ntilde;&iacute;as eliminan desperdicios en sus proces, adem&aacute;s de lograr grandes ahorros de especio mediante los sistemas estrat&eacute;gicos de Lean Outlet&trade;.</p>', '<p>Adicionalmente, ofrecemos materiales para el entrenamiento de personal en herramientas de manufactura esbelta, poniendo a su disposici&oacute;n programas pr&aacute;cticos y din&aacute;micos que facilitan el aprendizaje y la implementaci&oacute;n de la filosof&iacute;a lean en todos los niveles de su organizaci&oacute;n.</p>', '¿Por qué somos su mejor opción?', 'Ninguna otra compañía posee la experiencia que nuestros líderes han acumulado por años.', '<p>Los profesionales que integran nuestro equipo de trabajo tienen una amplia experiencia colaborando con grandes e importantes empresas como responsables del &aacute;rea de Mejora Continua y m&aacute;s recientemente como Consultores para cientos de compa&ntilde;&iacute;as, permiti&eacute;ndonos conocer todo tipo de procesos, problem&aacute;ticas y tecnolog&iacute;as. Comprendemos perfectamente sus necesidades, lo que nos permite facilitar el proceso de dise&ntilde;o, selecci&oacute;n e integraci&oacute;n de nuestras soluciones, evitando demoras, errores y costos adicionales.</p>', '<p>Olv&iacute;dese de tratar con proveedores que no hablan su mismo idioma. Nosotros contamos con la experiencia necesaria para atenderle de manera oportuna, eficiente y pr&aacute;ctica.</p>', '<p>P&oacute;ngase en contacto con nosotros y uno de nuestros asesores le atender&aacute; a la brevedad posible.</p>', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pay`
--

CREATE TABLE `pay` (
  `id_pay` int(11) NOT NULL,
  `id_venta` int(11) NOT NULL,
  `estatus` int(11) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `modelo` varchar(128) NOT NULL,
  `id_tags` varchar(200) NOT NULL,
  `barras` bigint(20) DEFAULT NULL,
  `url` varchar(200) NOT NULL,
  `descripcion` text NOT NULL,
  `categoria` varchar(128) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(8,2) NOT NULL,
  `garantia` int(11) NOT NULL,
  `file` varchar(200) DEFAULT NULL,
  `img` varchar(200) DEFAULT NULL,
  `imgd` varchar(200) DEFAULT NULL,
  `imgt` varchar(200) DEFAULT NULL,
  `imgc` varchar(200) DEFAULT NULL,
  `especifu` text NOT NULL,
  `especifd` text NOT NULL,
  `especift` text NOT NULL,
  `especifc` text NOT NULL,
  `especifcin` text NOT NULL,
  `valoru` text NOT NULL,
  `valord` text NOT NULL,
  `valort` text NOT NULL,
  `valorc` text NOT NULL,
  `valorcin` text NOT NULL,
  `faqsu` text NOT NULL,
  `faqsd` text NOT NULL,
  `faqst` text NOT NULL,
  `faqsc` text NOT NULL,
  `faqscin` text NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id_producto`, `nombre`, `modelo`, `id_tags`, `barras`, `url`, `descripcion`, `categoria`, `cantidad`, `precio`, `garantia`, `file`, `img`, `imgd`, `imgt`, `imgc`, `especifu`, `especifd`, `especift`, `especifc`, `especifcin`, `valoru`, `valord`, `valort`, `valorc`, `valorcin`, `faqsu`, `faqsd`, `faqst`, `faqsc`, `faqscin`, `orden`) VALUES
(1, 'Estructura Tubular', 'PGLP-6', ' Estructura Tubulares', 12312, 'estructura_tubular', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi.</p>', 'Mobiliario Lean', 31, '18445.71', 2, 'Lean Outlet - Info AJR v.2.pdf', 'mu9.png', 'mu9.png', 'mu9.png', 'mu9.png', '<div class=\"col-md-12 col-xs-12 padding titdimenpro margleftprudcbox\">Dimenciones</div>\r\n<div class=\"col-md-12 col-xs-12 padding linedatosproduc margleftprudcbox\">\r\n<p class=\"txtgenproduc\">Weight 9 <br /> Cable Length: 4.0 m<br /> Dimenciones l x w x h: 168x220x432<br /> Electrical values</p>\r\n</div>', '<p>Nominal current: 16 a <br /> Type of current: AC 50/60 Hz<br /> Materials</p>', '<p>Material: Stainless steel <br /> Mechanical</p>', '<p>Impact strength: IK 10 <br /> Certificates <br /> Standards: EN 61439-1, EN 61439-3 <br /> Ratings</p>', '<p>Rated voltage: 230 V <br /> Degree of protection: IP44 <br /> Short-circuit characteristics</p>', '<p>Weight 9 <br /> Cable Length: 4.0 m<br /> Dimenciones l x w x h: 168x220x432<br /> Electrical values</p>', '<div class=\"col-md-12 padding\">Nominal current: 16 a <br />Type of current: AC 50/60 Hz <br />Materials</div>', '<p>Material: Stainless steel <br /> Mechanical</p>', '<p>Impact strength: IK 10 <br /> Certificates <br /> Standards: EN 61439-1, EN 61439-3 <br /> Ratings</p>', '<p>Rated voltage: 230 V <br /> Degree of protection: IP44 <br /> Short-circuit characteristics</p>', '<div class=\"col-md-12 col-xs-12 padding titdimenpro margleftprudcbox\">Dimenciones</div>\r\n<div class=\"col-md-12 col-xs-12 padding linedatosproduc margleftprudcbox\">\r\n<p class=\"txtgenproduc\">Weight 9 <br /> Cable Length: 4.0 m<br /> Dimenciones l x w x h: 168x220x432<br /> Electrical values</p>\r\n</div>', '<div class=\"col-md-12 padding\">Nominal current: 16 a <br />Type of current: AC 50/60 Hz<br />Materials</div>', '<p>Impact strength: IK 10 <br /> Certificates <br /> Standards: EN 61439-1, EN 61439-3 <br /> Ratings</p>', '<p>Impact strength: IK 10 <br /> Certificates <br /> Standards: EN 61439-1, EN 61439-3 <br /> Ratings</p>', '<p>Rated voltage: 230 V <br /> Degree of protection: IP44 <br /> Short-circuit characteristics</p>', 2),
(2, 'aasdd', 'asdasda', 'asdadad', 12343423, 'producto_prueba', 'asdadadsad', 'Mobiliario Lean', 3, '198.00', 2, 'asdadadad', 'm2.jpg', 'asdadad', 'asdad', 'asdsa', 'asdadad', 'asdsadad', 'asdasd', 'asdasd', 'asdasd', 'asdad', 'asdad', 'asdasd', 'asdad', 'asdada', 'asdad', 'asdasd', 'asdad', 'asdsada', 'asdad', 2),
(3, 'asdads', 'aasdasd', 'asdasd', 12313, 'asdsadad', 'asdadsadad', 'Controles Visuales', 12, '12000.00', 1, 'm4.jpg', 'm4.jpg', 'm4.jpg', 'm4.jpg', 'm4.jpg', '<p>asdasdad</p>', '<p>asdsadadadasd</p>', '<p>asdasd</p>', '<p>asdasdad</p>', '<p>asdasdadad</p>', '<p>asdasdad</p>', '<p>asdasd</p>', '<p>asdasdasd</p>', '<p>asdadssad</p>', '<p>asdasdasd</p>', '<p>asdasd</p>', '<p>asdadasdasdasd</p>', '<p>asdasdasdsad</p>', '<p>asdasd</p>', '<p>asdasd</p>', 4),
(4, 'prueba', 'prueba', 'prueba', 123456, 'prueba_me', 'asdadsdasdasdasd', 'Entrenamiento Lean', 0, '12000.00', 3, 'carrito.txt', 'm4.jpg', 'm3.jpg', 'm3.jpg', 'm3.jpg', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>pruebas</p>', '<p>prueba</p>', '<p>preuba</p>', '<p>prueba</p>', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `registro`
--

CREATE TABLE `registro` (
  `id_registro` int(11) NOT NULL,
  `nombre` varchar(128) NOT NULL,
  `apellido` varchar(128) NOT NULL,
  `tel` int(11) NOT NULL,
  `correo` varchar(128) NOT NULL,
  `contrasena` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sliderhome`
--

CREATE TABLE `sliderhome` (
  `id_sliderhome` int(11) NOT NULL,
  `imgsl` varchar(200) DEFAULT NULL,
  `txtslider_home` text NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sliderhome`
--

INSERT INTO `sliderhome` (`id_sliderhome`, `imgsl`, `txtslider_home`, `orden`) VALUES
(1, 'wallpaperh.jpg', '<p>La &uacute;nica empresa especializada en Lean Manufacturing en M&eacute;xico. Brindamos servicio y distribuimos nuestros productos a nivel internacional.</p>', 1),
(2, 'wallpaperh.jpg', '<p>La &uacute;nica empresa especializada en Lean Manufacturing en M&eacute;xico. Brindamos servicio y distribuimos nuestros productos a nivel internacional.</p>', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `testimonios`
--

CREATE TABLE `testimonios` (
  `id_testimonios` int(11) NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `txt_testimonios` text NOT NULL,
  `nom_testimonios` varchar(128) NOT NULL,
  `empre_testimonios` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `testimonios`
--

INSERT INTO `testimonios` (`id_testimonios`, `img`, `txt_testimonios`, `nom_testimonios`, `empre_testimonios`, `orden`) VALUES
(1, 'Janeth.png', '<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi.</p>', 'Carlos Paz', 'Empresa Fundadora', 2),
(2, 'Janeth.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi.', 'Carlos Paz', 'Empresa Fundadora', 3),
(3, 'Janeth.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi.', 'Carlos Paz', 'Empresa Fundadora', 4),
(4, 'Janeth.png', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quidem, veritatis nulla eum laudantium totam tempore optio doloremque laboriosam quas, quos eaque molestias odio aut eius animi.', 'Carlos Paz', 'Empresa Fundadora', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(12) NOT NULL,
  `usuario` varchar(200) NOT NULL,
  `contrasena` varchar(200) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `usuario`, `contrasena`, `nombre`, `orden`) VALUES
(1, 'admin', '$2y$12$uxYKfqEA45sJS9F9OyeAQO8hw.kQDuJrUwkCdBEcsCT8x.kxg9Zde', 'admin', NULL),
(2, 'Coach', '$12$rGK3IRs8UAR7bs3kB6CJi.f7HnXSkU.SfnJQw1r23easMzCNF0Yp6', 'Nuevo', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_venta` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `nom_prod` varchar(128) NOT NULL,
  `mod_prod` varchar(128) NOT NULL,
  `img_prod` varchar(200) NOT NULL,
  `cant_prod` int(11) NOT NULL,
  `precio_prod` decimal(8,2) NOT NULL,
  `total` decimal(8,2) NOT NULL,
  `fecha` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_venta`, `id_prod`, `email`, `nom_prod`, `mod_prod`, `img_prod`, `cant_prod`, `precio_prod`, `total`, `fecha`, `orden`) VALUES
(1, 1, 'yovany@hotmail.com', 'Estructura Tubular', 'PCL-6', 'fileimages/productos/img3.jpg', 2, '11890.00', '23780.00', '2018-02-02', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `videos`
--

CREATE TABLE `videos` (
  `id_videos` int(11) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `url` varchar(200) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `videos`
--

INSERT INTO `videos` (`id_videos`, `titulo`, `url`, `orden`) VALUES
(1, 'Lean Outlet™ - Embrace for Improvement - Soluciones en Lean Manufacturing', 'https://www.youtube.com/embed/cpf4JkxV4dE', 2),
(2, 'Grupo Consultor EFE™ - Potential through innovation™', 'https://www.youtube.com/embed/aEm0vAMzL0g', 2),
(3, 'La importancia de ser competitivos mediante un sistema de entrenamiento holístico', 'https://www.youtube.com/embed/j372ewoGdrM', 3),
(4, 'Filosofía Kaizen - Nissan', 'https://www.youtube.com/embed/iQLnwSg6mGU', 4),
(5, 'Lean Management - Boss vs Leader', 'https://www.youtube.com/embed/j_F7ghGTxGY', 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `visuales`
--

CREATE TABLE `visuales` (
  `id_visuales` int(11) NOT NULL,
  `titulo_seo` text NOT NULL,
  `description_seo` text NOT NULL,
  `keywords_seo` text NOT NULL,
  `img` varchar(200) DEFAULT NULL,
  `titulo_vis` varchar(200) NOT NULL,
  `subt_vis` varchar(200) NOT NULL,
  `txt_vis` text NOT NULL,
  `subtd_vis` varchar(200) NOT NULL,
  `txtd_vis` text NOT NULL,
  `cat_vis` varchar(128) NOT NULL,
  `catd_vis` varchar(128) NOT NULL,
  `catt_vis` varchar(128) NOT NULL,
  `orden` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `visuales`
--

INSERT INTO `visuales` (`id_visuales`, `titulo_seo`, `description_seo`, `keywords_seo`, `img`, `titulo_vis`, `subt_vis`, `txt_vis`, `subtd_vis`, `txtd_vis`, `cat_vis`, `catd_vis`, `catt_vis`, `orden`) VALUES
(1, 'Lean Outlet™ - Controles visuales, tableros de métricos y pizarrones personalizados', 'Nuestra oferta de controles visuales es integrada por tableros de métricos, pizarrones personalizados e identificadores de área que facilitan la lectura y comprensión de la información en la empresa.', 'Lean Manufacturing; Manufactura Esbelta; Cultura Lean; Controles Visuales; Pizarroes; Tableros de Métricos; Identificadores de área; Manufactura; Maquiladora; Señalamientos', 'footer.jpg', 'Tableros y Pizarrones', 'Pizarrones personalizados', '<p>Dise&ntilde;amos pizarrones personalizados para medir y mejorar los procesos de su empresa con base en sus necesidades espec&iacute;ficas. Ofrezca a su equipo de trabajo informaci&oacute;n clara y objetiva mediante pizarrones personalizados.</p>', 'Tableros Métricos', '<p>Toda empresa debe medir sus procesos, controlar sus resultados y tomar sus decisiones, y esto se puede lograr de manera &oacute;ptima mediante tableros de m&eacute;tricos de control. Nuestros tableros est&aacute;n disponibles en medidas est&aacute;ndar o personalizadas. Brindar a sus operarios herramientas para medir su desempe&ntilde;o estimular&aacute; su esp&iacute;ritu de competencia, mejorando su rendimiento y sus resultados.</p>', 'Estaciones de Trabajo', 'Moving carts', 'Racks de materiales', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `articulo`
--
ALTER TABLE `articulo`
  ADD PRIMARY KEY (`id_articulo`);

--
-- Indices de la tabla `blog`
--
ALTER TABLE `blog`
  ADD PRIMARY KEY (`id_blog`);

--
-- Indices de la tabla `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indices de la tabla `contacto`
--
ALTER TABLE `contacto`
  ADD PRIMARY KEY (`id_contacto`);

--
-- Indices de la tabla `destacados`
--
ALTER TABLE `destacados`
  ADD PRIMARY KEY (`id_destacados`);

--
-- Indices de la tabla `home`
--
ALTER TABLE `home`
  ADD PRIMARY KEY (`id_home`);

--
-- Indices de la tabla `inicio`
--
ALTER TABLE `inicio`
  ADD PRIMARY KEY (`id_inicio`);

--
-- Indices de la tabla `materiales`
--
ALTER TABLE `materiales`
  ADD PRIMARY KEY (`id_materiales`);

--
-- Indices de la tabla `mobiliario`
--
ALTER TABLE `mobiliario`
  ADD PRIMARY KEY (`id_mobiliario`);

--
-- Indices de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  ADD PRIMARY KEY (`id_nosotros`);

--
-- Indices de la tabla `pay`
--
ALTER TABLE `pay`
  ADD PRIMARY KEY (`id_pay`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indices de la tabla `registro`
--
ALTER TABLE `registro`
  ADD PRIMARY KEY (`id_registro`);

--
-- Indices de la tabla `sliderhome`
--
ALTER TABLE `sliderhome`
  ADD PRIMARY KEY (`id_sliderhome`);

--
-- Indices de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  ADD PRIMARY KEY (`id_testimonios`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_venta`);

--
-- Indices de la tabla `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id_videos`);

--
-- Indices de la tabla `visuales`
--
ALTER TABLE `visuales`
  ADD PRIMARY KEY (`id_visuales`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `articulo`
--
ALTER TABLE `articulo`
  MODIFY `id_articulo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `blog`
--
ALTER TABLE `blog`
  MODIFY `id_blog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `contacto`
--
ALTER TABLE `contacto`
  MODIFY `id_contacto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `destacados`
--
ALTER TABLE `destacados`
  MODIFY `id_destacados` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `home`
--
ALTER TABLE `home`
  MODIFY `id_home` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `inicio`
--
ALTER TABLE `inicio`
  MODIFY `id_inicio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `materiales`
--
ALTER TABLE `materiales`
  MODIFY `id_materiales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mobiliario`
--
ALTER TABLE `mobiliario`
  MODIFY `id_mobiliario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `nosotros`
--
ALTER TABLE `nosotros`
  MODIFY `id_nosotros` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `pay`
--
ALTER TABLE `pay`
  MODIFY `id_pay` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `registro`
--
ALTER TABLE `registro`
  MODIFY `id_registro` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `sliderhome`
--
ALTER TABLE `sliderhome`
  MODIFY `id_sliderhome` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `testimonios`
--
ALTER TABLE `testimonios`
  MODIFY `id_testimonios` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `venta`
--
ALTER TABLE `venta`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `videos`
--
ALTER TABLE `videos`
  MODIFY `id_videos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `visuales`
--
ALTER TABLE `visuales`
  MODIFY `id_visuales` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
