-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/06/2025 às 17:47
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `duck`
--

DROP DATABASE IF EXISTS `duck`;
CREATE DATABASE `duck`;
USE `duck`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `anuncios`
--

CREATE TABLE `anuncios` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `preco` float NOT NULL,
  `situacao` varchar(10) NOT NULL DEFAULT 'aberto',
  `anunciado_por` varchar(175) NOT NULL,
  `enviado_de` varchar(64) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `anuncios`
--

INSERT INTO `anuncios` (`id`, `codigo`, `titulo`, `descricao`, `preco`, `situacao`, `anunciado_por`, `enviado_de`, `criado_em`) VALUES
(1, '1-1', 'Pato de Borracha', 'pato de borracha', 1000000, 'aberto', 'Nome Sobrenome', 'Cidade - UF', '2025-04-21 02:21:37'),
(4, '2-1', 'Pelúcia de Pato', 'suuuper fofo\r\nsuuuuuuuper macio\r\nsuuuuuuuuuuuuuuuper gente fina (eu acho...)', 99.99, 'aberto', 'Nathan Oliveira', 'Osasco - SP', '2025-04-23 04:54:41'),
(5, '1-2', 'Brinquedo Pato Exótico para pets', 'Feito de borracha altamente durável.\r\nFaz um som esquisito ao apertar.\r\nOs cães adoram.\r\n', 21.45, 'aberto', 'Nome Sobrenome', 'Cidade - UF', '2025-04-23 12:28:42'),
(6, '2-2', 'Bule de Pato Alemão', 'Era da minha avó. Super raro e de muito boa qualidade. Serve patua cozinha, patua sala, patua mãe, patua sogra, patua tia... Patoda a família.', 900, 'aberto', 'Nathan Oliveira', 'Osasco - SP', '2025-06-18 04:54:50'),
(7, '3-1', 'COPATO', 'Copo super legal de um pato famoso ai.', 34.56, 'aberto', 'Freddy Fazbear', 'Diner - UT', '2025-06-18 06:01:17');

-- --------------------------------------------------------

--
-- Estrutura para tabela `carrinho`
--

CREATE TABLE `carrinho` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_anuncio` int(11) NOT NULL,
  `quantidade` int(11) DEFAULT 1,
  `adicionado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `sobrenome` varchar(150) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(64) NOT NULL,
  `cpf` char(11) NOT NULL,
  `cep` char(8) NOT NULL,
  `rua` varchar(32) NOT NULL,
  `bairro` varchar(32) NOT NULL,
  `cidade` varchar(32) NOT NULL,
  `uf` char(2) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `anuncios` tinyint(4) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `sobrenome`, `email`, `senha`, `cpf`, `cep`, `rua`, `bairro`, `cidade`, `uf`, `telefone`, `anuncios`, `criado_em`) VALUES
(1, 'Nome', 'Sobrenome', 'email@gmail.com', 'senha', '12312312312', '12345678', 'Rua 10', 'Bairro', 'Cidade', 'UF', '00987654321', 2, '2025-04-20 16:43:37'),
(2, 'Nathan', 'Oliveira', 'nathan@gmail.com', 'senha', '11122233344', '12345678', 'Dos Bobos 0', 'Aldeia', 'Osasco', 'SP', '11987654321', 2, '2025-04-23 04:18:14'),
(3, 'Freddy', 'Fazbear', 'freddy@gmail.com', 'senha', '19871987198', '19871987', 'Fredbear', 'Family', 'Diner', 'UT', '198719871987', 1, '2025-06-18 08:58:40');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anuncios`
--
ALTER TABLE `anuncios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `carrinho`
--
ALTER TABLE `carrinho`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_anuncio` (`id_anuncio`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anuncios`
--
ALTER TABLE `anuncios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `carrinho`
--
ALTER TABLE `carrinho`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `carrinho`
--
ALTER TABLE `carrinho`
  ADD CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`id_anuncio`) REFERENCES `anuncios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
