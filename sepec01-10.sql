-- --------------------------------------------------------
-- Servidor:                     31.220.56.144
-- Versão do servidor:           5.7.25-0ubuntu0.18.04.2 - (Ubuntu)
-- OS do Servidor:               Linux
-- HeidiSQL Versão:              10.0.0.5460
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Copiando estrutura do banco de dados para sepec_prod
CREATE DATABASE IF NOT EXISTS `sepec_prod` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `sepec_prod`;

-- Copiando estrutura para tabela sepec_prod.sfm_associados
CREATE TABLE IF NOT EXISTS `sfm_associados` (
  `ID_Associado` int(11) NOT NULL AUTO_INCREMENT,
  `NM_Associado` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `RG` int(11) DEFAULT NULL,
  `CPF` varchar(19) DEFAULT NULL,
  `DT_Nascimento` date DEFAULT NULL,
  `DT_Associacao` date NOT NULL,
  `Telefone` char(14) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Celular` char(15) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Rua` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Bairro` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NO_Endereco` int(11) DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `Complemento` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ID_Cidade` int(11) DEFAULT NULL,
  `NO_Registro` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ID_Local_Trabalho` int(11) NOT NULL,
  `Cargo` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `VL_Salario` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ST_Situacao` varchar(50) NOT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  `Assinatura` char(50) DEFAULT NULL,
  PRIMARY KEY (`ID_Associado`),
  KEY `FK_Cidade_Associados` (`ID_Cidade`),
  KEY `FK_Local_Trabalho_Associados` (`ID_Local_Trabalho`),
  KEY `FK_Usuarios_Associados` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_Cidade_Associados` FOREIGN KEY (`ID_Cidade`) REFERENCES `sfm_cidade` (`ID_Cidade`),
  CONSTRAINT `FK_Local_Trabalho_Associados` FOREIGN KEY (`ID_Local_Trabalho`) REFERENCES `sfm_local_trabalho` (`ID_Local_Trabalho`),
  CONSTRAINT `FK_Usuarios_Associados` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_associados: ~28 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_associados` DISABLE KEYS */;
INSERT INTO `sfm_associados` (`ID_Associado`, `NM_Associado`, `RG`, `CPF`, `DT_Nascimento`, `DT_Associacao`, `Telefone`, `Celular`, `Email`, `NM_Rua`, `NM_Bairro`, `NO_Endereco`, `CEP`, `Complemento`, `ID_Cidade`, `NO_Registro`, `ID_Local_Trabalho`, `Cargo`, `VL_Salario`, `ST_Situacao`, `DH_Inclusao`, `ID_Usuario_Inclusao`, `Assinatura`) VALUES
	(1, 'THIAGO LOURIVAL CAVALGANTE DE SOUZA', 350755480, '332.376.356-04', '1986-10-07', '2018-07-27', '', '(14)99152-4586', '', 'ALVARO SOUZA OLIVEIRA', 'CENTRO', 151, '16.401-310', '', 1, '', 1, 'FRENTISTA', '1.649,70', 'Ativo', '2019-05-14 17:59:04', 2, NULL),
	(2, 'ALEXANDRE BAHIANO GONÃ‡ALVES', 224207295, '174.046.878-37', '1974-05-09', '2012-04-12', '(14)3454-6279', '(14)99853-3019', '', 'RUA DANT VRECH ', 'VILA SANCHO FLORA DA COSTA', 832, '17.512-792', '', 2, '', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 18:48:44', 2, NULL),
	(3, 'CRISTIANO MACEDO DA SILVA ', 293363997, '261.666.338-40', '1976-05-08', '2017-11-01', '', '(14)99669-1557', '', 'RUA HELENA SAMPAIO VIDAL', '', 675, '17.512-280', '', 2, '0608', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 18:55:37', 2, NULL),
	(4, 'EVERTON FERRAZ DIAS', 291847419, '831.782.521-34', '1978-03-21', '2018-12-20', '', '(14)99732-7292', '', 'RUA ALTINO NETO ', 'STA ANTONIETA', 712, '17.512-000', '', 2, '0951', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 19:09:13', 2, NULL),
	(5, 'JOSE APARECIDO ANTONIO', 446969800, '560.935.949-04', '1965-10-05', '2017-11-01', '', '(14)99847-3987', '', 'RUA LORIVAL DOS SANTOS ', '', 61, '', '', 2, '0603', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 19:14:13', 2, NULL),
	(6, 'MARCOS ANTONIO VELENCIO', 233494200, '141.293.768-02', '1970-07-28', '2017-11-01', '', '(14)99877-6690', '', 'RUA HALZA PIMENTEL CARVALHO DE TOLEDO ', '', 460, '', '', 2, '0621', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 19:57:56', 2, NULL),
	(7, 'YGOR AMAURI DOMINGUES DA SILVA', 45991589, '423.205.628-93', '1996-05-10', '2017-11-01', '', '(14)99682-2025', '', 'GABRIEL ALONSO BASSAN', '', 59, '17.512-700', '', 2, '0667', 2, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:03:12', 2, NULL),
	(8, 'JEAN HENRIQUE DA SILVA ALMEIDA', 40438135, '410.001.278-00', '1993-12-04', '2017-11-01', '', '(14)99667-6208', '', 'PROF BERTA CAMARGO VIEIRA ', '', 157, '17.512-400', '', 2, '0607', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:11:56', 2, NULL),
	(9, 'LUIS HENRIQUE VITTORIN', 47646669, '409.272.628-78', '1990-10-01', '2017-11-01', '', '(14)99717-0176', '', 'OCTAVIO VENCIQUEIRA', 'MARACÃ', 57, '', '', 2, '0606', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:16:25', 2, NULL),
	(10, 'LUCIANO CAPRARI PEREIRA', 42287637, '340.961.298-01', '1986-01-23', '2019-08-01', '', '(14)99769-6754', '', 'JACINTO PORTELO ORMONDE', '', NULL, '', '', 2, '0788', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:19:13', 2, NULL),
	(11, 'LUCAS ALEXANDRE CAPRARI PEREIRA', 408173038, '454.052.888-29', '1994-10-18', '2019-08-01', '', '', '', 'ONOFRE FERREIRA', '', 142, '17.519-780', '', 2, '01033', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:22:39', 2, NULL),
	(12, 'GIOVANI DA SILVA ALMEIDA ', NULL, '444.182.078-05', NULL, '2019-08-01', '', '(14)99825-1268', '', 'PROFESSOR BERTA CAMARGO VIEIRA ', '', 157, '17.512-400', '', 2, '01015', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:24:40', 2, NULL),
	(13, 'GEVANILDO DE ALMEIDA ', 256434141, '170.384.188-31', '1972-05-05', '2019-05-14', '', '(14)99704-1413', '', 'PROF BERTA CAMARGO VIEIRA ', '', 157, '17.512-400', '', 2, '01016', 4, 'FRENTISTA', '', 'Ativo', '2019-08-01 20:28:40', 2, NULL),
	(14, 'ALAN FERNANDES DA SILVEIRA', 474117625, '404.735.568-20', '1991-05-05', '2018-12-20', '', '(14)99618-3842', '', 'Bertoldo Jose Da Costa ', 'CENTRO', 864, '', '', 4, '0949', 5, 'FRENTISTA', '', 'Ativo', '2019-08-06 21:10:18', 2, NULL),
	(15, 'ROGER HENRIQUE DOS SANTOS', 46226818, '391.392.798-04', '1989-08-10', '2019-08-06', '', '(14)98173-6863', '', 'AV ANTONIETA ALTENFELDER', 'STA ANTONIETA', 2555, '17.512-000', '', 2, '0940', 5, 'FRENTISTA', '', 'Ativo', '2019-08-06 21:14:54', 2, NULL),
	(16, 'SIDNEY FERNANDES PORTO DE SOUZA', 44548851, '378.359.578-92', '1989-12-13', '2018-12-20', '', '(14)99772-3434', '', 'RITA JUNIOR', 'MARACÃ', 71, '17.500-000', '', 2, '0945', 5, 'FRENTISTA', '', 'Ativo', '2019-08-06 21:17:25', 2, NULL),
	(17, 'NATANAEL DOS SANTOS SOARES', 410563040, '402.793.108-46', '1993-07-06', '2018-08-01', '', '(14)98138-8942', '', 'GUANABARA', '', 211, '17.400-000', '', 3, '0845', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 15:59:40', 2, NULL),
	(18, 'JORGE LUIZ PONZILAQUA', 253263475, '292.797.818-20', '1980-03-28', '2017-11-23', '', '', '', 'ADAO PEDRO DOS SANTOS', '', 160, '17.400-000', '', 3, '0692', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 16:03:38', 2, NULL),
	(19, 'PAULO HENRIQUE PACHECO', 426644928, '311.553.128-13', '1983-02-18', '2017-12-04', '(14)3274-1739', '', '', 'TRAVESSA ANTONIO RAFAEL CAVALCANTE', '', 35, '17.450-000', '', 3, '0729', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 16:10:31', 2, NULL),
	(20, 'PATRIC FARIAS BELARMINO', 400744097, '375.009.568-00', '1988-08-15', '2018-03-01', '', '(14)98158-1766', '', 'GUARANTÃƒ ', '', 462, '17.400-000', '', 3, '0782', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 16:28:16', 2, NULL),
	(21, 'CARLOS ALBERTO DOS SANTOS', 263077866, '158.158.358-00', '1976-01-01', '2017-04-09', '(14)3471-4955', '', '', 'BARAO DO RIO BRANCO ', '', 14, '17.400-000', '', 3, '0731', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 16:44:32', 2, NULL),
	(22, 'BRUNO DE MORAES DA SILVA ', 403083217, '414.835.638-13', '1994-04-09', '2017-12-04', '', '(14)98114-7035', '', 'JOSE HENRIQUE FERREIRA DA ROCHA', '', 110, '17.400-000', '', 3, '0730', 6, 'FRENTISTA', '', 'Ativo', '2019-08-09 16:49:19', 2, NULL),
	(23, 'LEONARDO RODRIGUES', 332142917, '269.665.358-50', '1978-08-02', '0001-08-23', '', '(14)99771-1272', '', 'AMELIA SABOG ', 'NOVA MARILIA', 362, '17.522-680', '', 2, '', 10, 'FRENTISTA', '', 'Ativo', '2019-08-23 17:19:20', 2, NULL),
	(24, 'IVONE SILVA PEREIRA', 276107597, '263.867.098-70', '1973-09-15', '2012-04-02', '', '(14)99862-0015', '', 'ISAMU EGASHIRA', 'COMERCIAL ', 229, '17.500-000', '', 2, '', 10, 'FRENTISTA', '', 'Ativo', '2019-08-23 17:22:25', 2, NULL),
	(25, 'CLAUDINE DOS REIS SANTOS ', 8943973, '028.664.346-41', '1977-01-22', '2012-04-02', '', '(14)99743-5707', '', 'AV MENDE SÃ', 'NOVA MARILIA', 93, '17.522-340', '', 2, '', 10, 'FRENTISTA', '', 'Ativo', '2019-08-23 17:26:25', 2, NULL),
	(26, 'ENRIGEFSON JESUS DE OLIVEIRA ', 219184100, '141.328.518-00', '1972-11-27', '0001-01-01', '', '(14)99711-4836', '', 'DANTE DE ARAUJO', 'JANIO QUADROS ', 18, '17.511-741', '', 2, '', 10, 'FRENTISTA', '', 'Ativo', '2019-08-23 17:49:39', 2, NULL),
	(27, 'MAURO SERGIO BALBO', 261384314, '180.980.288-10', '1973-11-19', '2019-09-22', '(14)3434-1387', '', '', 'MARCIA REGINA MALDONADO', 'STA ANTONIETA', 96, '17.512-140', '', 2, '0625', 11, 'FRENTISTA', '', 'Ativo', '2019-09-26 18:59:01', 2, NULL),
	(28, 'JOSE CARLOS RODRIGUES', 251349275, '147.490.888-89', '1972-10-20', '2018-04-16', '', '(14)99814-4554', '', 'ALTINO NETO ', 'STA ANTONIETA', 504, '17.512-153', '', 2, '0799', 11, '', '', 'Ativo', '2019-10-01 14:15:40', 2, NULL);
/*!40000 ALTER TABLE `sfm_associados` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_cidade
CREATE TABLE IF NOT EXISTS `sfm_cidade` (
  `ID_Cidade` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Estado` int(11) DEFAULT NULL,
  `NM_Cidade` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Cidade`),
  KEY `FK_Estado_Cidade` (`ID_Estado`),
  KEY `FK_Usuario_Cidade` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_Estado_Cidade` FOREIGN KEY (`ID_Estado`) REFERENCES `sfm_estado` (`ID_Estado`),
  CONSTRAINT `FK_Estado_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_cidade: ~26 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_cidade` DISABLE KEYS */;
INSERT INTO `sfm_cidade` (`ID_Cidade`, `ID_Estado`, `NM_Cidade`, `DH_Inclusao`, `ID_Usuario_Inclusao`) VALUES
	(1, 1, 'LINS', '2019-05-14 16:57:59', 2),
	(2, 1, 'MARILIA', '2019-05-14 16:58:10', 2),
	(3, 1, 'GARÃ‡A', '2019-05-14 16:58:18', 2),
	(4, 1, 'JULIO MESQUITA', '2019-05-14 16:59:45', 2),
	(5, 1, 'PROMISSÃƒO', '2019-05-14 16:59:55', 2),
	(6, 1, 'GUAIÃ‡ARA', '2019-05-14 17:00:04', 2),
	(7, 1, 'SABINO', '2019-05-14 17:00:11', 2),
	(8, 1, 'GUARANTÃƒ', '2019-05-14 17:00:32', 2),
	(9, 1, 'PONGAI', '2019-05-14 17:00:42', 2),
	(10, 1, 'GETULINA', '2019-05-14 17:01:00', 2),
	(11, 1, 'GUAIMBE', '2019-05-14 17:01:16', 2),
	(12, 1, 'ORIENTE', '2019-05-14 17:01:27', 2),
	(13, 1, 'POMPÃ‰IA', '2019-05-14 17:01:36', 2),
	(14, 1, 'QUINTANA', '2019-05-14 17:01:42', 2),
	(15, 1, 'LUPERCIO', '2019-05-14 17:01:51', 2),
	(16, 1, 'VERA CRUZ', '2019-05-14 17:01:59', 2),
	(17, 1, 'ALVARO DE CARVALHO', '2019-05-14 17:02:14', 2),
	(18, 1, 'SOROCABA ', '2019-05-21 19:43:26', 2),
	(19, 1, 'AMERICANA', '2019-05-21 19:50:27', 2),
	(20, 1, 'BAURU', '2019-05-21 19:54:10', 2),
	(21, 1, 'BIRIGUI', '2019-05-21 19:56:12', 2),
	(22, 1, 'AVANHANDAVA', '2019-05-21 20:23:20', 2),
	(23, 1, 'SAO PAULO', '2019-05-21 20:47:28', 2),
	(24, 1, 'TUPA', '2019-05-21 20:58:35', 2),
	(25, 1, 'CAFELANDIA', '2019-05-21 21:04:36', 2),
	(26, 1, 'JOSE BONIFACIO', '2019-05-30 20:19:12', 2),
	(27, 1, 'BILAC', '2019-05-30 20:31:27', 2),
	(28, 3, 'TRES LAGOAS', '2019-05-30 20:51:13', 2),
	(29, 1, 'DRACENA', '2019-08-01 20:47:03', 2),
	(30, 1, 'CAMPOS NOVOS PAULISTA', '2019-10-01 14:24:08', 2);
/*!40000 ALTER TABLE `sfm_cidade` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_convenios
CREATE TABLE IF NOT EXISTS `sfm_convenios` (
  `ID_Convenio` int(11) NOT NULL AUTO_INCREMENT,
  `VL_Convenio` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `VL_Convenio_Dep` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `Dia_Vencimento` int(11) NOT NULL,
  `NM_Empresa` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `NM_Convenio` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `ST_Situacao` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `DH_Inclusao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) NOT NULL,
  PRIMARY KEY (`ID_Convenio`),
  KEY `FK_Convenios_Usuarios` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_Convenios_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela sepec_prod.sfm_convenios: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_convenios` DISABLE KEYS */;
/*!40000 ALTER TABLE `sfm_convenios` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_convenio_pessoa
CREATE TABLE IF NOT EXISTS `sfm_convenio_pessoa` (
  `ID_convenio_associado` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Associado` int(11) DEFAULT NULL,
  `ID_Dependente` int(11) DEFAULT NULL,
  `ID_Convenio` int(11) DEFAULT NULL,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_convenio_associado`),
  KEY `fk_Associado` (`ID_Associado`),
  KEY `fk_dependente` (`ID_Dependente`),
  KEY `fk_Pessoa_Convenio` (`ID_Convenio`),
  KEY `FK_ConvenioPessoa_Usuarios` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_ConvenioPessoa_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`),
  CONSTRAINT `fk_Associado` FOREIGN KEY (`ID_Associado`) REFERENCES `sfm_associados` (`ID_Associado`),
  CONSTRAINT `fk_Pessoa_Convenio` FOREIGN KEY (`ID_Convenio`) REFERENCES `sfm_convenios` (`ID_Convenio`),
  CONSTRAINT `fk_dependente` FOREIGN KEY (`ID_Dependente`) REFERENCES `sfm_dependentes` (`ID_Dependente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Copiando dados para a tabela sepec_prod.sfm_convenio_pessoa: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_convenio_pessoa` DISABLE KEYS */;
/*!40000 ALTER TABLE `sfm_convenio_pessoa` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_dependentes
CREATE TABLE IF NOT EXISTS `sfm_dependentes` (
  `ID_Dependente` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Associado` int(11) DEFAULT NULL,
  `NM_Dependente` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `NM_Grau` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `RG` int(11) DEFAULT NULL,
  `CPF` char(50) DEFAULT NULL,
  `DT_Nascimento` date DEFAULT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Dependente`),
  KEY `FK_Associados_Dependentes` (`ID_Associado`),
  KEY `FK_Usuarios_Dependentes` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_Associados_Dependentes` FOREIGN KEY (`ID_Associado`) REFERENCES `sfm_associados` (`ID_Associado`),
  CONSTRAINT `FK_Dependentes_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_dependentes: ~37 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_dependentes` DISABLE KEYS */;
INSERT INTO `sfm_dependentes` (`ID_Dependente`, `ID_Associado`, `NM_Dependente`, `NM_Grau`, `RG`, `CPF`, `DT_Nascimento`, `DH_Inclusao`, `ID_Usuario_Inclusao`) VALUES
	(1, 3, 'MARIA APARECIDA FERREIRA DA SILVA', 'CÃ´njuge', NULL, '281.347.638-20', '1977-06-16', '2019-08-01 18:58:53', 2),
	(2, 3, 'SAMIRA EDUARDO FERREIRA DA SILVA ', 'Filho(a)', NULL, '261.666.338-40', '2004-11-01', '2019-08-01 19:06:31', 2),
	(3, 4, 'GISELE MARA FRUCTUOSO DIAS', 'CÃ´njuge', NULL, '', NULL, '2019-08-01 19:18:43', 2),
	(4, 4, 'LARA EMANUELY DIAS ', 'Filho(a)', NULL, '', '2015-02-28', '2019-08-01 19:31:20', 2),
	(5, 4, 'LAIS VITORIA DIAS ', 'Filho(a)', NULL, '', '2016-10-16', '2019-08-01 19:31:50', 2),
	(6, 4, 'CLAUDIA REGINA SANTO ANTONIO', 'CÃ´njuge', NULL, '', NULL, '2019-08-01 19:34:50', 2),
	(7, 4, 'ELIVELTON HENRIQUE ANTONIO ', 'Filho(a)', NULL, '', NULL, '2019-08-01 19:36:03', 2),
	(8, 4, 'MARIANA REGINA ANTONIO', 'Filho(a)', NULL, '', NULL, '2019-08-01 19:36:31', 2),
	(9, 6, 'CLEIDE APARECODA BARRETO VELENCIO', 'CÃ´njuge', NULL, '', '1970-04-24', '2019-08-01 19:58:29', 2),
	(10, 6, 'NATALIA BARRETO VELENCIO', 'Filho(a)', NULL, '', '2002-08-03', '2019-08-01 20:00:47', 2),
	(11, 7, 'SABRINA FAGUNDES PESSOA', 'CÃ´njuge', NULL, '', NULL, '2019-08-01 20:03:31', 2),
	(12, 7, 'HELOISA FAGUNDES DOMINGUES', 'Filho(a)', NULL, '', NULL, '2019-08-01 20:03:59', 2),
	(13, 10, 'TATIANE DE OLIVEIRA CAPRARI', 'CÃ´njuge', NULL, '', NULL, '2019-08-01 20:19:43', 2),
	(14, 12, 'MONICA SAYURI MIZUNO ', 'CÃ´njuge', NULL, '', '1996-04-10', '2019-08-01 20:25:06', 2),
	(15, 13, 'MARIA VALDIRENE DA SILVA ALMEIDA', 'CÃ´njuge', NULL, '', '1975-09-02', '2019-08-01 20:29:27', 2),
	(16, 14, 'Yasmin Canales', 'CÃ´njuge', NULL, '', NULL, '2019-08-06 21:11:01', 2),
	(17, 14, 'Sophia Canales', 'Filho(a)', NULL, '', NULL, '2019-08-06 21:11:28', 2),
	(18, 14, 'Antony Canales Da Silveira', 'Filho(a)', NULL, '', '2017-02-07', '2019-08-06 21:12:05', 2),
	(19, 15, 'ELENICE BUENO DOS SANTOS', 'CÃ´njuge', NULL, '', NULL, '2019-08-06 21:15:19', 2),
	(20, 16, 'ANGELICA PROCOPIO DA SILVA', 'CÃ´njuge', NULL, '', NULL, '2019-08-06 21:18:01', 2),
	(21, 17, 'LUSIANE CRISTINA CARDOSO', 'CÃ´njuge', NULL, '', NULL, '2019-08-09 16:00:10', 2),
	(22, 17, 'ANA CLARA CARDOSO SOARES', 'Filho(a)', NULL, '', NULL, '2019-08-09 16:00:29', 2),
	(23, 18, 'MARIANA MOREIRA PONZILAQUA', 'Filho(a)', NULL, '', '2012-09-03', '2019-08-09 16:06:51', 2),
	(24, 19, 'CLEONICE SOARES DUARTE', 'CÃ´njuge', NULL, '', '1985-09-28', '2019-08-09 16:11:37', 2),
	(25, 19, 'VITOR DUARTE PACHECO', 'Filho(a)', NULL, '', '2016-12-18', '2019-08-09 16:12:41', 2),
	(26, 19, 'ANA CLARA SOARES DUARTE', 'Filho(a)', NULL, '', '2003-03-03', '2019-08-09 16:13:11', 2),
	(27, 20, 'SUELEM EVELIM DOS SANTOS', 'CÃ´njuge', NULL, '', '1990-08-17', '2019-08-09 16:29:55', 2),
	(28, 20, 'GIOVANA DOS SANTOS BELARMINO', 'Filho(a)', NULL, '', '2011-04-05', '2019-08-09 16:39:01', 2),
	(29, 21, 'CASSIA ASSIS SOARES DOS SANTOS', 'CÃ´njuge', NULL, '', '1976-12-31', '2019-08-09 16:45:19', 2),
	(30, 21, 'LETICIA ASSIS SOARES DOS SANTOS', 'Filho(a)', NULL, '', '2002-03-02', '2019-08-09 16:46:06', 2),
	(31, 22, 'TAIS REGINA SERAFINELLI DA SILVA', 'CÃ´njuge', NULL, '', '1997-04-30', '2019-08-09 16:50:31', 2),
	(32, 22, 'LUIZ HENRIQUE SERAFINELLI DA SILVA', 'Filho(a)', NULL, '', '2015-04-07', '2019-08-09 16:51:15', 2),
	(33, 25, 'VIVIANE SANTOS TOMAZ', 'CÃ´njuge', NULL, '', NULL, '2019-08-23 17:37:25', 2),
	(37, 25, 'EDENILCE APARECIDA RODRIGUES', 'CÃ´njuge', NULL, '', '1969-02-28', '2019-08-29 20:37:45', 2),
	(38, 27, 'MARINALVA VIEIRA BALBO', 'CÃ´njuge', NULL, '', '1967-01-04', '2019-09-26 18:59:55', 2),
	(39, 27, 'NATALIA APARECIDA BALBO', 'Filho(a)', NULL, '', '1997-07-09', '2019-09-26 19:01:31', 2),
	(40, 27, 'LUCAS APARECIDO BALBO', 'Filho(a)', NULL, '', '2000-03-17', '2019-09-26 19:02:01', 2);
/*!40000 ALTER TABLE `sfm_dependentes` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_escritorios
CREATE TABLE IF NOT EXISTS `sfm_escritorios` (
  `ID_Escritorio` int(11) NOT NULL AUTO_INCREMENT,
  `NM_Escritorio` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CNPJ_Escritorio` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Telefone` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Rua` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Bairro` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NO_Endereco` int(11) DEFAULT NULL,
  `CEP` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ID_Cidade` int(11) DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `DH_Inclusao` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) NOT NULL,
  PRIMARY KEY (`ID_Escritorio`),
  KEY `FK_Escritorios_Usuarios` (`ID_Usuario_Inclusao`),
  CONSTRAINT `FK_Escritorios_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_escritorios: ~37 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_escritorios` DISABLE KEYS */;
INSERT INTO `sfm_escritorios` (`ID_Escritorio`, `NM_Escritorio`, `CNPJ_Escritorio`, `Telefone`, `NM_Rua`, `NM_Bairro`, `NO_Endereco`, `CEP`, `ID_Cidade`, `Email`, `DH_Inclusao`, `ID_Usuario_Inclusao`) VALUES
	(1, 'ESCRITÃ“RIO CONTÃBIL PAULISTA DE LINS LTDA', '51.528.198/0001-11', '(14)3522-4168', 'OSWALDO CRUZ ', 'CENTRO', 523, '16.400-060', 1, 'escpaulista@uol.com.br', '2019-05-14 17:08:20', 2),
	(2, 'A.N SERVIÃ‡OS CONTABIL S/C LTDA', '', '(14)3301-5744', 'AMAZONAS ', 'CENTRO', 529, '17.509-520', 2, 'ancontab@terra.com.br', '2019-05-21 19:32:12', 2),
	(3, 'ALFA ASSESSORIA EMPRESARIAL LTDA', '', '(14)3454-4558', 'PEDRO DE TOLEDO', 'CENTRO', 579, '17.509-020', 2, 'roselicandido32@hotmail.com', '2019-05-21 19:33:17', 2),
	(4, 'CONTABIL MIRAI', '', '(14)3432-1866', 'AMAZONAS ', 'CENTRO', 718, '17.515-160', 2, 'contabilmirai@hotmail.com', '2019-05-21 19:37:01', 2),
	(5, 'DIRECIONAL CONSULTORIA S/C LTDA', '', '(14)3523-7600', 'SAO JOÃƒO', 'CENTRO', 122, '16.400-090', 1, 'direcionalcon@uol.com.br', '2019-05-21 19:39:29', 2),
	(6, 'CONTÃBIL GELAMO', '', '(14)3433-4456', 'REPUBLICA ', 'CENTRO', 360, '17.500-000', 2, 'catia_ceolin@hotmail.com', '2019-05-21 19:49:44', 2),
	(7, 'ESCRITÃ“RIO AMERICANA CONTABIL', '', '(19)3461-2205', 'QUINTINO BOCAIUVA ', 'VILA GALO', 929, '13.466-300', 19, 'cassia@americanacontabil.com.br', '2019-05-21 19:52:02', 2),
	(8, 'ESCRITORIO COFISC', '', '(14)3306-0606', 'MONTE CARMELO', 'FRAGATA', 366, '17.501-360', 2, 'rh@cofisc.com.br', '2019-05-21 19:53:36', 2),
	(9, 'ESCRITÃ“RIO CONTÃBIL CONFIPE', '', '(14)3206-2600', 'RIO BRANCO ', 'CENTRO', 1515, '17.015-311', 20, 'marcia@confipe.com.br', '2019-05-21 19:55:47', 2),
	(10, 'ESCRITORIO CONTABIL COROADOS LTDA', '', '(18)3641-1867', 'NILO PEÃ‡ANHA', 'CENTRO', 746, '16.200-065', 21, 'escritoriocoroados@hotmail.com', '2019-05-21 19:57:48', 2),
	(11, 'ESCRITÃ“RIO CONTÃBIL GARDINAL', '', '(14)3522-2385', 'RODRIGUES ALVES', 'CENTRO', 133, '16.400-000', 1, 'escritoriogardinal@uol.com.br', '2019-05-21 20:00:32', 2),
	(12, 'ESCRITÃ“RIO CONTÃBIL GIROTO', '', '(14)3488-1169', 'SAO JOÃƒO ', 'CENTRO', 450, '17.670-000', 14, 'escritoriogiroto@yahoo.com.br', '2019-05-21 20:03:27', 2),
	(13, 'ESCRITÃ“RIO CONTÃBIL VERDELLI ', '', '(14)3533-8199', '13 DE MAIO ', 'CENTRO', 501, '16.400-045', 1, 'mercurio@verdelli.com.br', '2019-05-21 20:05:19', 2),
	(14, 'ESCRITÃ“RIO KINTEC ASSESSORIA CONTÃBIL S/C LTDA', '', '(14)3303-1900', 'HIDEKICHI NOMURA', 'FRAGATA', 170, '17.519-221', 2, 'dpessoal.anabeatriz@kintec.com.br', '2019-05-21 20:10:04', 2),
	(15, 'ESCRITÃ“RIO MODELO CONTÃBIL', '', '(14)3586-1500', 'BRASIL', 'CENTRO', 138, '16.570-000', 8, 'brunor.ricci@hotmail.com', '2019-05-21 20:12:12', 2),
	(16, 'ESCRITÃ“RIO OASIS', '', '(14)3454-2306', 'NELSON SPILMAM', 'CENTRO', 258, '17.509-002', 2, 'luciananet2003@hotmail.com', '2019-05-21 20:14:26', 2),
	(17, 'ESCRITORIO RM DE CONTABILIDADE', '', '(14)3456-1156', 'RODOLFO MIRANDA ', 'CENTRO', 563, '17.570-000', 12, 'josi_soaresol@hotmail.com', '2019-05-21 20:17:09', 2),
	(18, 'ESCRITORIO SUL AMERICA S/C LTDA', '', '(14)3492-1385', 'FRANCISCO P DA SILVEIRA ', 'CENTRO', 181, '17.560-000', 16, 'monicasantos_net@hotmail.com', '2019-05-21 20:22:16', 2),
	(19, 'ESCRITORIO UNIAO', '', '(18)3651-1528', '', '', NULL, '', 22, 'dprh@uniava.com.br', '2019-05-21 20:25:26', 2),
	(20, 'ESTILOTEC PROCESSAMENTOS CONTABEIS LTDA', '', '(14)3422-2655', 'ITU', 'CENTRO', 352, '', 2, 'estilotec@hotmail.com', '2019-05-21 20:39:02', 2),
	(21, 'HELMAR CONTABILIDADE', '', '(11)5079-8430', 'Dr Mauricio De Lacerda', 'Sao Judas', 361, '04.303-191', 23, 'kati@helmarcontabil.com.br', '2019-05-21 20:50:37', 2),
	(22, 'LAMAR CONTABILIDADE', '', '(14)3454-5017', 'Republica', 'Centro', 601, '', 13, 'eduardo@lamarcontabilidade.com.br', '2019-05-21 20:54:01', 2),
	(23, 'MACRO CONTABIL CONESSA', '', '(14)3407-1400', 'Carlos Ferrari', 'Centro', 22, '17.400-000', 3, 'marlene@macrocontabilconessa.com.br', '2019-05-21 20:56:48', 2),
	(24, 'MODELO SERVIÃ‡OS CONTABEIS LTDA', '', '(14)3496-1727', 'Potiguaras', 'Centro', 414, '17.601-080', 24, 'kamilajolo@escmodelo.com.br', '2019-05-21 21:01:13', 2),
	(25, 'ORGANIZAÃ‡AO CONTABIL COSMOS S/C LTDA', '', '(14)3433-8844', 'Av  Santo Antonio', 'Somensari', 1912, '17.506-040', 2, 'c.dina@terra.com.br', '2019-05-21 21:03:44', 2),
	(26, 'MODELO INFORMATICA LTDA', '', '', 'PraÃ§a Beraldo Arruda', '', 145, '', 25, 'modelo.rh3@gmail.com', '2019-05-21 21:07:59', 2),
	(27, 'ORGANIZAÃ‡ÃƒO CONTABIL RIAAVE', '', '(14)3522-5107', 'RIO BRANCO  SALA 121  10 ANDAR', 'CENTRO', 273, '16.400-000', 1, 'rh.1@riaave.com.br', '2019-05-21 21:12:23', 2),
	(28, 'SUPERMERCADO KAWAKAMI LTDA', '', '(14)3311-7600', 'Avenida  JoÃ£o Ramalho      ', 'Monte Castelo', 2300, '17.522-363', 2, 'dp@kawakami.com.br', '2019-05-30 20:05:29', 2),
	(29, 'ESCRITORIO ORANI', '', '(17)3245-1924', 'AV CAMPOS SALES ', 'CENTRO', 682, '', 26, 'escritoriokn@gmail.com', '2019-05-30 20:20:37', 2),
	(30, 'ROCHA CONTABIL', '', '(14)3413-4262', 'AV PEDRO DE TOLEDO', 'PALMITAL', 816, '17.509-020', 2, 'rochacontabil19@gmail.com', '2019-05-30 20:22:35', 2),
	(31, 'ESCRITORIO SILVA DE CONTABILIDADE', '', '(14)3454-7966', 'DOM PEDRO', '', 15, '17.500-000', 2, 'katiabiancalana@hotmail.com', '2019-05-30 20:24:52', 2),
	(32, 'PLUMAS ASSESSORIA CONTABIL LTDA', '', '(11)2023-9999', 'BURITI ALEGRE', 'VILA RE', 525, '03.667-000', 23, 'priscila@plumascontabil.com.br', '2019-05-30 20:26:55', 2),
	(33, 'ESCRITORIO IPIRANGA', '08.690.708/0001-23', '(18)3659-9200', 'BANDEIRANTES', 'CENTRO ', 777, '16.210-000', 27, 'thamiris@escritorioipiranga.com.br', '2019-05-30 20:31:00', 2),
	(34, 'ESCRITORIO PREMIUM', '', '(14)3413-9783', 'SAO MIGUEL', 'POLLON', 72, '17.507-040', 2, 'luiz.premium65@hotmail.com', '2019-05-30 20:33:52', 2),
	(35, 'CONTABIL ASSESSORIA EMPRESARIAL', '', '(14)3453-2121', 'AV IPIRANGA', '', 65, '17.500-000', 2, 'silvana.dp@contabilassessoria.com.br', '2019-05-30 20:39:01', 2),
	(36, 'ASSCON CONTABILIDADE E ASSESSORIA EMPRESARIAL', '07.546.825/0001-55', '(67)3522-1767', 'ALGUSTO CORREA DA COSTA', 'VILA NOVA', 759, '', 28, 'folha@escritorioasscon.com.br', '2019-05-30 20:42:08', 2),
	(37, 'FUTURA ASSESSORIA CONTABIL', '10.841.667/0001-70', '(14)3491-6161', 'JOAQUIM ABARCA', 'VILA GIOVANETTI', 1155, '17.600-450', 24, 'rhaissa@escritoriofutura.com.br', '2019-05-30 20:45:02', 2),
	(38, 'J.S.CONTABIL', '', '(14)3221-8280', 'AV NELSON SPILMANN', '', 1020, '17.500-000', 2, 'js.sandraap@hotmail.com', '2019-05-30 20:55:24', 2),
	(39, 'ATACADÃƒO MARILIA', '45.543.915/0622-92', '', 'LUIZ GABALDI FILHO', 'JARDIM RIVIERA', 50, '17.507-650', 2, 'ana_claudia_de_arruda_silva@carrefour.com', '2019-05-30 20:57:59', 2),
	(40, 'HDCONTABIL ASSESSORIA E ADMINISTRAQTIVA LTDA - ME', '08.937.990/0001-09', '(14)3402-9951', 'BASSAN', 'JARDIM AMERICA', NULL, '', 2, 'njzanoni@hotmail.com', '2019-05-30 21:11:07', 2),
	(41, 'GREPALDI NASCIMENTO E SALAZAR CONTABILIDADE LTDA EPP', '', '(18)3822-2676', 'VENDRAMIM', 'CENTRO', 846, '17.900-000', 29, 'g.rh@cnscontabilidade.com', '2019-08-06 19:41:27', 2),
	(42, 'ESCRITORIO PAULISTA', '', '(14)3522-4168', 'OSWALDO CRUZ', 'CENTRO', 523, '16.400-060', 1, 'escpaulista@uol.com.br', '2019-09-06 20:04:25', 2);
/*!40000 ALTER TABLE `sfm_escritorios` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_estado
CREATE TABLE IF NOT EXISTS `sfm_estado` (
  `ID_Estado` int(11) NOT NULL AUTO_INCREMENT,
  `NM_Estado` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CD_Estado` char(2) NOT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Estado`),
  KEY `FK_Usuarios_Estado` (`ID_Usuario_Inclusao`),
  KEY `NM_Estado` (`NM_Estado`),
  CONSTRAINT `FK_Estados_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_estado: ~1 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_estado` DISABLE KEYS */;
INSERT INTO `sfm_estado` (`ID_Estado`, `NM_Estado`, `CD_Estado`, `DH_Inclusao`, `ID_Usuario_Inclusao`) VALUES
	(1, 'SÃ£o Paulo', 'SP', '2019-04-25 13:30:34', 2),
	(3, 'MATO GROSSO DO SUL', 'MS', '2019-05-30 20:50:33', 2);
/*!40000 ALTER TABLE `sfm_estado` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_local_trabalho
CREATE TABLE IF NOT EXISTS `sfm_local_trabalho` (
  `ID_Local_Trabalho` int(11) NOT NULL AUTO_INCREMENT,
  `CD_Local_Trabalho` char(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Fantasia` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ID_Escritorio_Contabilidade` int(11) DEFAULT NULL,
  `NM_Rua` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NM_Bairro` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `NO_Endereco` int(11) DEFAULT NULL,
  `Complemento` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `CEP` varchar(50) DEFAULT NULL,
  `ID_Cidade` int(11) DEFAULT NULL,
  `CNPJ` varchar(50) DEFAULT NULL,
  `Telefone` varchar(15) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `Email` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ST_Situacao` char(10) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  `ID_Usuario_Inclusao` int(11) NOT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`ID_Local_Trabalho`),
  KEY `FK_Local_Trabalho_Cidade` (`ID_Cidade`),
  KEY `FK_Usuarios_Local_Trabalho` (`ID_Usuario_Inclusao`),
  KEY `FK_Local_Trabalho_Escritorio` (`ID_Escritorio_Contabilidade`),
  CONSTRAINT `FK_Local_Trabalho_Cidade` FOREIGN KEY (`ID_Cidade`) REFERENCES `sfm_cidade` (`ID_Cidade`),
  CONSTRAINT `FK_Local_Trabalho_Escritorio` FOREIGN KEY (`ID_Escritorio_Contabilidade`) REFERENCES `sfm_escritorios` (`ID_Escritorio`),
  CONSTRAINT `FK_Local_Trabalho_Usuarios` FOREIGN KEY (`ID_Usuario_Inclusao`) REFERENCES `sfm_usuarios` (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_local_trabalho: ~10 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_local_trabalho` DISABLE KEYS */;
INSERT INTO `sfm_local_trabalho` (`ID_Local_Trabalho`, `CD_Local_Trabalho`, `NM_Fantasia`, `ID_Escritorio_Contabilidade`, `NM_Rua`, `NM_Bairro`, `NO_Endereco`, `Complemento`, `CEP`, `ID_Cidade`, `CNPJ`, `Telefone`, `Email`, `ST_Situacao`, `ID_Usuario_Inclusao`, `DH_Inclusao`) VALUES
	(1, 'IPIRANGA', 'AUTADDEI GASOLINA E SERVIÃ‡OS LTDA', 1, 'FLORIANO PEIXOTO ', 'CENTRO', 1491, NULL, '16.400-000', 1, '51.664.225/0001-83', '(14)3522-2752', '', NULL, 2, '2019-05-14 17:47:28'),
	(2, '', 'ZURANO AUTO POSTO LTDA EPP', 22, 'RUA BENEDITO ALVES DELFINO', 'ADOLFO BIM', 1400, NULL, '17.512-043', 2, '05.492.740/0001-06', '', '', NULL, 2, '2019-08-01 18:43:46'),
	(4, '', 'POSTO MONTE CRISTO DE MARILIA LTDA', 17, 'RODOVIA SP 333 KM 321', '', NULL, NULL, '', 2, '03.815.512/0001-02', '', '', NULL, 2, '2019-08-01 20:09:10'),
	(5, '', 'AUTO POSTO RESERVA PALMITAL LTDA', 41, 'Sigismundo Nunes De Oliveira', 'Jd Nazareth', 53, NULL, '17.512-752', 2, '13.955.791/0001-55', '', '', NULL, 2, '2019-08-06 21:05:19'),
	(6, '', 'AUTO POSTO GUANABARA LTDA', 22, 'CORONEL JOAQUIM PIZA ', '', 914, NULL, '17.400-000', 3, '07.569.563/0001-44', '', '', NULL, 2, '2019-08-09 15:56:23'),
	(7, '', 'POSTO SÃƒO CRISTÃ“VÃƒO DE MARÃLIA LTDA', 16, 'CASTRO ALVES ', '', 1177, NULL, '17.500-000', 2, '52.052.432/0001-17', '', '', NULL, 2, '2019-08-09 16:58:25'),
	(8, '', 'ALEXANDRIA AUTO POSTO DE MARILIA', NULL, 'CASTRO ALVES ', '', 1856, NULL, '17.507-000', 2, '07.095.171/0001-90', '', '', NULL, 2, '2019-08-09 17:07:09'),
	(9, 'ATACADAO', 'CARREFOUR COMERCIO E INDUSTRIA LTDA', 39, 'LUIZ GABALDI FILHO PARTE I', 'JARDIM RIVIERA', 50, NULL, '17.507-650', 2, '45.543.915/0622-92', '', '', NULL, 2, '2019-08-20 18:58:20'),
	(10, '', 'POSTO DA ILHA DE MARILIA LTDA', 22, 'AV SAMPAIO VIDAL ', 'PORTAL DO SOL', 999, NULL, '17.500-022', 2, '61.164.364/0001-00', '', '', NULL, 2, '2019-08-23 17:13:10'),
	(11, '', 'AUTO POSTO ALVORADA DE MARILIA', NULL, 'AV MANOEL MILLER ', 'STA ISABEL', 311, NULL, '', 2, '02.418.000/0001-31', '', '', NULL, 2, '2019-09-26 18:54:12');
/*!40000 ALTER TABLE `sfm_local_trabalho` ENABLE KEYS */;

-- Copiando estrutura para tabela sepec_prod.sfm_usuarios
CREATE TABLE IF NOT EXISTS `sfm_usuarios` (
  `ID_Usuario` int(11) NOT NULL AUTO_INCREMENT,
  `NM_Pessoa` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `CPF_Usuario` char(50) NOT NULL,
  `NM_Usuario` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `Senha_Usuario` varchar(25) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `TP_Usuario` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ST_Status` varchar(30) DEFAULT NULL,
  `DH_Inclusao` datetime DEFAULT CURRENT_TIMESTAMP,
  `ID_Usuario_Inclusao` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_Usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela sepec_prod.sfm_usuarios: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `sfm_usuarios` DISABLE KEYS */;
INSERT INTO `sfm_usuarios` (`ID_Usuario`, `NM_Pessoa`, `CPF_Usuario`, `NM_Usuario`, `Senha_Usuario`, `TP_Usuario`, `ST_Status`, `DH_Inclusao`, `ID_Usuario_Inclusao`) VALUES
	(2, 'Administrador', '000.000.000-00', 'administrador', 'trocar123', 'Administrador', 'Ativo', '2019-04-25 13:29:32', 1);
/*!40000 ALTER TABLE `sfm_usuarios` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
