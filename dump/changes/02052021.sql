ALTER TABLE `vertreck`.`exame`
    CHANGE COLUMN `preco_entrega` `preco_exame` DOUBLE(15,2) NULL DEFAULT NULL ;

ALTER TABLE `vertreck`.`exame_empresa`
    CHANGE COLUMN `preco_entrega` `preco_exame` DOUBLE(15,2) NOT NULL ;


/* ALTERAR STATUS 'ANÁLISES CLÍNICAS' E COLOCAR 3 QUE SIGNIFICA QUE NÃO ESTÁ SENDO MOSTRADO AO USUÁRIO. PORÉM NÃO ESTÁ EXCLUÍDO, POIS SERÁ MOSTRADO EM OUTROS LUGARES*/
update exame set status = 3 where servico = 1 and id <> 83;

DROP TABLE IF EXISTS `exame_baixa_agendamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_baixa_agendamento` (
   `id` int(11) NOT NULL AUTO_INCREMENT,
   `empresa` int(11) NOT NULL,
   `data_exame` datetime DEFAULT NULL,
   `data_baixa` datetime NOT NULL,
   `usuario_nome` varchar(255) COLLATE latin1_general_ci NOT NULL,
   `matricula` int(11) NOT NULL,
   `pdf_coleta` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
   `pdf_exame` varchar(255) COLLATE latin1_general_ci DEFAULT NULL,
   `valor_total` decimal(10,2) DEFAULT NULL,
   `status` int(11) NOT NULL,
   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exame_baixa_agendamento`
--

LOCK TABLES `exame_baixa_agendamento` WRITE;
/*!40000 ALTER TABLE `exame_baixa_agendamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `exame_baixa_agendamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `exame_baixa_agendamento_exames`
--

DROP TABLE IF EXISTS `exame_baixa_agendamento_exames`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exame_baixa_agendamento_exames` (
    `id` int(11) NOT NULL AUTO_INCREMENT,
    `exame_baixa_agendamento` int(11) NOT NULL,
    `exame` int(11) NOT NULL,
    `exame_coleta` decimal(10,2) DEFAULT NULL,
    `exame_exame` decimal(10,2) DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `vertreck`.`exame_baixa_agendamento_exames`
    CHANGE COLUMN `exame_coleta` `exame_coleta` INT(11) NULL DEFAULT NULL ,
    CHANGE COLUMN `exame_exame` `exame_exame` INT(11) NULL DEFAULT NULL ;
