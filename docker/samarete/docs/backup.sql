-- --------------------------------------------------------
-- Host:                         192.168.99.100
-- Versione server:              5.7.16 - MySQL Community Server (GPL)
-- S.O. server:                  Linux
-- HeidiSQL Versione:            9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dump della struttura del database samarete
CREATE DATABASE IF NOT EXISTS `samarete` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `samarete`;

-- Dump della struttura di tabella samarete.activity_log
CREATE TABLE IF NOT EXISTS `activity_log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `subject_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` int(11) DEFAULT NULL,
  `causer_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `properties` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.associazione
CREATE TABLE IF NOT EXISTS `associazione` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `acronimo` varchar(45) DEFAULT NULL,
  `indirizzo` varchar(200) DEFAULT NULL,
  `telefono_1` varchar(20) DEFAULT NULL,
  `telefono_2` varchar(20) DEFAULT NULL,
  `referente_nome` varchar(100) DEFAULT NULL,
  `referente_indirizzo` varchar(200) DEFAULT NULL,
  `referente_telefono_1` varchar(20) DEFAULT NULL,
  `referente_telefono_2` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `sito_web` varchar(100) DEFAULT NULL,
  `descrizione` text,
  `gestore_id` int(11) NOT NULL,
  `data_creazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `attivo` tinyint(4) DEFAULT '1',
  `datapath` varchar(100) DEFAULT NULL,
  `logo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_associazione_user1_idx` (`gestore_id`),
  KEY `nome_idx` (`nome`),
  KEY `fk_associazione_file1_idx` (`logo`),
  CONSTRAINT `fk_associazione_file1` FOREIGN KEY (`logo`) REFERENCES `file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_associazione_user1` FOREIGN KEY (`gestore_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.associazione_has_evento
CREATE TABLE IF NOT EXISTS `associazione_has_evento` (
  `associazione_id` int(11) NOT NULL,
  `evento_id` int(11) NOT NULL,
  `creatore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`associazione_id`,`evento_id`),
  KEY `fk_associazione_has_evento_evento1_idx` (`evento_id`),
  KEY `fk_associazione_has_evento_associazione1_idx` (`associazione_id`),
  CONSTRAINT `fk_associazione_has_evento_associazione1` FOREIGN KEY (`associazione_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_associazione_has_evento_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.associazione_has_progetto
CREATE TABLE IF NOT EXISTS `associazione_has_progetto` (
  `associazione_id` int(11) NOT NULL,
  `progetto_id` int(11) NOT NULL,
  `creatore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`associazione_id`,`progetto_id`),
  KEY `fk_associazione_has_progetto_progetto1_idx` (`progetto_id`),
  KEY `fk_associazione_has_progetto_associazione1_idx` (`associazione_id`),
  CONSTRAINT `fk_associazione_has_progetto_associazione1` FOREIGN KEY (`associazione_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_associazione_has_progetto_progetto1` FOREIGN KEY (`progetto_id`) REFERENCES `progetto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.associazione_has_servizio
CREATE TABLE IF NOT EXISTS `associazione_has_servizio` (
  `associazione_id` int(11) NOT NULL,
  `servizio_id` int(11) NOT NULL,
  `creatore` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`associazione_id`,`servizio_id`),
  KEY `fk_associazione_has_servizio_servizio1_idx` (`servizio_id`),
  KEY `fk_associazione_has_servizio_associazione1_idx` (`associazione_id`),
  CONSTRAINT `fk_associazione_has_servizio_associazione1` FOREIGN KEY (`associazione_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_associazione_has_servizio_servizio1` FOREIGN KEY (`servizio_id`) REFERENCES `servizio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_creazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.chat_has_associazione
CREATE TABLE IF NOT EXISTS `chat_has_associazione` (
  `chat_id` int(11) NOT NULL,
  `associazione_id` int(11) NOT NULL,
  PRIMARY KEY (`chat_id`,`associazione_id`),
  KEY `fk_chat_has_associazione_associazione1_idx` (`associazione_id`),
  KEY `fk_chat_has_associazione_chat1_idx` (`chat_id`),
  CONSTRAINT `fk_chat_has_associazione_associazione1` FOREIGN KEY (`associazione_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_chat_has_associazione_chat1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.evento
CREATE TABLE IF NOT EXISTS `evento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `oggetto` varchar(200) DEFAULT NULL,
  `descrizione` text,
  `data_creazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome_idx` (`nome`),
  KEY `fk_evento_file1_idx` (`logo`),
  CONSTRAINT `fk_evento_file1` FOREIGN KEY (`logo`) REFERENCES `file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.evento_has_giorno
CREATE TABLE IF NOT EXISTS `evento_has_giorno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `evento_id` int(11) NOT NULL,
  `giorno` date NOT NULL,
  `da` time DEFAULT NULL,
  `a` time DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_evento_has_giorno_evento1_idx` (`evento_id`),
  CONSTRAINT `fk_evento_has_giorno_evento1` FOREIGN KEY (`evento_id`) REFERENCES `evento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.file
CREATE TABLE IF NOT EXISTS `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_originale` varchar(300) DEFAULT NULL,
  `dimensione` int(11) DEFAULT NULL,
  `data_caricamento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proprietario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_file_associazione1_idx` (`proprietario_id`),
  CONSTRAINT `fk_file_associazione1` FOREIGN KEY (`proprietario_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.file_tmp
CREATE TABLE IF NOT EXISTS `file_tmp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_originale` varchar(300) DEFAULT NULL,
  `dimensione` int(11) DEFAULT NULL,
  `data_caricamento` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uploader_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_file_tmp_users1_idx` (`uploader_id`),
  CONSTRAINT `fk_file_tmp_users1` FOREIGN KEY (`uploader_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.messaggio
CREATE TABLE IF NOT EXISTS `messaggio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autore_id` int(11) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `testo` text,
  `chat_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_messaggio_associazione1_idx` (`autore_id`),
  KEY `fk_messaggio_chat1_idx` (`chat_id`),
  CONSTRAINT `fk_messaggio_associazione1` FOREIGN KEY (`autore_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_messaggio_chat1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.permesso
CREATE TABLE IF NOT EXISTS `permesso` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `nome_idx` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.progetto
CREATE TABLE IF NOT EXISTS `progetto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `oggetto` varchar(200) DEFAULT NULL,
  `descrizione` text,
  `data_creazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `chat_id` int(11) NOT NULL,
  `logo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome_idx` (`nome`),
  KEY `fk_progetto_chat1_idx` (`chat_id`),
  KEY `fk_progetto_file1_idx` (`logo`),
  CONSTRAINT `fk_progetto_chat1` FOREIGN KEY (`chat_id`) REFERENCES `chat` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_progetto_file1` FOREIGN KEY (`logo`) REFERENCES `file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.progetto_has_file
CREATE TABLE IF NOT EXISTS `progetto_has_file` (
  `progetto_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  PRIMARY KEY (`progetto_id`,`file_id`),
  KEY `fk_progetto_has_file_file1_idx` (`file_id`),
  KEY `fk_progetto_has_file_progetto1_idx` (`progetto_id`),
  CONSTRAINT `fk_progetto_has_file_file1` FOREIGN KEY (`file_id`) REFERENCES `file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_progetto_has_file_progetto1` FOREIGN KEY (`progetto_id`) REFERENCES `progetto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.richiesta
CREATE TABLE IF NOT EXISTS `richiesta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contatto_1` varchar(100) DEFAULT NULL,
  `contatto_2` varchar(100) DEFAULT NULL,
  `oggetto` varchar(200) DEFAULT NULL,
  `testo` text,
  `globale` tinyint(1) DEFAULT '0',
  `data_creazione` datetime DEFAULT NULL,
  `evasa_da` int(11) DEFAULT NULL,
  `data_evasione` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_richiesta_associazione1_idx` (`evasa_da`),
  CONSTRAINT `fk_richiesta_associazione1` FOREIGN KEY (`evasa_da`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.richiesta_has_associazione
CREATE TABLE IF NOT EXISTS `richiesta_has_associazione` (
  `richiesta_id` int(11) NOT NULL,
  `associazione_id` int(11) NOT NULL,
  PRIMARY KEY (`richiesta_id`,`associazione_id`),
  KEY `fk_richiesta_has_associazione_associazione1_idx` (`associazione_id`),
  KEY `fk_richiesta_has_associazione_richiesta1_idx` (`richiesta_id`),
  CONSTRAINT `fk_richiesta_has_associazione_associazione1` FOREIGN KEY (`associazione_id`) REFERENCES `associazione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_richiesta_has_associazione_richiesta1` FOREIGN KEY (`richiesta_id`) REFERENCES `richiesta` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.ruolo
CREATE TABLE IF NOT EXISTS `ruolo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `data_creazione` datetime DEFAULT CURRENT_TIMESTAMP,
  `attivo` tinyint(4) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `nome_idx` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.ruolo_has_permesso
CREATE TABLE IF NOT EXISTS `ruolo_has_permesso` (
  `ruolo_id` int(11) NOT NULL,
  `permesso_id` int(11) NOT NULL,
  PRIMARY KEY (`ruolo_id`,`permesso_id`),
  KEY `fk_ruolo_has_permesso_permesso1_idx` (`permesso_id`),
  KEY `fk_ruolo_has_permesso_ruolo1_idx` (`ruolo_id`),
  CONSTRAINT `fk_ruolo_has_permesso_permesso1` FOREIGN KEY (`permesso_id`) REFERENCES `permesso` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ruolo_has_permesso_ruolo1` FOREIGN KEY (`ruolo_id`) REFERENCES `ruolo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.servizio
CREATE TABLE IF NOT EXISTS `servizio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `oggetto` varchar(200) DEFAULT NULL,
  `descrizione` text,
  `data_inizio` datetime DEFAULT NULL,
  `data_fine` datetime DEFAULT NULL,
  `data_creazione` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nome_idx` (`nome`),
  KEY `fk_servizio_file1_idx` (`logo`),
  CONSTRAINT `fk_servizio_file1` FOREIGN KEY (`logo`) REFERENCES `file` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.servizio_has_giorno
CREATE TABLE IF NOT EXISTS `servizio_has_giorno` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servizio_id` int(11) NOT NULL,
  `giorno` int(11) NOT NULL,
  `da` time DEFAULT NULL,
  `a` time DEFAULT NULL,
  `descrizione` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_servizio_has_giorno_servizio1_idx` (`servizio_id`),
  CONSTRAINT `fk_servizio_has_giorno_servizio1` FOREIGN KEY (`servizio_id`) REFERENCES `servizio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `cognome` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `ultimo_accesso` datetime DEFAULT NULL,
  `attivo` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_idx` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
-- Dump della struttura di tabella samarete.user_has_ruolo
CREATE TABLE IF NOT EXISTS `user_has_ruolo` (
  `user_id` int(11) NOT NULL,
  `ruolo_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`ruolo_id`),
  KEY `fk_user_has_ruolo_ruolo1_idx` (`ruolo_id`),
  KEY `fk_user_has_ruolo_user_idx` (`user_id`),
  CONSTRAINT `fk_user_has_ruolo_ruolo1` FOREIGN KEY (`ruolo_id`) REFERENCES `ruolo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_has_ruolo_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- L’esportazione dei dati non era selezionata.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
