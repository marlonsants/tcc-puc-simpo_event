-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 13-Fev-2018 às 00:54
-- Versão do servidor: 5.7.14
-- PHP Version: 5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_4events`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_permissoes`
--

CREATE TABLE `adm_permissoes` (
  `id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `permissao_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `areas`
--

INSERT INTO `areas` (`id`, `evento_id`, `nome`, `updated_at`, `created_at`) VALUES
(1, 1, 'GESTÃO DE PESSOAS E ESTUDOS ORGANIZACIONAIS ', '2017-11-08 01:02:49', '2017-11-05 12:10:22'),
(2, 1, 'EMPREENDEDORISMO, INOVAÇÃO E TECNOLOGIA ', '2017-11-08 01:13:02', '2017-11-05 12:13:30'),
(3, 1, 'LOGÍSTICAS E OPERAÇÕES ', '2017-11-08 01:13:25', '2017-11-05 12:13:36'),
(4, 1, 'area teste 4', '2017-11-05 12:13:42', '2017-11-05 12:13:42'),
(5, 1, 'area teste 5', '2017-11-05 12:13:56', '2017-11-05 12:13:56'),
(6, 3, 'area 1', '2017-11-14 01:07:38', '2017-11-14 01:03:18'),
(7, 3, 'teste 2', '2017-11-14 01:03:25', '2017-11-14 01:03:25'),
(8, 3, 'teste 3', '2017-11-14 01:03:28', '2017-11-14 01:03:28');

-- --------------------------------------------------------

--
-- Estrutura da tabela `area_conhecimentos`
--

CREATE TABLE `area_conhecimentos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `area_conhecimentos`
--

INSERT INTO `area_conhecimentos` (`id`, `nome`) VALUES
(1, 'Ciências sociais aplicadas'),
(2, 'Engenharias'),
(3, 'Linguística, letras e artes'),
(4, 'Multidisciplinar'),
(5, 'Ciências biológicas'),
(6, 'Ciências da saúde'),
(7, 'Ciências humanas'),
(8, 'Ciências agrárias'),
(9, 'Ciências exatas e da terra');

-- --------------------------------------------------------

--
-- Estrutura da tabela `atribuicoes_avaliacoes`
--

CREATE TABLE `atribuicoes_avaliacoes` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `atribuicoes_avaliacoes`
--

INSERT INTO `atribuicoes_avaliacoes` (`id`, `evento_id`, `pessoa_id`, `trabalho_id`, `status_id`) VALUES
(21, 1, 11, 6, 1),
(2, 1, 12, 8, 1),
(3, 1, 11, 1, 1),
(4, 1, 11, 2, 0),
(5, 1, 11, 3, 0),
(6, 1, 11, 4, 0),
(7, 1, 11, 5, 0),
(8, 1, 12, 1, 0),
(9, 1, 12, 2, 0),
(10, 1, 12, 3, 0),
(11, 1, 12, 17, 0),
(13, 1, 11, 8, 1),
(14, 1, 12, 11, 1),
(15, 1, 11, 11, 1),
(16, 1, 11, 12, 1),
(17, 1, 11, 12, 1),
(18, 1, 12, 12, 1),
(19, 1, 11, 12, 1),
(20, 1, 12, 6, 1),
(22, 1, 12, 6, 1),
(23, 1, 12, 6, 1),
(24, 1, 12, 6, 1),
(25, 1, 12, 6, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `autores`
--

CREATE TABLE `autores` (
  `id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `autores`
--

INSERT INTO `autores` (`id`, `trabalho_id`, `pessoa_id`, `evento_id`) VALUES
(25, 15, 4, 1),
(26, 15, 5, 1),
(24, 15, 2, 1),
(28, 15, 15, 1),
(27, 15, 11, 1),
(29, 16, 2, 1),
(30, 17, 2, 1),
(31, 17, 4, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliacoes_status`
--

CREATE TABLE `avaliacoes_status` (
  `id` int(11) NOT NULL,
  `descricao` varchar(60) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `avaliacoes_status`
--

INSERT INTO `avaliacoes_status` (`id`, `descricao`) VALUES
(1, 'Avaliação não iniciada'),
(2, 'Em avaliação'),
(3, 'Avaliação Concluída');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avaliadores`
--

CREATE TABLE `avaliadores` (
  `id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL DEFAULT '0',
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `area_id` int(11) NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `avaliadores`
--

INSERT INTO `avaliadores` (`id`, `pessoa_id`, `evento_id`, `area_id`, `status`) VALUES
(1, 12, 1, 1, '1'),
(2, 15, 1, 3, '0'),
(3, 11, 1, 1, '1'),
(4, 12, 3, 1, '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id`, `evento_id`, `nome`, `updated_at`, `created_at`) VALUES
(1, 1, 'Categoria teste 1', '2017-11-05 12:09:24', '2017-11-05 12:09:24'),
(2, 1, 'categoria teste 2', '2017-11-05 12:09:35', '2017-11-05 12:09:35'),
(3, 1, 'categoria teste 3', '2017-11-05 12:09:44', '2017-11-05 12:09:44'),
(4, 1, 'categoria teste 4', '2017-11-05 12:09:50', '2017-11-05 12:09:50'),
(5, 1, 'categoria teste 5', '2017-11-05 12:09:58', '2017-11-05 12:09:58'),
(6, 3, 'teste 1', '2017-11-14 01:02:24', '2017-11-14 01:02:24'),
(7, 3, 'teste 2', '2017-11-14 01:02:29', '2017-11-14 01:02:29'),
(8, 3, 'teste 3', '2017-11-14 01:02:33', '2017-11-14 01:02:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `criterios`
--

CREATE TABLE `criterios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `peso` decimal(3,0) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `criterios`
--

INSERT INTO `criterios` (`id`, `nome`, `descricao`, `peso`, `evento_id`, `updated_at`, `created_at`) VALUES
(1, 'criterio teste 1 ', 'este é um teste de inserção de criterio', '2', 1, '2017-11-05 12:14:56', '2017-11-05 12:14:56'),
(2, 'criterio teste 2', 'este é um teste de inserção de criterio', '4', 1, '2017-11-05 12:15:08', '2017-11-05 12:15:08'),
(3, 'criterio teste 3', 'este é um teste de inserção de criterio', '6', 1, '2017-11-05 12:15:18', '2017-11-05 12:15:18'),
(4, 'criterio teste 4', 'este é um teste de inserção de criterio', '8', 1, '2017-11-05 12:15:37', '2017-11-05 12:15:37'),
(5, 'criterio teste 5', 'este é um teste de inserção de criterio', '10', 1, '2017-11-05 12:15:51', '2017-11-05 12:15:51');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `update_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id` int(11) NOT NULL,
  `nome_evento` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tema` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `instituicao` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `local_evento` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `inicio_submissao` date NOT NULL,
  `fim_submissao` date NOT NULL,
  `inicio_inscricoes` date NOT NULL,
  `fim_inscricoes` date NOT NULL,
  `inicio_avaliacoes` date NOT NULL,
  `fim_avaliacoes` date NOT NULL,
  `inicio_evento` date NOT NULL,
  `fim_evento` date NOT NULL,
  `num_trab_autor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `max_autores` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `max_avaliadores_trabalhos` int(11) NOT NULL,
  `max_nota_trabalhos` int(11) NOT NULL,
  `num_trab_avaliador` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `tema`, `instituicao`, `local_evento`, `inicio_submissao`, `fim_submissao`, `inicio_inscricoes`, `fim_inscricoes`, `inicio_avaliacoes`, `fim_avaliacoes`, `inicio_evento`, `fim_evento`, `num_trab_autor`, `max_autores`, `max_avaliadores_trabalhos`, `max_nota_trabalhos`, `num_trab_avaliador`, `created_at`, `updated_at`) VALUES
(1, 'Evento teste 1 testando sistema teste', 'esse é apenas um teste para validar se todas rotinas do sistema estão funcioando corretamente', 'instiuição teste 1 testando o sistema', 'teste de local do evento ', '2017-11-01', '2018-02-28', '2018-09-01', '2018-10-31', '2018-03-31', '2018-04-30', '2018-12-01', '2018-12-31', '5', '5', 3, 10, '5', '2017-11-06 01:05:04', '2018-02-08 22:24:02'),
(2, 'teste', 'teste', 'teste', 'teste', '2017-11-30', '2017-12-01', '2017-11-01', '2017-11-01', '2017-11-01', '2017-11-01', '2017-11-01', '2017-11-01', '2', '2', 2, 2, '2', '2017-11-08 01:19:33', '2017-11-08 01:21:13'),
(3, 'teste 2 teste de edição', 'teste', 'teste 2', 'Taste', '2017-11-01', '2017-11-17', '2017-12-20', '2017-12-27', '2017-11-20', '2017-12-01', '2018-01-04', '2018-01-16', '1', '1', 1, 1, '1', '2017-11-14 00:51:45', '2017-11-23 01:22:07');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_acesso_id`
--

CREATE TABLE `eventos_acesso_id` (
  `id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `acesso_id` int(11) NOT NULL,
  `concorda_termos` int(11) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `eventos_acesso_id`
--

INSERT INTO `eventos_acesso_id` (`id`, `pessoa_id`, `evento_id`, `acesso_id`, `concorda_termos`) VALUES
(1, 14, 1, 4, 1),
(10, 8, 1, 1, 1),
(9, 3, 1, 1, 1),
(8, 1, 1, 1, 1),
(7, 2, 1, 1, 1),
(11, 9, 1, 1, 1),
(12, 4, 1, 1, 1),
(13, 5, 1, 1, 1),
(14, 11, 1, 2, 1),
(15, 12, 1, 2, 1),
(16, 15, 1, 2, 1),
(17, 17, 1, 3, 0),
(18, 14, 2, 4, 1),
(19, 14, 3, 4, 1),
(20, 2, 3, 1, 1),
(26, 12, 3, 2, 1),
(27, 2, 2, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricoes`
--

CREATE TABLE `inscricoes` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `pessoa_id` int(11) NOT NULL DEFAULT '0',
  `tipo_inscricao_id` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `nivelacessos`
--

CREATE TABLE `nivelacessos` (
  `id` int(10) UNSIGNED NOT NULL,
  `descricao` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `nivelacessos`
--

INSERT INTO `nivelacessos` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Autor', '2017-01-20 13:40:19', NULL),
(2, 'Avaliador', '2017-01-20 13:40:36', NULL),
(3, 'Administrador', '2017-09-26 02:57:39', '2017-09-26 02:57:39'),
(4, 'Administrador_master', '2017-11-01 02:50:14', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `notas`
--

CREATE TABLE `notas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `avaliador_id` int(11) NOT NULL,
  `criterio_id` int(11) NOT NULL,
  `nota` float NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `notas`
--

INSERT INTO `notas` (`id`, `evento_id`, `trabalho_id`, `avaliador_id`, `criterio_id`, `nota`, `updated_at`, `created_at`) VALUES
(1, 1, 6, 12, 1, 10, '2017-11-05 19:04:43', '2017-11-05 13:54:16'),
(2, 1, 6, 12, 2, 10, '2017-11-05 19:03:37', '2017-11-05 13:54:35'),
(3, 1, 6, 12, 3, 10, '2017-11-05 19:04:46', '2017-11-05 13:54:40'),
(4, 1, 6, 12, 4, 10, '2017-11-05 13:54:43', '2017-11-05 13:54:43'),
(5, 1, 6, 12, 5, 10, '2017-11-05 19:01:42', '2017-11-05 13:54:47'),
(6, 1, 1, 11, 1, 5, '2017-11-05 15:42:01', '2017-11-05 15:42:01'),
(7, 1, 1, 11, 2, 5, '2017-11-05 15:42:05', '2017-11-05 15:42:05'),
(8, 1, 1, 11, 3, 5, '2017-11-05 15:42:09', '2017-11-05 15:42:09'),
(9, 1, 1, 11, 4, 5, '2017-11-05 15:42:12', '2017-11-05 15:42:12'),
(10, 1, 1, 11, 5, 5, '2017-11-05 15:42:19', '2017-11-05 15:42:19'),
(11, 1, 8, 12, 1, 5, '2017-11-07 21:27:27', '2017-11-07 21:27:27'),
(12, 1, 8, 12, 2, 10, '2017-11-07 21:27:31', '2017-11-07 21:27:31'),
(13, 1, 8, 12, 3, 10, '2017-11-07 21:27:33', '2017-11-07 21:27:33'),
(14, 1, 8, 12, 4, 10, '2017-11-07 21:27:34', '2017-11-07 21:27:34'),
(15, 1, 8, 12, 5, 10, '2017-11-07 21:27:37', '2017-11-07 21:27:37');

-- --------------------------------------------------------

--
-- Estrutura da tabela `paises`
--

CREATE TABLE `paises` (
  `id` int(11) NOT NULL,
  `sigla` varchar(2) DEFAULT NULL,
  `nome` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `paises`
--

INSERT INTO `paises` (`id`, `sigla`, `nome`) VALUES
(1, 'AF', 'Afeganistão'),
(2, 'AL', 'Albânia'),
(3, 'DE', 'Alemanha'),
(4, 'AD', 'Andorra'),
(5, 'AO', 'Angola'),
(6, 'AI', 'Anguilla'),
(7, 'AG', 'Antigua e Barbuda'),
(8, 'AN', 'Antilhas Holandesas'),
(9, 'AQ', 'Antártica'),
(10, 'AR', 'Argentina'),
(11, 'DZ', 'Argélia'),
(12, 'AM', 'Armênia'),
(13, 'AW', 'Aruba'),
(14, 'SA', 'Arábia Saudita'),
(15, 'AU', 'Austrália'),
(16, 'AZ', 'Azerbaijão'),
(17, 'BS', 'Bahamas'),
(18, 'BH', 'Bahrein'),
(19, 'BD', 'Bangladesh'),
(20, 'BB', 'Barbados'),
(21, 'BZ', 'Belize'),
(22, 'BJ', 'Benin'),
(23, 'BM', 'Bermuda'),
(24, 'BY', 'Bielorrússia'),
(25, 'BO', 'Bolívia'),
(26, 'BW', 'Botsuana'),
(27, 'BR', 'Brasil'),
(28, 'BN', 'Brunei'),
(29, 'BG', 'Bulgária'),
(30, 'BF', 'Burkina Faso'),
(31, 'BI', 'Burundi'),
(32, 'BT', 'Butão'),
(33, 'BE', 'Bélgica'),
(34, 'BA', 'Bósnia e Herzegovina'),
(35, 'CV', 'Cabo Verde'),
(36, 'CM', 'Camarões'),
(37, 'KH', 'Camboja'),
(38, 'CA', 'Canadá'),
(39, 'BQ', 'Caribbean Netherlands'),
(40, 'KZ', 'Cazaquistão'),
(41, 'TD', 'Chade'),
(42, 'CL', 'Chile'),
(43, 'CN', 'China'),
(44, 'CY', 'Chipre'),
(45, 'SG', 'Cingapura'),
(46, 'CO', 'Colômbia'),
(47, 'KM', 'Comores'),
(48, 'CG', 'Congo (Brazzaville)'),
(49, 'CD', 'Congo (Kinshasa)'),
(50, 'KP', 'Coréia do Norte'),
(51, 'KR', 'Coréia do Sul'),
(52, 'CI', 'Costa do Marfim'),
(53, 'CR', 'Costa Rica'),
(54, 'HR', 'Croácia'),
(55, 'CU', 'Cuba'),
(56, 'CW', 'Curaçao'),
(57, 'DK', 'Dinamarca'),
(58, 'DJ', 'Djibuti'),
(59, 'DM', 'Dominica'),
(60, 'EG', 'Egito'),
(61, 'SV', 'El Salvador'),
(62, 'AE', 'Emirados Árabes Unidos'),
(63, 'EC', 'Equador'),
(64, 'ER', 'Eritréia'),
(65, 'SK', 'Eslováquia'),
(66, 'SI', 'Eslovênia'),
(67, 'ES', 'Espanha'),
(68, 'US', 'Estados Unidos'),
(69, 'EE', 'Estônia'),
(70, 'ET', 'Etiópia'),
(71, 'FJ', 'Fiji'),
(72, 'PH', 'Filipinas'),
(73, 'FI', 'Finlândia'),
(74, 'FR', 'França'),
(75, 'GA', 'Gabão'),
(76, 'GH', 'Gana'),
(77, 'GE', 'Geórgia'),
(78, 'GI', 'Gibraltar'),
(79, 'GD', 'Granada'),
(80, 'GL', 'Groenlândia'),
(81, 'GR', 'Grécia'),
(82, 'GP', 'Guadalupe'),
(83, 'GU', 'Guam'),
(84, 'GT', 'Guatemala'),
(85, 'GG', 'Guernsey'),
(86, 'GY', 'Guiana'),
(87, 'GF', 'Guiana Francesa'),
(88, 'GN', 'Guiné'),
(89, 'GW', 'Guiné-Bissau'),
(90, 'GQ', 'Guiné Equatorial'),
(91, 'GM', 'Gâmbia'),
(92, 'HT', 'Haiti'),
(93, 'NL', 'Holanda'),
(94, 'HN', 'Honduras'),
(95, 'HK', 'Hong Kong, China'),
(96, 'HU', 'Hungria'),
(97, 'BV', 'Ilha Bouvet'),
(98, 'CX', 'Ilha Christmas'),
(99, 'IM', 'Ilha de Man'),
(100, 'HM', 'Ilha Heard e Ilhas McDonald'),
(101, 'NF', 'Ilha Norfolk'),
(102, 'AX', 'Ilhas Aland'),
(103, 'KY', 'Ilhas Cayman'),
(104, 'CC', 'Ilhas Cocos'),
(105, 'CK', 'Ilhas Cook'),
(106, 'FK', 'Ilhas Falkland'),
(107, 'FO', 'Ilhas Faroe'),
(108, 'GS', 'Ilhas Geórgia do Sul e Sandwich do Sul'),
(109, 'MP', 'Ilhas Marianas do Norte'),
(110, 'MH', 'Ilhas Marshall'),
(111, 'SB', 'Ilhas Salomão'),
(112, 'TC', 'Ilhas Turcas e Caicos'),
(113, 'VI', 'Ilhas Virgens Americanas'),
(114, 'VG', 'Ilhas Virgens Britânicas'),
(115, 'ID', 'Indonésia'),
(116, 'IQ', 'Iraque'),
(117, 'IE', 'Irlanda'),
(118, 'IR', 'Irã'),
(119, 'IS', 'Islândia'),
(120, 'IL', 'Israel'),
(121, 'IT', 'Itália'),
(122, 'YE', 'Iêmen'),
(123, 'JM', 'Jamaica'),
(124, 'JP', 'Japão'),
(125, 'JE', 'Jersey'),
(126, 'JO', 'Jordânia'),
(127, 'KI', 'Kiribati'),
(128, 'KW', 'Kuwait'),
(129, 'LA', 'Laos'),
(130, 'LS', 'Lesoto'),
(131, 'LV', 'Letônia'),
(132, 'LR', 'Libéria'),
(133, 'LI', 'Liechtenstein'),
(134, 'LT', 'Lituânia'),
(135, 'LU', 'Luxemburgo'),
(136, 'LB', 'Líbano'),
(137, 'LY', 'Líbia'),
(138, 'MO', 'Macau, China'),
(139, 'MK', 'Macedônia'),
(140, 'MG', 'Madagascar'),
(141, 'MW', 'Malauí'),
(142, 'MV', 'Maldivas'),
(143, 'ML', 'Mali'),
(144, 'MT', 'Malta'),
(145, 'MY', 'Malásia'),
(146, 'MA', 'Marrocos'),
(147, 'MQ', 'Martinica'),
(148, 'MR', 'Mauritânia'),
(149, 'MU', 'Maurício'),
(150, 'YT', 'Mayotte'),
(151, 'FM', 'Micronésia'),
(152, 'MD', 'Moldávia'),
(153, 'MN', 'Mongólia'),
(154, 'ME', 'Montenegro'),
(155, 'MS', 'Montserrat'),
(156, 'MZ', 'Moçambique'),
(157, 'MM', 'Myanmar'),
(158, 'MX', 'México'),
(159, 'MC', 'Mônaco'),
(160, 'NA', 'Namíbia'),
(161, 'NR', 'nauru'),
(162, 'NP', 'Nepal'),
(163, 'NI', 'Nicarágua'),
(164, 'NG', 'Nigéria'),
(165, 'NU', 'Niue'),
(166, 'NO', 'Noruega'),
(167, 'NC', 'Nova Caledônia'),
(168, 'NZ', 'Nova Zelândia'),
(169, 'NE', 'Níger'),
(170, 'OM', 'Omã'),
(171, 'PW', 'Palau'),
(172, 'PA', 'Panamá'),
(173, 'PG', 'Papua Nova Guiné'),
(174, 'PK', 'Paquistão'),
(175, 'PY', 'Paraguai'),
(176, 'PE', 'Peru'),
(177, 'PN', 'Pitcairn'),
(178, 'PF', 'Polinésia Francesa'),
(179, 'PL', 'Polônia'),
(180, 'PR', 'Porto Rico'),
(181, 'PT', 'Portugal'),
(182, 'QA', 'Qatar'),
(183, 'KG', 'Quirguistão'),
(184, 'KE', 'Quênia'),
(185, 'GB', 'Reino Unido'),
(186, 'CF', 'República Central Africana'),
(187, 'DO', 'República Dominicana'),
(188, 'CZ', 'República Tcheca'),
(189, 'RE', 'Reunião'),
(190, 'RO', 'Romênia'),
(191, 'RW', 'Ruanda'),
(192, 'RU', 'Rússia'),
(193, 'EH', 'Saara Ocidental'),
(194, 'PM', 'Saint-Pierre e Miquelon'),
(195, 'WS', 'Samoa'),
(196, 'AS', 'Samoa Americana'),
(197, 'SM', 'San Marino'),
(198, 'MF', 'San Martin (parte Francesa)'),
(199, 'SH', 'Santa Helena'),
(200, 'LC', 'Santa Lúcia'),
(201, 'SN', 'Senegal'),
(202, 'SL', 'Serra Leoa'),
(203, 'SC', 'Seychelles'),
(204, 'SX', 'Sint Maarten'),
(205, 'SO', 'Somália'),
(206, 'SS', 'South Sudan'),
(207, 'LK', 'Sri Lanka'),
(208, 'SZ', 'Suazilândia'),
(209, 'SD', 'Sudão'),
(210, 'SR', 'Suriname'),
(211, 'SE', 'Suécia'),
(212, 'CH', 'Suíça'),
(213, 'SJ', 'Svalbard e Jan Mayen'),
(214, 'BL', 'São Bartolomeu'),
(215, 'KN', 'São Kitts e Nevis'),
(216, 'ST', 'São Tomé e Príncipe'),
(217, 'VC', 'São Vicente e Granadinas'),
(218, 'RS', 'Sérvia'),
(219, 'SY', 'Síria'),
(220, 'TJ', 'Tadjiquistão'),
(221, 'TH', 'Tailândia'),
(222, 'TW', 'Taiwan'),
(223, 'TZ', 'Tanzânia'),
(224, 'IO', 'Território Britânico do Oceano Índico'),
(225, 'PS', 'Território Palestino'),
(226, 'TF', 'Territórios Franceses do Sul'),
(227, 'UM', 'Territórios Insulares dos Estados Unidos'),
(228, 'TL', 'Timor Leste'),
(229, 'TG', 'Togo'),
(230, 'TO', 'tonganês'),
(231, 'TK', 'Toquelau'),
(232, 'TT', 'Trinidad e Tobago'),
(233, 'TN', 'Tunísia'),
(234, 'TM', 'Turcomenistão'),
(235, 'TR', 'Turquia'),
(236, 'TV', 'Tuvalu'),
(237, 'UA', 'Ucrânia'),
(238, 'UG', 'Uganda'),
(239, 'UY', 'Uruguai'),
(240, 'UZ', 'Uzbequistão'),
(241, 'VU', 'Vanuatu'),
(242, 'VA', 'Vaticano'),
(243, 'VE', 'Venezuela'),
(244, 'VN', 'Vietnã'),
(245, 'WF', 'Wallis e Futuna'),
(246, 'ZW', 'Zimbabue'),
(247, 'ZM', 'Zâmbia'),
(248, 'ZA', 'África do Sul'),
(249, 'AT', 'Áustria'),
(250, 'IN', 'Índia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `parecer_avaliacao`
--

CREATE TABLE `parecer_avaliacao` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `avaliador_id` int(11) NOT NULL,
  `parecer` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `perguntas`
--

CREATE TABLE `perguntas` (
  `id` int(11) NOT NULL,
  `pergunta` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissoes`
--

CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `permissoes`
--

INSERT INTO `permissoes` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Autores', '2017-10-31 00:53:57', '2017-10-31 00:53:57'),
(2, 'Trabalhos', '2017-10-31 00:53:57', NULL),
(3, 'Avaliadores', '2017-10-31 00:53:57', NULL),
(4, 'Cadastros', '2017-10-31 00:53:57', NULL),
(5, 'Dashboard', '2017-10-31 00:53:57', NULL),
(7, 'Dowloads', '2017-10-31 00:53:57', NULL),
(6, 'Pre-avaliador', '2017-10-31 00:53:57', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `nome` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `nascimento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sexo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `rg` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logradouro` varchar(70) COLLATE utf8_unicode_ci NOT NULL,
  `numero` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `complemento` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `cidade` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `estado` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `CEP` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `pais` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `instituicao` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `titulo` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `celular` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contato` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pergunta_id` int(11) NOT NULL,
  `resposta_seguranca` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `status`, `nome`, `nascimento`, `sexo`, `cpf`, `rg`, `logradouro`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `CEP`, `pais`, `instituicao`, `titulo`, `telefone`, `celular`, `contato`, `email`, `senha`, `pergunta_id`, `resposta_seguranca`, `created_at`, `updated_at`) VALUES
(1, 'A', 'Cardoso Autor 1', '12/12/1991', 'Masculino', '121.212.121-21', '12.121.212-1', 'Cardoso Autor 1', '1212', '', 'Cardoso Autor 1', 'Cardoso Autor 1', 'SP', '12.121-212', 'Brasil', 'Cardoso Autor 1', 'Estudante', '(12) 1212-1212', '(12) 12121-2121', '', 'cardosoautor1@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:18:38', '2017-11-05 10:18:38'),
(2, 'A', 'marlonAutor1', '07/08/1995', 'Masculino', '111.111.111-11', '11.111.111-1', 'teste de endereço número 1', '111', 'casa', 'teste de bairro 1', 'teste de cidade 1', 'SP', '11.111-111', 'Brasil', 'teste de inserção de instituição número 1', 'Estudante', '(11) 1111-1111', '(11) 11111-1111', '(11) 11111-1111', 'marlon@gmail1.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:20:49', '2017-11-05 10:20:49'),
(3, 'A', 'Cardoso Autor 2', '12/12/1992', 'Masculino', '131.313.131-31', '13.131.313-1', 'Cardoso Autor 2', '1313', '', 'Cardoso Autor 2', 'Cardoso Autor 2', 'SP', '13.131-313', 'Brasil', 'Cardoso Autor 2', 'Estudante', '(13) 1313-1313', '(13) 13131-3131', '', 'cardosoautor2@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:23:12', '2017-11-05 10:23:12'),
(4, 'A', 'marlonAutor2', '07/08/1995', 'Feminino', '222.222.222-22', '22.222.222-2', 'teste de endereço número 2', '222', 'casa 2', 'teste de bairro 2', 'teste de cidade 2', 'AL', '22.222-222', 'África do Sul', 'teste de inserção de instituição número 2', 'Doutor', '(22) 2222-2222', '(22) 22222-2222', '', 'marlon@gmail2.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:25:47', '2017-11-05 10:25:47'),
(5, 'A', 'marlonAutor3', '07/08/1995', 'Masculino', '333.333.333-33', '33.333.333-3', 'teste de endereço número 3', '333', 'casa 3', 'teste de bairro 3', 'teste de cidade 3', 'SP', '33.333-333', 'Brasil', 'teste de inserção de instituição número 2', 'Estudante', '(33) 3333-3333', '(33) 33333-3333', '(33) 33333-3333', 'marlon@gmail3.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:37:15', '2017-11-05 10:29:27'),
(6, 'A', 'marlonAutor4', '07/08/1995', 'Masculino', '444.444.444-44', '44.444.444-4', 'teste de endereço número 4', '444', 'casa 4', 'teste de bairro 4', 'teste de cidade 4', 'GO', '44.444-444', 'Alemanha', 'teste de inserção de instituição número 4', 'Professor', '(44) 4444-4444', '(44) 44444-4444', '(44) 44444-4444', 'marlon@gmail4.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:33:22', '2017-11-05 10:33:22'),
(7, 'A', 'marlonAutor5', '07/08/2005', 'Masculino', '555.555.555-55', '55.555.555-5', 'teste de endereço número 5$%¨\'', '555', 'casa 5', 'teste de bairro 5', 'teste de cidade 5', 'MA', '55.555-555', 'Azerbaijão', 'teste de inserção de instituição número 4@#$', 'Estudante', '(55) 5555-5555', '(55) 55555-5555', '(55) 55555-5555', 'marlon@gmail5.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:36:23', '2017-11-05 10:36:23'),
(8, 'A', 'Cardoso Autor 3', '11/11/1991', 'Masculino', '141.414.141-41', '14.141.414-1', 'Cardoso Autor 3', '1414', '', 'Cardoso Autor 3', 'Cardoso Autor 3', 'SP', '14.141-414', 'Brasil', 'Cardoso Autor 3', 'Estudante', '(14) 1414-1414', '(14) 14141-4141', '', 'cardosoautor3@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:39:04', '2017-11-05 10:39:04'),
(9, 'A', 'Cardoso Autor 4', '10/10/1990', 'Masculino', '151.515.151-51', '15.151.515-1', 'Cardoso Autor 4', '1515', '', 'Cardoso Autor 4', 'Cardoso Autor 4', 'SP', '15.151-515', 'Brasil', 'Cardoso Autor 4', 'Estudante', '(15) 1515-1515', '(15) 15151-5151', '', 'cardosoautor4@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:41:49', '2017-11-05 10:41:49'),
(10, 'A', 'Cardoso Autor 5', '09/09/1989', 'Masculino', '161.616.161-6', '16.161.616-1', 'Cardoso Autor 5', '1616', '', 'Cardoso Autor 5', 'Cardoso Autor 5', 'SP', '16.161-616', 'Brasil', 'Cardoso Autor 5', 'Estudante', '(16) 1616-1616', '(16) 16161-6161', '', 'cardosoautor5@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:46:34', '2017-11-05 10:46:34'),
(11, 'A', 'Cardoso Avaliador 1', '08/08/1998', 'Masculino', '161.616.161-61', '16.161.616-1', 'Cardoso Avaliador 1', '1616', '', 'Cardoso Avaliador 1', 'Cardoso Avaliador 1', 'SP', '16.161-616', 'Brasil', 'Cardoso Avaliador 1', 'Doutor', '(16) 1616-1616', '(16) 16161-6161', '', 'cardosoavaliador1@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:54:41', '2017-11-05 10:54:41'),
(12, 'A', 'marlonAvaliador1', '07/08/1995', 'Masculino', '666.666.666-66', '66.666.666-6', 'teste de endereço número 6()*&¨%', '666', 'casa 6', 'teste de bairro 6', 'teste de cidade 6', 'MT', '66.666-666', 'Baamas', 'teste de inserção de instituição número 6@#$', 'Estudante', '(66) 6666-6666', '(66) 66666-6666', '(66) 66666-6666', 'marlon@avaliador1.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:54:55', '2017-11-05 10:54:55'),
(13, 'A', 'marlonAvaliador2\'$%&', '07/08/1995', 'Masculino', '777.777.777-77', '77.777.777-7', 'teste de endereço número 7', '777', 'casa 7', 'teste de bairro 7', 'teste de cidade 7', 'MS', '77.777-777', 'Brasil', 'teste de inserção de instituição número 7', 'Estudante', '(77) 7777-7777', '(77) 77777-7777', '(77) 77777-7777', 'marlon@avaliador2.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:56:58', '2017-11-05 10:56:58'),
(14, 'A', 'marlonAdmMaster', '07/08/1995', 'Masculino', '888.888.888-88', '88.888.888-8', 'teste de endereço número 8', '888', 'casa 1', 'teste de bairro 1', 'teste de cidade 1', 'MG', '88.888-888', 'Bangladeche', 'teste de inserção de instituição número 8', 'Doutor', '(88) 8888-8888', '(88) 88888-8888', '(88) 88888-8888', 'marlon@admMaster.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 10:58:48', '2017-11-05 10:58:48'),
(15, 'A', 'Cardoso Avaliador 2', '07/07/1997', 'Masculino', '171.717.171-71', '17.171.717-1', 'Cardoso Avaliador 2', '1717', '', 'Cardoso Avaliador 2', 'Cardoso Avaliador 2', 'SP', '17.171-717', 'Brasil', 'Cardoso Avaliador 2', 'Professor', '(17) 1717-1717', '(17) 17171-7171', '', 'cardosoavaliador2@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 11:01:04', '2017-11-05 11:01:04'),
(16, 'A', 'Cardoso Master', '10/10/1970', 'Feminino', '181.818.181-81', '18.181.818-1', 'Cardoso Master', '1818', '', 'Cardoso Master', 'Cardoso Master', 'SP', '18.181-818', 'Brasil', 'Cardoso Master', 'Mestre', '(18) 1818-1818', '(18) 18181-8181', '', 'cardosomaster@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 11:05:15', '2017-11-05 11:05:15'),
(17, 'A', 'Cardoso Adm 1', '05/05/1990', 'Masculino', '191.919.191-91', '19.191.919-1', 'Cardoso Adm 1', '1919', '', 'Cardoso Adm 1', 'Cardoso Adm 1', 'SP', '19.191-919', 'Brasil', 'Cardoso Adm 1', 'Estudante', '(19) 1919-1919', '(19) 19191-1919', '', 'cardosoadm1@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 11:33:38', '2017-11-05 11:33:38'),
(18, 'A', 'Cardoso Adm 2', '10/10/1990', 'Masculino', '202.020.202-02', '20.202.020-2', 'Cardoso Adm 2', '2020', '', 'Cardoso Adm 2', 'Cardoso Adm 2', 'RO', '20.202-020', 'Argentina', 'Cardoso Adm 2', 'Professor', '(20) 2020-2020', '(20) 20202-0202', '', 'cardosoadm2@gmail.com', '202cb962ac59075b964b07152d234b70', 0, '', '2017-11-05 11:38:24', '2017-11-05 11:38:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pre_avaliacao`
--

CREATE TABLE `pre_avaliacao` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `pre_avaliador_id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `observacao` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `receitas`
--

CREATE TABLE `receitas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `subarea_conhecimentos`
--

CREATE TABLE `subarea_conhecimentos` (
  `id` int(11) NOT NULL,
  `areaconhecimento_id` int(11) NOT NULL DEFAULT '0',
  `nome` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `subarea_conhecimentos`
--

INSERT INTO `subarea_conhecimentos` (`id`, `areaconhecimento_id`, `nome`) VALUES
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_incricoes`
--

CREATE TABLE `tipos_incricoes` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `preco` float NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_eventos`
--

CREATE TABLE `tipo_eventos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tipo_eventos`
--

INSERT INTO `tipo_eventos` (`id`, `nome`) VALUES
(1, 'Colóquio'),
(2, 'Conferência'),
(3, 'Congresso'),
(4, 'Encontro'),
(5, 'Mini-Curso'),
(6, 'Seminário'),
(7, 'Simpósio'),
(8, 'Workshop'),
(9, 'Palestras'),
(10, 'Treinamentos');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhos`
--

CREATE TABLE `trabalhos` (
  `id` int(11) NOT NULL,
  `titulo` varchar(500) NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `resumo` varchar(2500) NOT NULL,
  `palavra_chave` varchar(200) NOT NULL,
  `abstract` varchar(2500) NOT NULL,
  `key_word` varchar(200) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `trabalhos`
--

INSERT INTO `trabalhos` (`id`, `titulo`, `categoria_id`, `area_id`, `status_id`, `resumo`, `palavra_chave`, `abstract`, `key_word`, `evento_id`, `updated_at`, `created_at`) VALUES
(17, 'tes', 1, 1, 4, 'teste', 'teste', 'teste', 'teste', 1, '2018-02-10 00:56:33', '2018-02-10 00:56:33'),
(15, 'teste', 1, 1, 4, 'teste', 'teste', 'teste', 'teste', 1, '2018-02-10 00:44:11', '2018-02-10 00:44:11'),
(16, 'tes', 1, 1, 4, 'teste', 'teste', 'teste', 'teste', 1, '2018-02-10 00:55:43', '2018-02-10 00:55:43');

-- --------------------------------------------------------

--
-- Estrutura da tabela `trabalhos_status`
--

CREATE TABLE `trabalhos_status` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `trabalhos_status`
--

INSERT INTO `trabalhos_status` (`id`, `descricao`) VALUES
(1, 'Aprovado'),
(2, 'Reprovado'),
(3, 'Em avaliação'),
(4, 'PDF não enviado');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `trabalho_id` int(11) NOT NULL,
  `arquivo_id` varchar(70) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `adm_permissoes`
--
ALTER TABLE `adm_permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `area_conhecimentos`
--
ALTER TABLE `area_conhecimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `atribuicoes_avaliacoes`
--
ALTER TABLE `atribuicoes_avaliacoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avaliacoes_status`
--
ALTER TABLE `avaliacoes_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `avaliadores`
--
ALTER TABLE `avaliadores`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `criterios`
--
ALTER TABLE `criterios`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `eventos_acesso_id`
--
ALTER TABLE `eventos_acesso_id`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `inscricoes`
--
ALTER TABLE `inscricoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nivelacessos`
--
ALTER TABLE `nivelacessos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notas`
--
ALTER TABLE `notas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paises`
--
ALTER TABLE `paises`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parecer_avaliacao`
--
ALTER TABLE `parecer_avaliacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissoes`
--
ALTER TABLE `permissoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pre_avaliacao`
--
ALTER TABLE `pre_avaliacao`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `receitas`
--
ALTER TABLE `receitas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subarea_conhecimentos`
--
ALTER TABLE `subarea_conhecimentos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipos_incricoes`
--
ALTER TABLE `tipos_incricoes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trabalhos`
--
ALTER TABLE `trabalhos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `trabalhos_status`
--
ALTER TABLE `trabalhos_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `adm_permissoes`
--
ALTER TABLE `adm_permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `area_conhecimentos`
--
ALTER TABLE `area_conhecimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `atribuicoes_avaliacoes`
--
ALTER TABLE `atribuicoes_avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `avaliacoes_status`
--
ALTER TABLE `avaliacoes_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `avaliadores`
--
ALTER TABLE `avaliadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `eventos_acesso_id`
--
ALTER TABLE `eventos_acesso_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;
--
-- AUTO_INCREMENT for table `inscricoes`
--
ALTER TABLE `inscricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `nivelacessos`
--
ALTER TABLE `nivelacessos`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `paises`
--
ALTER TABLE `paises`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;
--
-- AUTO_INCREMENT for table `parecer_avaliacao`
--
ALTER TABLE `parecer_avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissoes`
--
ALTER TABLE `permissoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `pre_avaliacao`
--
ALTER TABLE `pre_avaliacao`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `receitas`
--
ALTER TABLE `receitas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `subarea_conhecimentos`
--
ALTER TABLE `subarea_conhecimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;
--
-- AUTO_INCREMENT for table `tipos_incricoes`
--
ALTER TABLE `tipos_incricoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tipo_eventos`
--
ALTER TABLE `tipo_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `trabalhos`
--
ALTER TABLE `trabalhos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `trabalhos_status`
--
ALTER TABLE `trabalhos_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
