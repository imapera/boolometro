-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-07-2021 a las 12:37:27
-- Versión del servidor: 10.4.17-MariaDB
-- Versión de PHP: 8.0.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `boolometro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plt_administrators`
--

CREATE TABLE `plt_administrators` (
  `ID_PLATFORM` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `DATE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plt_comments`
--

CREATE TABLE `plt_comments` (
  `ID` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `ID_NEW` int(11) NOT NULL,
  `CONTENT` varchar(1000) NOT NULL,
  `REGISTERED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plt_informers`
--

CREATE TABLE `plt_informers` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(100) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `SOCIAL_LINK1` varchar(300) NOT NULL,
  `SOCIAL_LINK2` varchar(300) NOT NULL,
  `SOCIAL_LINK3` varchar(300) NOT NULL,
  `REGISTERED` int(11) NOT NULL,
  `UPDATED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `plt_informer_news_count`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `plt_informer_news_count` (
`ID` int(11)
,`CORRECT_NEWS` bigint(21)
,`WRONG_NEWS` bigint(21)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plt_news`
--

CREATE TABLE `plt_news` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(60) NOT NULL,
  `RESUME` varchar(150) NOT NULL,
  `DESCRIPTION` varchar(500) NOT NULL,
  `ORIGIN_DATE` int(11) NOT NULL,
  `LINK1` varchar(300) NOT NULL,
  `LINK2` varchar(200) DEFAULT NULL,
  `LINK3` varchar(200) DEFAULT NULL,
  `RESULT_DATE` int(11) DEFAULT NULL,
  `RESULT` varchar(1) DEFAULT NULL,
  `RESULT_DESCRIPTION` varchar(500) DEFAULT NULL,
  `ID_INFORMER` int(11) NOT NULL,
  `ID_PLATFORM` int(11) NOT NULL,
  `REGISTERED` int(11) DEFAULT NULL,
  `UPDATED` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `plt_platforms`
--

CREATE TABLE `plt_platforms` (
  `ID` int(11) NOT NULL,
  `TITLE` varchar(50) NOT NULL,
  `DESCRIPTION` varchar(300) NOT NULL,
  `ID_USER` int(50) NOT NULL,
  `THEME` varchar(30) NOT NULL,
  `REGISTERED` int(11) NOT NULL,
  `UPDATED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `plt_reports`
--

CREATE TABLE `plt_reports` (
  `ID` int(11) NOT NULL,
  `ID_RESOURCE` int(11) NOT NULL,
  `TYPE_RESOURCE` varchar(1) NOT NULL,
  `MESSAGE` varchar(200) NOT NULL,
  `REASON` varchar(50) NOT NULL,
  `REGISTERED` int(11) NOT NULL,
  `CHECKED` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura de tabla para la tabla `plt_suscriptions`
--

CREATE TABLE `plt_suscriptions` (
  `ID_USER` int(11) NOT NULL,
  `ID_PLATFORM` int(11) NOT NULL,
  `DATE` int(11) NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Estructura Stand-in para la vista `plt_top_informers`
-- (Véase abajo para la vista actual)
--
CREATE TABLE `plt_top_informers` (
`ID` int(11)
,`NAME` varchar(100)
,`DESCRIPTION` varchar(500)
,`SOCIAL_LINK1` varchar(300)
,`SOCIAL_LINK2` varchar(300)
,`SOCIAL_LINK3` varchar(300)
,`REGISTERED` int(11)
,`UPDATED` int(11)
,`NEWS_COUNT` bigint(21)
,`ID_INFORMER` int(11)
);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `plt_users`
--

CREATE TABLE `plt_users` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(200) NOT NULL,
  `EMAIL` varchar(200) NOT NULL,
  `REGISTRADO` int(11) NOT NULL,
  `ACTUALIZADO` int(11) NOT NULL,
  `IS_SUPERUSER` varchar(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


--
-- Estructura para la vista `plt_informer_news_count`
--
DROP TABLE IF EXISTS `plt_informer_news_count`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `plt_informer_news_count`  AS SELECT `informer`.`ID` AS `ID`, ifnull(`correct_news`.`NEWS_COUNT`,0) AS `CORRECT_NEWS`, ifnull(`wrong_news`.`NEWS_COUNT`,0) AS `WRONG_NEWS` FROM ((`plt_informers` `informer` left join (select count(0) AS `NEWS_COUNT`,`plt_news`.`ID_INFORMER` AS `ID_INFORMER` from `plt_news` where `plt_news`.`RESULT` = 1 group by `plt_news`.`ID_INFORMER`) `correct_news` on(`correct_news`.`ID_INFORMER` = `informer`.`ID`)) left join (select count(0) AS `NEWS_COUNT`,`plt_news`.`ID_INFORMER` AS `ID_INFORMER` from `plt_news` where `plt_news`.`RESULT` = 2 group by `plt_news`.`ID_INFORMER`) `wrong_news` on(`wrong_news`.`ID_INFORMER` = `informer`.`ID`)) ;

-- --------------------------------------------------------

--
-- Estructura para la vista `plt_top_informers`
--
DROP TABLE IF EXISTS `plt_top_informers`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `plt_top_informers`  AS SELECT `informador`.`ID` AS `ID`, `informador`.`NAME` AS `NAME`, `informador`.`DESCRIPTION` AS `DESCRIPTION`, `informador`.`SOCIAL_LINK1` AS `SOCIAL_LINK1`, `informador`.`SOCIAL_LINK2` AS `SOCIAL_LINK2`, `informador`.`SOCIAL_LINK3` AS `SOCIAL_LINK3`, `informador`.`REGISTERED` AS `REGISTERED`, `informador`.`UPDATED` AS `UPDATED`, `noticias`.`NEWS_COUNT` AS `NEWS_COUNT`, `noticias`.`ID_INFORMER` AS `ID_INFORMER` FROM (`plt_informers` `informador` left join (select count(0) AS `NEWS_COUNT`,`plt_news`.`ID_INFORMER` AS `ID_INFORMER` from `plt_news` group by `plt_news`.`ID_INFORMER` order by count(0) desc limit 10) `noticias` on(`informador`.`ID` = `noticias`.`ID_INFORMER`)) ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `plt_administrators`
--
ALTER TABLE `plt_administrators`
  ADD PRIMARY KEY (`ID_PLATFORM`,`ID_USER`);

--
-- Indices de la tabla `plt_comments`
--
ALTER TABLE `plt_comments`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `plt_informers`
--
ALTER TABLE `plt_informers`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `plt_news`
--
ALTER TABLE `plt_news`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `plt_platforms`
--
ALTER TABLE `plt_platforms`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `plt_reports`
--
ALTER TABLE `plt_reports`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `plt_suscriptions`
--
ALTER TABLE `plt_suscriptions`
  ADD PRIMARY KEY (`ID_USER`,`ID_PLATFORM`);

--
-- Indices de la tabla `plt_users`
--
ALTER TABLE `plt_users`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `NAME` (`USERNAME`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `plt_comments`
--
ALTER TABLE `plt_comments`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `plt_informers`
--
ALTER TABLE `plt_informers`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `plt_news`
--
ALTER TABLE `plt_news`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `plt_platforms`
--
ALTER TABLE `plt_platforms`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de la tabla `plt_reports`
--
ALTER TABLE `plt_reports`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `plt_users`
--
ALTER TABLE `plt_users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
