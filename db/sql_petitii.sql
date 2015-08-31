-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Gazda: 127.0.0.1
-- Timp de generare: 24 Feb 2013 la 15:50
-- Versiune server: 5.5.27
-- Versiune PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza de date: `db_petitii`
--

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `conturi`
--

CREATE TABLE IF NOT EXISTS `conturi` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL` text NOT NULL,
  `PAROLA` text NOT NULL,
  `NUME` text NOT NULL,
  `PRENUME` text NOT NULL,
  `SEX` text NOT NULL,
  `ADRESA` text NOT NULL,
  `TELEFON` text NOT NULL,
  `LOCALITATE` text NOT NULL,
  `JUDET` text NOT NULL,
  `MEDIU` text NOT NULL,
  `OCUPATIE` text NOT NULL,
  `DATA_N` varchar(30) NOT NULL,
  `ACTIV` tinyint(1) NOT NULL,
  `COD` text NOT NULL,
  KEY `ID` (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Salvarea datelor din tabel `conturi`
--

INSERT INTO `conturi` (`ID`, `EMAIL`, `PAROLA`, `NUME`, `PRENUME`, `SEX`, `ADRESA`, `TELEFON`, `LOCALITATE`, `JUDET`, `MEDIU`, `OCUPATIE`, `DATA_N`, `ACTIV`, `COD`) VALUES
(1, 'csegarceanu@gmail.com', 'e5d9f22abebd0de24b9b8f79703754b2', 'Segarceanu', 'Calin', 'MASCULIN', 'bbbbbbbbbbbbbbbb', '0732639637', 'Bucuresti', 'BUCURESTI', 'URBAN', 'Programator', '0000-00-00', 1, '5YUaDGABtp3PXApSegarceanuCalin'),
(2, 'caliuxxx_2009@yahoo.com', '53d16bf6450e92cb2c317ddf00b2d15d', 'Segarceanu', 'Calin', 'MASCULIN', 'Bd Cosntruct', '0732639637', 'Bucuresti', 'CALARASI', 'RURAL', 'dsdsdsds', '8 Mai 1996', 1, 'TbsMRzztJOZ0chbSegarceanuCalin'),
(3, 'csegarcea2nu@gmail.com', 'e30219e75ae169b7f4fd7013cda70e04', 'Segarceanu', 'Calinasu', 'MASCULIN', 'bDDSDSDSD', '0732639637', 'ddddddd', 'DOLJ', 'URBAN', 'Programator', '6 Mai 1996', 1, 'jFisH0HCUHcuoP1SegarceanuCalinasu');

-- --------------------------------------------------------

--
-- Structura de tabel pentru tabelul `petitii`
--

CREATE TABLE IF NOT EXISTS `petitii` (
  `ID` bigint(20) NOT NULL,
  `TITLU` text NOT NULL,
  `INITIATOR` text NOT NULL,
  `NR_VOTURI` int(11) NOT NULL,
  `TAGS` text NOT NULL,
  `VALIDAT` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Salvarea datelor din tabel `petitii`
--

INSERT INTO `petitii` (`ID`, `TITLU`, `INITIATOR`, `NR_VOTURI`, `TAGS`, `VALIDAT`) VALUES
(1423, 'Grigore', '', 0, '', 0),
(1423, 'Grigore', 'Andy', 9, 'viATA', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
