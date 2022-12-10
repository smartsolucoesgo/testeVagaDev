-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 10-Dez-2022 às 02:53
-- Versão do servidor: 8.0.29
-- versão do PHP: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `jube`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `commitment`
--

CREATE TABLE `commitment` (
  `id` int NOT NULL,
  `id_user` int NOT NULL,
  `title_commitment` varchar(250) NOT NULL,
  `description_commitment` varchar(250) NOT NULL,
  `date_commitment` datetime NOT NULL,
  `date_commitment_end` datetime DEFAULT NULL,
  `id_update_user` int DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `commitment`
--

INSERT INTO `commitment` (`id`, `id_user`, `title_commitment`, `description_commitment`, `date_commitment`, `date_commitment_end`, `id_update_user`, `created_at`) VALUES
(3, 21, 'Tarefa 3', 'Essa é o compromisso nº 3', '2022-12-10 18:15:00', NULL, 21, '2022-12-09 17:14:49'),
(6, 21, 'teste ', 'Sempre testando', '2022-12-09 21:00:00', NULL, 21, '2022-12-09 21:01:00'),
(7, 21, 'Datas dinâmicas', 'Datas dinâmicas concluída', '2022-12-16 23:43:00', '2022-12-22 23:43:00', 21, '2022-12-09 23:44:21'),
(8, 21, '2 dias', '2 dias testando', '2022-12-25 23:46:00', '2022-12-26 23:46:00', 21, '2022-12-09 23:46:33'),
(9, 21, '2 dias', '2 dias testando', '2022-12-25 23:46:00', '2022-12-26 23:46:00', 21, '2022-12-09 23:47:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `configuracao`
--

CREATE TABLE `configuracao` (
  `id` int NOT NULL,
  `app_title` varchar(255) NOT NULL,
  `protocol` enum('http://','https://') NOT NULL,
  `environment` enum('Desenvolvimento','Produção') NOT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_user` varchar(255) DEFAULT NULL,
  `mail_pass` varchar(255) DEFAULT NULL,
  `mail_auth` enum('true','false') DEFAULT 'true',
  `mail_secure` enum('ssl','tls') DEFAULT 'ssl',
  `mail_port` int DEFAULT '465',
  `mail_sendtype` enum('isSMTP','isMAIL') DEFAULT 'isSMTP',
  `mail_contact` varchar(255) DEFAULT '',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_update_user` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `configuracao`
--

INSERT INTO `configuracao` (`id`, `app_title`, `protocol`, `environment`, `mail_host`, `mail_user`, `mail_pass`, `mail_auth`, `mail_secure`, `mail_port`, `mail_sendtype`, `mail_contact`, `data_cadastro`, `data_alteracao`, `id_update_user`, `status`) VALUES
(1, 'SMART Soluções Inteligentes', 'http://', 'Desenvolvimento', 'smtp.hostinger.com.br', 'no-reply@smartsolucoesinteligentes.com.br', '02081992', 'true', 'tls', 587, 'isSMTP', 'joaopaulo@informaticajk.com.br', '2020-01-27 19:45:19', '2020-08-11 22:43:10', 21, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `acesso` enum('Administrador','Vendedor') NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nascimento` varchar(20) DEFAULT '',
  `cpf` varchar(15) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `telefone` varchar(255) DEFAULT '',
  `endereco` varchar(100) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(100) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cep` varchar(15) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(10) DEFAULT NULL,
  `banco` varchar(50) DEFAULT NULL,
  `agencia` varchar(50) DEFAULT NULL,
  `conta` varchar(50) DEFAULT NULL,
  `op_vr` varchar(50) DEFAULT NULL,
  `tipo_conta` enum('CC','CP') DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT 'assets/img/avatar.jpg',
  `session` varchar(255) DEFAULT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `id_update_user` int DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `acesso`, `nome`, `data_nascimento`, `cpf`, `rg`, `telefone`, `endereco`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `estado`, `banco`, `agencia`, `conta`, `op_vr`, `tipo_conta`, `email`, `senha`, `imagem`, `session`, `data_cadastro`, `data_alteracao`, `id_update_user`, `status`) VALUES
(21, 'Administrador', 'Administrador', '02/08/1992', '111.111.111-11', '11111', '(62) 9999-99999', 'Rua', '0', 'Ap 100', 'Residencial', '74000-000', 'Goiânia', 'GO', NULL, NULL, NULL, NULL, NULL, 'admin@admin.com', '$2y$12$ppFcsC0oV8Vja8iizu75be9/kYaKdKOblpjhk075mggFiI5qwNnK6', 'assets/img/avatar.jpg', NULL, '2020-06-10 01:04:39', '2020-08-11 22:35:26', 21, 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `commitment`
--
ALTER TABLE `commitment`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `configuracao`
--
ALTER TABLE `configuracao`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `commitment`
--
ALTER TABLE `commitment`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `configuracao`
--
ALTER TABLE `configuracao`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
