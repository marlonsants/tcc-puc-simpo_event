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


-- Copiando estrutura para tabela db_4events.subarea_conhecimentos
CREATE TABLE IF NOT EXISTS `subarea_conhecimentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `areaconhecimento_id` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela db_4events.subarea_conhecimentos: 26 rows
/*!40000 ALTER TABLE `subarea_conhecimentos` DISABLE KEYS */;
REPLACE INTO `subarea_conhecimentos` (`id`, `areaconhecimento_id`, `nome`) VALUES
	(1, 1, 'Administração'),
	(2, 1, 'Arquitetura e urbanismo'),
	(3, 1, 'Museologia'),
	(4, 1, 'Ciência da informação'),
	(5, 1, 'Demografia'),
	(6, 1, 'Comunicação'),
	(7, 1, 'Desenho industrial'),
	(8, 1, 'Direito'),
	(9, 1, 'Economia'),
	(10, 1, 'Planejamento urbano e regional'),
	(11, 1, 'Serviço social'),
	(12, 1, 'Turismo'),
	(13, 2, 'Engenharia aeroespacial'),
	(14, 2, 'Engenharia ambiental e sanitária'),
	(15, 2, 'Engenharia biomédica'),
	(16, 2, 'Engenharia civil'),
	(17, 2, 'Engenharia de materiais e metalúrgica'),
	(18, 2, 'Engenharia de minas'),
	(19, 2, 'Engenharia de produção'),
	(20, 2, 'Engenharia de transportes'),
	(21, 2, 'Engenharia elétrica'),
	(22, 2, 'Engenharia mecânica'),
	(23, 2, 'Engenharia naval e oceânica'),
	(24, 2, 'Engenharia nuclear'),
	(25, 2, 'Engenharia química'),
	(26, 3, 'Artes'),
	(27, 3, 'Letras'),
	(28, 3, 'Linguística'),
	(29, 4, 'Biotecnologia'),
	(30, 4, 'Interdisciplinar'),
	(31, 4, 'Materiais'),
	(32, 4, 'Ensino'),
	(33, 5, 'Genética'),
	(34, 5, 'Fisiologia'),
	(35, 5, 'Ecologia'),
	(36, 5, 'Botânica'),
	(37, 5, 'Imunologia'),
	(38, 5, 'Microbiologia'),
	(39, 5, 'Parasitologia'),
	(40, 5, 'Oceanografia'),
	(41, 5, 'Morfologia'),
	(42, 5, 'Bioquímica'),
	(43, 5, 'Biologia geral'),
	(44, 5, 'Biofísica'),
	(45, 5, 'Zoologia'),
	(46, 6, 'Saúde coletiva'),
	(47, 6, 'Farmácia'),
	(48, 6, 'Enfermagem'),
	(49, 6, 'Educação física'),
	(50, 6, 'Fisioterapia e terapia ocupacional'),
	(51, 6, 'Fonoaudiologia'),
	(52, 6, 'Odontologia'),
	(53, 6, 'Nutrição'),
	(54, 6, 'Medicina'),
	(55, 7, 'Teologia'),
	(56, 7, 'Filosofia'),
	(57, 7, 'Ciência política'),
	(58, 7, 'Arqueologia'),
	(59, 7, 'Antropologia'),
	(60, 7, 'Educação'),
	(61, 7, 'Psicologia'),
	(62, 7, 'História'),
	(63, 7, 'Geografia'),
	(64, 7, 'Sociologia'),
	(65, 8, 'Medicina veterinária'),
	(66, 8, 'Engenharia agrícola'),
	(67, 8, 'Ciência e tecnologia de alimentos'),
	(68, 8, 'Agronomia'),
	(69, 8, 'Recursos florestais e engenharia florestal'),
	(70, 8, 'Recursos pesqueiros e engenharia de pesca'),
	(71, 8, 'Zootecnia'),
	(72, 9, 'Astronomia'),
	(73, 9, 'Ciência da computação'),
	(74, 9, 'Física'),
	(75, 9, 'Geociências'),
	(76, 9, 'Matemática'),
	(77, 9, 'Matemática Aplicada'),
	(78, 9, 'Probabilidade e estatística'),
	(79, 9, 'Química');
/*!40000 ALTER TABLE `subarea_conhecimentos` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
