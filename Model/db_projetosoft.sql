-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 06-Jun-2020 às 19:31
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_projetosoft`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `log_acesso`
--

DROP TABLE IF EXISTS `log_acesso`;
CREATE TABLE `log_acesso` (
  `id_log` int(11) NOT NULL,
  `login_acesso` varchar(200) CHARACTER SET utf8 DEFAULT NULL,
  `situacao` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  `data_hora` timestamp NOT NULL DEFAULT current_timestamp(),
  `IP` varchar(30) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `log_acesso`
--

INSERT INTO `log_acesso` (`id_log`, `login_acesso`, `situacao`, `data_hora`, `IP`) VALUES
(1, '117.837.424-61', 'PERMITIDO', '2020-06-05 04:54:47', '::1'),
(2, 'c3c0678baa8c0942ea114371c5831c7c', 'PERMITIDO', '2020-06-05 16:52:33', '::1'),
(3, 'ce9a4588548b5a248a2d3af0a886b827', 'NEGADO', '2020-06-05 16:53:12', '::1'),
(4, 'ce9a4588548b5a248a2d3af0a886b827', 'NEGADO', '2020-06-05 16:53:38', '::1'),
(5, '117.837.424-61', 'PERMITIDO', '2020-06-05 17:04:06', '::1'),
(6, '117.837.424-61', 'PERMITIDO', '2020-06-05 17:18:59', '::1'),
(7, '117.837.424-61', 'PERMITIDO', '2020-06-06 15:22:41', '::1'),
(8, '117.837.424-61', 'PERMITIDO', '2020-06-06 15:52:21', '::1'),
(9, '117.837.424-61', 'NEGADO', '2020-06-06 15:52:52', '::1'),
(10, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:06:59', '::1'),
(11, '117.837.424-61', 'NEGADO', '2020-06-06 16:15:08', '::1'),
(12, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:16:50', '::1'),
(13, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:16:58', '::1'),
(14, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:18:08', '::1'),
(15, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:18:42', '::1'),
(16, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:19:15', '::1'),
(17, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:20:31', '::1'),
(18, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:21:09', '::1'),
(19, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:22:05', '::1'),
(20, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:22:25', '::1'),
(21, '117.837.424-61', 'NEGADO', '2020-06-06 16:24:58', ''),
(22, '117.837.424-61', 'NEGADO', '2020-06-06 16:24:58', ''),
(23, '117.837.424-61', 'NEGADO', '2020-06-06 16:25:26', ''),
(24, '117.837.424-61', 'NEGADO', '2020-06-06 16:27:20', ''),
(25, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:27:32', '::1'),
(26, '117.837.424-61', 'PERMITIDO', '2020-06-06 16:29:52', '::1'),
(27, '117.837.424-61', 'NEGADO', '2020-06-06 16:37:39', ''),
(28, '117.837.424-61', 'NEGADO', '2020-06-06 16:38:07', '::1'),
(29, '117.837.424-61', 'NEGADO', '2020-06-06 16:38:19', '::1'),
(30, '117.837.424-61', 'NEGADO', '2020-06-06 17:17:34', '::1'),
(31, '117.837.424-61', 'NEGADO', '2020-06-06 17:18:38', '::1'),
(32, '117.837.424-61', 'NEGADO', '2020-06-06 17:18:51', '::1'),
(33, '117.837.424-61', 'NEGADO', '2020-06-06 17:19:08', '::1'),
(34, '117.837.424-61', 'NEGADO', '2020-06-06 17:24:24', '::1'),
(35, '117.837.424-61', 'NEGADO', '2020-06-06 17:24:48', '::1'),
(36, '117.837.424-61', 'NEGADO', '2020-06-06 17:25:05', '::1'),
(37, '117.837.424-61', 'NEGADO', '2020-06-06 17:26:15', '::1'),
(38, '117.837.424-61', 'PERMITIDO', '2020-06-06 17:27:09', '::1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `login_usuario` varchar(64) CHARACTER SET utf8 NOT NULL,
  `senha_usuario` varchar(64) CHARACTER SET utf8 NOT NULL,
  `nome` varchar(50) CHARACTER SET utf8 NOT NULL,
  `email` varchar(40) CHARACTER SET utf8 NOT NULL,
  `ativo` enum('1','0') CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `permissao_usuario` enum('1','2','3') CHARACTER SET utf8 NOT NULL DEFAULT '1',
  `liberado` enum('1','0') CHARACTER SET utf8 NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `login_usuario`, `senha_usuario`, `nome`, `email`, `ativo`, `permissao_usuario`, `liberado`) VALUES
(2, 'c3c0678baa8c0942ea114371c5831c7c', '55a1239bc75f6a5c5f5b586a5c13bb4e', 'alison tavares', 'alison@teste.com', '1', '1', '1'),
(4, '123.456.789.00', '123456', 'alison tavares', 'alison@teste.com', '1', '1', '1');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `log_acesso`
--
ALTER TABLE `log_acesso`
  ADD PRIMARY KEY (`id_log`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `log_acesso`
--
ALTER TABLE `log_acesso`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
