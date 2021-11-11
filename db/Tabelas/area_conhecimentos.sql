-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           5.7.14 - MySQL Community Server (GPL)
-- OS do Servidor:               Win32
-- HeidiSQL Versão:              9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Copiando estrutura do banco de dados para db_4events
CREATE DATABASE IF NOT EXISTS `db_4events` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `db_4events`;


-- Copiando estrutura para tabela db_4events.area_conhecimentos
CREATE TABLE IF NOT EXISTS `area_conhecimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela db_4events.area_conhecimentos: 9 rows
/*!40000 ALTER TABLE `area_conhecimentos` DISABLE KEYS */;
REPLACE INTO `area_conhecimentos` (`id`, `nome`) VALUES
	(1, 'Ciências sociais aplicadas'),
	(2, 'Engenharias'),
	(3, 'Linguística, letras e artes'),
	(4, 'Multidisciplinar'),
	(5, 'Ciências biológicas'),
	(6, 'Ciências da saúde'),
	(7, 'Ciências humanas'),
	(8, 'Ciências agrárias'),
	(9, 'Ciências exatas e da terra');
/*!40000 ALTER TABLE `area_conhecimentos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
