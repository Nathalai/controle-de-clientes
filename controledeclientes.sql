-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 07-Dez-2021 às 19:32
-- Versão do servidor: 10.4.21-MariaDB
-- versão do PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `controledeclientes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE `clientes` (
  `idcliente` int(11) NOT NULL,
  `nomecliente` varchar(45) NOT NULL,
  `cpfcliente` varchar(14) NOT NULL,
  `tipocliente` varchar(1) NOT NULL,
  `dtnasccliente` date NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`idcliente`, `nomecliente`, `cpfcliente`, `tipocliente`, `dtnasccliente`, `usuarios_idusuario`) VALUES
(7, 'Ana Paula Pereira', '08466175016', 'P', '1984-02-06', 7),
(8, 'Januário dos Santos', '78914253023', 'S', '1945-08-15', 10),
(9, 'Ângela do Nascimento', '48934842067', 'G', '1992-11-28', 8),
(13, 'Sandra Aparecida Batista', '05136216018', 'S', '1988-05-09', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `idenderecos` int(11) NOT NULL,
  `logradouro` varchar(100) NOT NULL,
  `numero` varchar(5) NOT NULL,
  `complemento` varchar(45) NOT NULL,
  `bairro` varchar(45) NOT NULL,
  `cep` varchar(8) NOT NULL,
  `cidade` varchar(45) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `enderecocol` varchar(45) NOT NULL DEFAULT '---',
  `clientes_idcliente` int(11) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`idenderecos`, `logradouro`, `numero`, `complemento`, `bairro`, `cep`, `cidade`, `uf`, `enderecocol`, `clientes_idcliente`, `usuarios_idusuario`) VALUES
(6, 'Avenida Sete de Setembro', '570', '', 'Centro', '81090900', 'Quiprocó', 'PR', '---', 7, 7),
(7, 'Rua das Andorinhas', '42', 'apto 12', 'Lages', '30550099', 'Piraporinha do Oeste', 'PE', '---', 8, 10),
(8, 'Rua Madre Lurdes Ferreira', '1568', 'bloco 7, apto 103', 'Liberdade', '94860094', 'São Paulo', 'SP', '---', 9, 8),
(11, 'Rua do Saci', '94', '', 'Correntes', '97650056', 'Pelotas', 'RS', '---', 13, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logs_acesso`
--

CREATE TABLE `logs_acesso` (
  `idlog` int(11) NOT NULL,
  `descricao` varchar(45) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `logs_acesso`
--

INSERT INTO `logs_acesso` (`idlog`, `descricao`, `usuarios_idusuario`) VALUES
(7, 'Data do log: Tue Dec 07 2021 às 14:52:19', 6),
(8, 'Data do log: Tue Dec 07 2021 às 14:52:42', 6),
(9, 'Data do log: Tue Dec 07 2021 às 14:56:34', 7),
(10, 'Data do log: Tue Dec 07 2021 às 15:6:30', 8),
(11, 'Data do log: Tue Dec 07 2021 às 15:7:15', 7),
(12, 'Data do log: Tue Dec 07 2021 às 15:15:10', 10),
(13, 'Data do log: Tue Dec 07 2021 às 15:19:24', 8),
(14, 'Data do log: Tue Dec 07 2021 às 15:21:30', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `idtelefone` int(11) NOT NULL,
  `ddd` varchar(2) NOT NULL,
  `fone` varchar(9) NOT NULL,
  `tipotelefone` varchar(45) NOT NULL,
  `clientes_idcliente` int(11) NOT NULL,
  `usuarios_idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `telefones`
--

INSERT INTO `telefones` (`idtelefone`, `ddd`, `fone`, `tipotelefone`, `clientes_idcliente`, `usuarios_idusuario`) VALUES
(7, '46', '989515911', '1', 7, 7),
(8, '85', '33725722', '2', 8, 10),
(9, '11', '988598499', '1', 9, 8),
(12, '55', '34255567', '2', 13, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nomeusuario` varchar(45) NOT NULL,
  `senhausuario` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nomeusuario`, `senhausuario`) VALUES
(7, 'admin', '$2y$10$3/AJ205IY8FWI7W/mQKyAe4Ig8/mBqmuQg4/MdBC/kelRAI5aOfsy'),
(8, 'Gabriel', '$2y$10$WMcnoi3AG3RDdRSrkLqG0.8KbhpR0ZBOPIfq.qPtORTeKlTdSLDKm'),
(10, 'Beto', '$2y$10$p7hhQvJpRA10jq00mTcugeKqITRl/X/F1J3wc5wVu.jNQrihfDPeu');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`idcliente`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`idenderecos`);

--
-- Índices para tabela `logs_acesso`
--
ALTER TABLE `logs_acesso`
  ADD PRIMARY KEY (`idlog`);

--
-- Índices para tabela `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`idtelefone`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `clientes`
--
ALTER TABLE `clientes`
  MODIFY `idcliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `idenderecos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `logs_acesso`
--
ALTER TABLE `logs_acesso`
  MODIFY `idlog` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `telefones`
--
ALTER TABLE `telefones`
  MODIFY `idtelefone` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
