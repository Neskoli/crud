CREATE DATABASE wda_crud;
USE wda_crud;
CREATE TABLE `customers` (
  `id` int(11) NOT NULL auto_increment PRIMARY KEY,
  `name` varchar(255) NOT NULL,
  `cpf_cnpj` varchar(14) NOT NULL,
  `birthdate` datetime NOT NULL,
  `address` varchar(255) NOT NULL,
  `hood` varchar(100) NOT NULL,
  `zip_code` varchar(8) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `phone` varchar(11) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `ie` varchar(15) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `customers` (`name`, `cpf_cnpj`, `birthdate`, `address`, `hood`, `zip_code`, `city`, `state`, `phone`, `mobile`, `ie`, `created`, `modified`) VALUES
('Fulano de Tal', '123.456.789-00', '1989-01-01', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'SP', '15 47483647', '21947483647', '12345643576', '2023-09-20 11:00:00', '2023-09-20 11:00:00'),
('Cilclano de Tal', '123.456.789-00', '1985-11-01', 'Rua da Web, 123', 'Internet', '12345678', 'Teste', 'SP', '15 47483647', '21947483647', '12345643576', '2023-09-20 11:00:00', '2023-09-20 11:00:00');

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL auto_increment PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `usuarios` ( `nome`, `user`, `password`, `foto`) VALUES 
( 'admin', 'admin', '$2a$08$Cf1f11ePArKlBJomM0F6a.S0UlqLOqj86iQfgPSVn5cYz0lJGIA22', NULL),
( 'Zé Lele', 'zelele', '5243897562837456982', NULL),
( 'Mary Zica', 'mazi', '786098767869', NULL),
( 'Fugiru Nakombi', 'fugina', '623485634753234', NULL);

CREATE TABLE `movel` (
  `id` int(11) NOT NULL auto_increment PRIMARY KEY,
  `nome` varchar(50) NOT NULL,
  `quatidade` varchar(100) NOT NULL,
  `foto` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `movel` ( `nome`, `quatidade`, `foto`) VALUES
( 'cama', '120', NULL),
( 'sofa', '789', NULL),
( 'mesa', '623', NULL);