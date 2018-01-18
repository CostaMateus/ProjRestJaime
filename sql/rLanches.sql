-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 14-Nov-2017 às 15:47
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-03:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rLanches`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `featured`
--

CREATE TABLE `featured` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `featured`
--

INSERT INTO `featured` (`id`, `name`, `description`, `image`, `active`) VALUES
(1, 'Parmegianas', 'Opções:<br>- Filé de frango<br>- Contrafilé<br>- Filé mignon', 'LANCHES350.jpg', 1),
(2, 'Lanches Crocantes', 'Opções:<br>- Filé de Frango Crocante<br>- Hambúguer Crocante', 'LANCHES108.jpg', 1),
(3, 'Hambúrguer Artesanal', 'Deliciosos combos, lanches big (com 2 hambúrgues)', 'Imagem_141.jpg', 1),
(4, 'Salgados Artesanais', 'Esfiha de frango, trouxinha de calabresa, peito de peru c/ queijo branco <br>e muito mais...', 'DSCN2085.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `promotion`
--

CREATE TABLE `promotion` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `promotion`
--

INSERT INTO `promotion` (`id`, `name`, `description`, `price`, `image`, `active`) VALUES
(1, 'Dica de Refeição!', 'Coxa e Sobrecoxa Assada e Desossada com <br>Arroz, Feijão e Batata Assada', '<h5>R$ 12,00</h5>', 'DSCN1499.jpg', 1),
(2, 'HotDog Dogao', 'Descrição + vantagens + valores ...', '0', '', 0),
(3, 'Comercial Bife + Suco', 'Descrição 2 + vantagens 2 + valores ... ', '<h5>R$ 10,00</h5>', 'comercial1.1.jpg', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `login` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass` varchar(72) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dateCa` datetime DEFAULT NULL,
  `dateUp` datetime DEFAULT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `user`
--

INSERT INTO `user` (`id`, `name`, `login`, `pass`, `dateCa`, `dateUp`, `active`) VALUES
(1, 'Mateus Lopes', 'Mateus', '$2y$10$ovc0sxTsr52icxqOxxmlj.DOb9F.aLuGTKTUL7P6sW8UdrSRMEb2q', '2017-09-29 04:53:32', '2017-11-14 12:53:12', 1),
(2, 'Jaime Nobrega', 'Jaime', '$2y$10$oUMD7CsMSUXqqHniyl93Q.bVSW3f.fHvJtGdqR8uYIneHQ1YWxMXy', '2017-09-29 21:47:33', '2017-11-14 12:49:45', 1),
(3, 'Filipe Lucas', 'Filipe', '$2y$10$kyTt1n7FSC0pG71CtakL8u1BjrAMiXR/StMnVhOrTCBajeNj.ZvoC', '2017-11-14 12:57:01', '2017-11-14 12:57:01', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `featured` (Destaque)
--
ALTER TABLE `featured`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `promotion` (Promoção)
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user` (Usuário)
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `featured`
--
ALTER TABLE `featured`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
  
-- 
--