-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18-Fev-2021 às 21:27
-- Versão do servidor: 10.4.14-MariaDB
-- versão do PHP: 7.3.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `web`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `cd_cliente` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cpf` char(14) NOT NULL,
  `telefone` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `rua` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`cd_cliente`, `nome`, `cpf`, `telefone`, `email`, `cidade`, `bairro`, `rua`, `numero`) VALUES
(1, 'Itachi', '430.952.879-02', '(94) 3824-2843', 'itachi@gmail.com', 'Guanambi', 'Akatsuki', 'Amaterasu', 545),
(2, 'Konan', '843.271.239-09', '(84) 3089-3112', 'konan@gmail.com', 'Guanambi', 'Akatsuki', 'Flores de papel', 4219),
(3, 'Pain', '437.189.023-82', '(90) 3247-0103', 'pain@gmail.com', 'Guanambi', 'Akatsuki', 'Shinra Tensei', 57);

-- --------------------------------------------------------

--
-- Estrutura da tabela `compra_fornecedor`
--

CREATE TABLE `compra_fornecedor` (
  `cd_compra_fornecedor` int(11) NOT NULL,
  `cd_fornecedor` int(11) NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `data_compra` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `compra_fornecedor`
--

INSERT INTO `compra_fornecedor` (`cd_compra_fornecedor`, `cd_fornecedor`, `cd_produto`, `data_compra`) VALUES
(1, 1, 1, '2021-02-18 16:46:20'),
(2, 2, 2, '2021-02-18 16:46:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolucao`
--

CREATE TABLE `devolucao` (
  `cd_devolucao` int(11) NOT NULL,
  `cd_venda` int(11) NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `valor_item` decimal(7,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_devolucao` decimal(7,2) NOT NULL,
  `motivo_devolucao` varchar(50) NOT NULL,
  `data_devolucao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

CREATE TABLE `fornecedor` (
  `cd_fornecedor` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cnpj` char(18) NOT NULL,
  `telefone` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `estado` varchar(30) NOT NULL,
  `cidade` varchar(30) NOT NULL,
  `bairro` varchar(30) NOT NULL,
  `endereco` varchar(30) NOT NULL,
  `numero` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`cd_fornecedor`, `nome`, `cnpj`, `telefone`, `email`, `estado`, `cidade`, `bairro`, `endereco`, `numero`) VALUES
(1, 'Calças Bahia', '43.872.139/1329-07', '(49) 7052-3477', 'calcas.bahia@gmail.com', 'Bahia', 'Guanambi', 'Bairro 3', 'Rua 16', 4308),
(2, 'Chacal Roupas', '37.429.043/8743-30', '(90) 8243-9084', 'chacal.roupas@gmail.com', 'Bahia', 'Guanambi', 'Bairro 4', 'Rua 20', 86);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `cd_funcionario` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cargo` varchar(30) NOT NULL DEFAULT 'Atendente',
  `cpf` char(14) NOT NULL,
  `telefone` char(14) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cd_funcionario`, `nome`, `cargo`, `cpf`, `telefone`, `email`, `senha`) VALUES
(1, 'Uenio Viana', 'Gerente', '438.953.729-10', '(30) 4927-3940', 'ueniomlh@gmail.com', '$2y$10$4w46mMBlEsSajjNi5bowp.4isAFqaH4ls2AjGEoRQtcjDJquduGq2'),
(2, 'Batman', 'Administrador', '384.793.027-11', '(50) 9674-6872', 'batman@gmail.com', '$2y$10$tGhJGZPQOkbZMPLU3XRmFeR754AWvYOp.kDyn.Q66Q1ZY2dcM2f1C'),
(3, 'Rambo', 'Atendente', '875.209.387-12', '(34) 5618-2373', 'rambo@gmail.com', '$2y$10$f3oibG4W68Vqk45LqpiiyuV1Qs/yP4FFTdnaxkfcnxsk0mT.0SyAS');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `cd_produto` int(11) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `codigo_barra` char(15) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `tamanho` varchar(2) NOT NULL,
  `genero` char(1) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_compra` decimal(7,2) NOT NULL,
  `porcentagem_revenda` int(11) NOT NULL,
  `valor_revenda` decimal(7,2) NOT NULL
) ;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`cd_produto`, `nome`, `marca`, `codigo_barra`, `cor`, `tamanho`, `genero`, `quantidade`, `valor_compra`, `porcentagem_revenda`, `valor_revenda`) VALUES
(1, 'Camiseta', 'Calvin Klein', '8-942171-038913', 'Vermelho', 'M', 'M', 30, '12.79', 65, '21.10'),
(2, 'Vestido', 'Dudalina', '3-290472-304719', 'Rosa', 'M', 'F', 30, '15.70', 70, '26.69'),
(3, 'Bermuda', 'Colcci', '2-904171-330942', 'Laranja', 'M', 'M', 40, '12.47', 75, '21.82');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `cd_venda` int(11) NOT NULL,
  `cd_produto` int(11) NOT NULL,
  `cd_funcionario` int(11) NOT NULL,
  `cd_cliente` int(11) NOT NULL,
  `valor_item` decimal(7,2) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor_venda` decimal(7,2) NOT NULL,
  `tipo_pagamento` varchar(30) NOT NULL DEFAULT 'Pagamento á vista',
  `data_venda` timestamp NOT NULL DEFAULT current_timestamp()
) ;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cd_cliente`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `compra_fornecedor`
--
ALTER TABLE `compra_fornecedor`
  ADD PRIMARY KEY (`cd_compra_fornecedor`),
  ADD KEY `cd_fornecedor` (`cd_fornecedor`),
  ADD KEY `cd_produto` (`cd_produto`);

--
-- Índices para tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD PRIMARY KEY (`cd_devolucao`),
  ADD KEY `cd_venda` (`cd_venda`),
  ADD KEY `cd_produto` (`cd_produto`);

--
-- Índices para tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  ADD PRIMARY KEY (`cd_fornecedor`),
  ADD UNIQUE KEY `cnpj` (`cnpj`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`cd_funcionario`),
  ADD UNIQUE KEY `cpf` (`cpf`),
  ADD UNIQUE KEY `telefone` (`telefone`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices para tabela `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`cd_produto`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`cd_venda`),
  ADD KEY `cd_produto` (`cd_produto`),
  ADD KEY `cd_funcionario` (`cd_funcionario`),
  ADD KEY `cd_cliente` (`cd_cliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cd_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `compra_fornecedor`
--
ALTER TABLE `compra_fornecedor`
  MODIFY `cd_compra_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `devolucao`
--
ALTER TABLE `devolucao`
  MODIFY `cd_devolucao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fornecedor`
--
ALTER TABLE `fornecedor`
  MODIFY `cd_fornecedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `cd_funcionario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `produto`
--
ALTER TABLE `produto`
  MODIFY `cd_produto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `cd_venda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `compra_fornecedor`
--
ALTER TABLE `compra_fornecedor`
  ADD CONSTRAINT `compra_fornecedor_ibfk_1` FOREIGN KEY (`cd_fornecedor`) REFERENCES `fornecedor` (`cd_fornecedor`),
  ADD CONSTRAINT `compra_fornecedor_ibfk_2` FOREIGN KEY (`cd_produto`) REFERENCES `produto` (`cd_produto`);

--
-- Limitadores para a tabela `devolucao`
--
ALTER TABLE `devolucao`
  ADD CONSTRAINT `devolucao_ibfk_1` FOREIGN KEY (`cd_venda`) REFERENCES `venda` (`cd_venda`),
  ADD CONSTRAINT `devolucao_ibfk_2` FOREIGN KEY (`cd_produto`) REFERENCES `produto` (`cd_produto`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`cd_produto`) REFERENCES `produto` (`cd_produto`),
  ADD CONSTRAINT `venda_ibfk_2` FOREIGN KEY (`cd_funcionario`) REFERENCES `funcionario` (`cd_funcionario`),
  ADD CONSTRAINT `venda_ibfk_3` FOREIGN KEY (`cd_cliente`) REFERENCES `cliente` (`cd_cliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
