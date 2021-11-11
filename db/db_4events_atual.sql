-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 19-Out-2017 às 00:02
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
-- Estrutura da tabela `adm_eventos`
--

CREATE TABLE `adm_eventos` (
  `id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `areas`
--

CREATE TABLE `areas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `categoria_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `areas`
--

INSERT INTO `areas` (`id`, `evento_id`, `nome`, `cor`, `categoria_id`, `updated_at`, `created_at`) VALUES
(1, 31, 'area1', '', 2, '2017-10-11 23:07:37', '2017-10-11 23:07:37'),
(2, 31, 'area 2', '', 2, '2017-10-11 23:07:37', '2017-10-11 23:07:37'),
(3, 31, 'area 3', '', 2, '2017-10-11 23:08:45', '2017-10-11 23:08:45');

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
  `status` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `nome` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `cor` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL DEFAULT '0',
  `descricao` text COLLATE utf8_unicode_ci NOT NULL,
  `valor` float NOT NULL,
  `created_at` timestamp NOT NULL,
  `update_at` timestamp NOT NULL
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
  `inicio_submissao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fim_submissao` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `inicio_inscricoes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fim_inscricoes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `inicio_avaliacoes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fim_avaliacoes` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `inicio_evento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `fim_evento` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `num_trab_autor` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `max_autores` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `max_avaliadores_trabalhos` int(11) NOT NULL,
  `max_nota_trabalhos` int(11) NOT NULL,
  `num_trab_avaliador` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `eventos`
--

INSERT INTO `eventos` (`id`, `nome_evento`, `tema`, `instituicao`, `local_evento`, `inicio_submissao`, `fim_submissao`, `inicio_inscricoes`, `fim_inscricoes`, `inicio_avaliacoes`, `fim_avaliacoes`, `inicio_evento`, `fim_evento`, `num_trab_autor`, `max_autores`, `max_avaliadores_trabalhos`, `max_nota_trabalhos`, `num_trab_avaliador`, `created_at`, `updated_at`) VALUES
(31, 'Tecnologia', 'evento de tecnologia', 'Faculdade ', 'jaboticabal', '2017-01-20', '2017-10-25', '2017-03-31', '2017-04-30', '2017-10-30', '2017-02-28', '2017-05-01', '2017-05-04', '10', '5', 2, 0, '5', '2017-01-16 21:21:06', '2017-01-16 21:21:06'),
(32, 'agronomia', 'evento de agronomia', 'Faculdade ', 'jaboticabal', '2017-01-01', '2017-02-28', '2017-03-31', '2017-04-30', '2017-01-01', '2017-02-28', '2017-05-01', '2017-05-04', '5', '5', 2, 0, '5', '2017-01-16 23:21:06', '2017-01-16 23:21:06'),
(39, 'expoMEd', 'medicina aplicada ao esporte', 'usp', 'ribeirão preto', '2017-01-01', '2017-01-04', '2017-01-13', '2017-01-17', '2017-01-07', '2017-01-10', '2017-01-20', '2017-01-23', '5', '5', 5, 5, '5', '2017-01-31 15:29:10', '2017-01-31 15:29:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos_acesso_id`
--

CREATE TABLE `eventos_acesso_id` (
  `id` int(11) NOT NULL,
  `pessoa_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `acesso_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `nivelacessos`
--

INSERT INTO `nivelacessos` (`id`, `descricao`, `created_at`, `updated_at`) VALUES
(1, 'Autor', '2017-01-20 13:40:19', NULL),
(2, 'Avaliador', '2017-01-20 13:40:36', NULL),
(5, 'Administrador', '2017-09-26 02:57:39', '2017-09-26 02:57:39');

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
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_nivelacessos`
--

CREATE TABLE `pessoa_nivelacessos` (
  `id` int(11) NOT NULL,
  `descricao` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL
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
  `resumo` varchar(1500) NOT NULL,
  `palavra_chave` varchar(200) NOT NULL,
  `abstract` varchar(1500) NOT NULL,
  `key_word` varchar(200) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `updated_at` timestamp NOT NULL,
  `created_at` timestamp NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Indexes for table `adm_eventos`
--
ALTER TABLE `adm_eventos`
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
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pessoa_nivelacessos`
--
ALTER TABLE `pessoa_nivelacessos`
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
-- AUTO_INCREMENT for table `adm_eventos`
--
ALTER TABLE `adm_eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `area_conhecimentos`
--
ALTER TABLE `area_conhecimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `atribuicoes_avaliacoes`
--
ALTER TABLE `atribuicoes_avaliacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `avaliadores`
--
ALTER TABLE `avaliadores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `criterios`
--
ALTER TABLE `criterios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `despesas`
--
ALTER TABLE `despesas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `eventos_acesso_id`
--
ALTER TABLE `eventos_acesso_id`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `notas`
--
ALTER TABLE `notas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `pessoa_nivelacessos`
--
ALTER TABLE `pessoa_nivelacessos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `trabalhos_status`
--
ALTER TABLE `trabalhos_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
