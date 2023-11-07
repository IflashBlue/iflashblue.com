

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` (`id`, `order`) VALUES (1,0),(2,1),(3,2),(4,3),(5,3);
/*!40000 ALTER TABLE `category` ENABLE KEYS */;

--
-- Table structure for table `category_translation`
--

DROP TABLE IF EXISTS `category_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3F207044180C698BF396750` (`locale`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_translation`
--

/*!40000 ALTER TABLE `category_translation` DISABLE KEYS */;
INSERT INTO `category_translation` (`id`, `title`, `locale`) VALUES (1,'Graphisme','fr'),(2,'Graphic design','en'),(3,'Illustration','fr'),(4,'Illustration','en'),(5,'Motion Design','fr'),(6,'Motion Design','en'),(7,'BD & Zines','fr'),(8,'Comics & fanzines','en'),(9,'Labo','fr'),(10,'Labo','en');
/*!40000 ALTER TABLE `category_translation` ENABLE KEYS */;

--
-- Table structure for table `category_translations`
--

DROP TABLE IF EXISTS `category_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category_translations` (
  `object_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`translation_id`),
  UNIQUE KEY `UNIQ_1C60F9159CAA2B25` (`translation_id`),
  KEY `IDX_1C60F915232D562B` (`object_id`),
  CONSTRAINT `FK_1C60F915232D562B` FOREIGN KEY (`object_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1C60F9159CAA2B25` FOREIGN KEY (`translation_id`) REFERENCES `category_translation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category_translations`
--

/*!40000 ALTER TABLE `category_translations` DISABLE KEYS */;
INSERT INTO `category_translations` (`object_id`, `translation_id`) VALUES (1,1),(1,2),(2,3),(2,4),(3,5),(3,6),(4,7),(4,8),(5,9),(5,10);
/*!40000 ALTER TABLE `category_translations` ENABLE KEYS */;

--
-- Table structure for table `configuration`
--

DROP TABLE IF EXISTS `configuration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `maintenance` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration`
--

/*!40000 ALTER TABLE `configuration` DISABLE KEYS */;
INSERT INTO `configuration` (`id`, `maintenance`) VALUES (1,0);
/*!40000 ALTER TABLE `configuration` ENABLE KEYS */;

--
-- Table structure for table `configuration_translation`
--

DROP TABLE IF EXISTS `configuration_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DFFE27174180C698BF396750` (`locale`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_translation`
--

/*!40000 ALTER TABLE `configuration_translation` DISABLE KEYS */;
INSERT INTO `configuration_translation` (`id`, `city`, `email`, `locale`) VALUES (1,'Strasbourg - Bruxelle','collectif.tandem@gmail.com','fr'),(2,'Strasbourg - Bruxelle','collectif.tandem@gmail.com','en');
/*!40000 ALTER TABLE `configuration_translation` ENABLE KEYS */;

--
-- Table structure for table `configuration_translations`
--

DROP TABLE IF EXISTS `configuration_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `configuration_translations` (
  `object_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`translation_id`),
  UNIQUE KEY `UNIQ_9802B4EB9CAA2B25` (`translation_id`),
  KEY `IDX_9802B4EB232D562B` (`object_id`),
  CONSTRAINT `FK_9802B4EB232D562B` FOREIGN KEY (`object_id`) REFERENCES `configuration` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9802B4EB9CAA2B25` FOREIGN KEY (`translation_id`) REFERENCES `configuration_translation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuration_translations`
--

/*!40000 ALTER TABLE `configuration_translations` DISABLE KEYS */;
INSERT INTO `configuration_translations` (`object_id`, `translation_id`) VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `configuration_translations` ENABLE KEYS */;

--
-- Table structure for table `doctrine_migration_versions`
--

DROP TABLE IF EXISTS `doctrine_migration_versions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `doctrine_migration_versions`
--

/*!40000 ALTER TABLE `doctrine_migration_versions` DISABLE KEYS */;
INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES ('DoctrineMigrations\\Version20231028202233','2023-10-28 20:22:58',1716);
/*!40000 ALTER TABLE `doctrine_migration_versions` ENABLE KEYS */;

--
-- Table structure for table `home`
--

DROP TABLE IF EXISTS `home`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home`
--

/*!40000 ALTER TABLE `home` DISABLE KEYS */;
INSERT INTO `home` (`id`, `image`) VALUES (1,'/images/upload/Coolkids.png');
/*!40000 ALTER TABLE `home` ENABLE KEYS */;

--
-- Table structure for table `home_translation`
--

DROP TABLE IF EXISTS `home_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_9A578224180C698BF396750` (`locale`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_translation`
--

/*!40000 ALTER TABLE `home_translation` DISABLE KEYS */;
INSERT INTO `home_translation` (`id`, `title`, `description`, `locale`) VALUES (1,'Le Tandem Convergent','Hello, nous sommes Astrid Anquetin et William Christophel, deux jeunes artistes ayant décidé de se mettre en selle pour ouvrir notre studio de graphisme et d’illustration entre Strasbourg et Bruxelles. On vous laisse découvrir nos travaux ici et là, et n’hésitez pas à nous contacter pour toute information si vous pédalez trop.','fr'),(2,'Le Tandem Convergent','Hello, we are Astrid Anquetin and William Christophel, two young artists who decided to open our graphic design and illustration studio between Strasbourg and Brussels. We let you discover our work here and there, and do not hesitate to contact us for any information if you pedal too much.','en');
/*!40000 ALTER TABLE `home_translation` ENABLE KEYS */;

--
-- Table structure for table `home_translations`
--

DROP TABLE IF EXISTS `home_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `home_translations` (
  `object_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`translation_id`),
  UNIQUE KEY `UNIQ_CE672B979CAA2B25` (`translation_id`),
  KEY `IDX_CE672B97232D562B` (`object_id`),
  CONSTRAINT `FK_CE672B97232D562B` FOREIGN KEY (`object_id`) REFERENCES `home` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CE672B979CAA2B25` FOREIGN KEY (`translation_id`) REFERENCES `home_translation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `home_translations`
--

/*!40000 ALTER TABLE `home_translations` DISABLE KEYS */;
INSERT INTO `home_translations` (`object_id`, `translation_id`) VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `home_translations` ENABLE KEYS */;

--
-- Table structure for table `project`
--

DROP TABLE IF EXISTS `project`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `highlight` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `IDX_2FB3D0EE12469DE2` (`category_id`),
  CONSTRAINT `FK_2FB3D0EE12469DE2` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project`
--

/*!40000 ALTER TABLE `project` DISABLE KEYS */;
INSERT INTO `project` (`id`, `category_id`, `order`, `highlight`) VALUES (1,1,0,1),(2,1,1,1),(3,2,2,1),(4,4,3,1),(5,5,4,1);
/*!40000 ALTER TABLE `project` ENABLE KEYS */;

--
-- Table structure for table `project_image`
--

DROP TABLE IF EXISTS `project_image`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order` int(11) DEFAULT NULL,
  `image` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_image`
--

/*!40000 ALTER TABLE `project_image` DISABLE KEYS */;
INSERT INTO `project_image` (`id`, `order`, `image`) VALUES (1,0,'/images/upload/BIERE_QAR_WEB.jpg'),(2,1,'/images/upload/BIERE_CC_WEB.jpg'),(3,2,'/images/upload/GA_WEB.jpg'),(4,0,'/images/upload/SCHWENDI01_WEB.jpg'),(5,1,'/images/upload/SCHWENDI02_WEB.jpg'),(6,2,'/images/upload/SCHWENDI03_WEB.jpg'),(7,3,'/images/upload/SCHWENDI04_WEB.jpg'),(8,0,'/images/upload/DRAW01_WEB.jpg'),(9,1,'/images/upload/DRAW02_WEB.jpg'),(10,2,'/images/upload/DRAW03_WEB.jpg'),(11,3,'/images/upload/DRAW04_WEB.jpg'),(12,0,'/images/upload/RD07_WEB.jpg'),(13,1,'/images/upload/RD04_WEB.jpg'),(14,2,'/images/upload/RD01_WEB.jpg'),(15,0,'/images/upload/LINO_WEB.jpg'),(16,1,'/images/upload/TROLLEY_WEB.jpg'),(17,2,'/images/upload/MONTREUX_WEB.jpg'),(18,3,'/images/upload/DD_WEB.jpg');
/*!40000 ALTER TABLE `project_image` ENABLE KEYS */;

--
-- Table structure for table `project_images`
--

DROP TABLE IF EXISTS `project_images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_images` (
  `project_id` int(11) NOT NULL,
  `image_id` int(11) NOT NULL,
  PRIMARY KEY (`project_id`,`image_id`),
  UNIQUE KEY `UNIQ_F7BB55203DA5256D` (`image_id`),
  KEY `IDX_F7BB5520166D1F9C` (`project_id`),
  CONSTRAINT `FK_F7BB5520166D1F9C` FOREIGN KEY (`project_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F7BB55203DA5256D` FOREIGN KEY (`image_id`) REFERENCES `project_image` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_images`
--

/*!40000 ALTER TABLE `project_images` DISABLE KEYS */;
INSERT INTO `project_images` (`project_id`, `image_id`) VALUES (1,1),(1,2),(1,3),(2,4),(2,5),(2,6),(2,7),(3,8),(3,9),(3,10),(3,11),(4,12),(4,13),(4,14),(5,15),(5,16),(5,17),(5,18);
/*!40000 ALTER TABLE `project_images` ENABLE KEYS */;

--
-- Table structure for table `project_translation`
--

DROP TABLE IF EXISTS `project_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` longtext COLLATE utf8mb4_unicode_ci,
  `title` longtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_7CA6B2944180C698BF396750` (`locale`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_translation`
--

/*!40000 ALTER TABLE `project_translation` DISABLE KEYS */;
INSERT INTO `project_translation` (`id`, `slug`, `title`, `description`, `locale`) VALUES (1,'brasserie-du-grillen','BRASSERIE DU GRILLEN','<p>R&eacute;alisation de divers supports graphiques pour la Brasserie du Grillen bas&eacute;e &agrave; Colmar, notament des &eacute;tiquettes de bi&egrave;res &eacute;phm&egrave;res, ainsi que l\'identit&eacute; visuelle de leur &eacute;v&eacute;nement anniversaire pour leurs trois ans.</p>','fr'),(2,'brasserie-du-grillen','BRASSERIE DU GRILLEN','<p>Realization of various graphic supports for the Brasserie du Grillen based in Colmar, in particular labels of ephemeral beers, as well as the visual identity of their anniversary event for their three years.</p>','en'),(3,'schwendi-bier-un-wistub','SCHWENDI BIER UN WISTUB','','fr'),(4,'schwendi-bier-un-wistub','SCHWENDI BIER UN WISTUB','','en'),(5,'illustrations-prints','ILLUSTRATIONS & PRINTS','','fr'),(6,'illustrations-prints','ILLUSTRATIONS & PRINTS','','en'),(7,'fanzine-riso-pop-up-residence-dimensionnelle','FANZINE RISO POP-UP RÉSIDENCE DIMENSIONNELLE','','fr'),(8,'fanzine-riso-pop-up-residence-dimensionnelle','FANZINE RISO POP-UP RÉSIDENCE DIMENSIONNELLE','','en'),(9,'affiches-evenementielles','AFFICHES ÉVÉNEMENTIELLES','','fr'),(10,'affiches-evenementielles','AFFICHES ÉVÉNEMENTIELLES','','en');
/*!40000 ALTER TABLE `project_translation` ENABLE KEYS */;

--
-- Table structure for table `project_translations`
--

DROP TABLE IF EXISTS `project_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `project_translations` (
  `object_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`translation_id`),
  UNIQUE KEY `UNIQ_EC103EE49CAA2B25` (`translation_id`),
  KEY `IDX_EC103EE4232D562B` (`object_id`),
  CONSTRAINT `FK_EC103EE4232D562B` FOREIGN KEY (`object_id`) REFERENCES `project` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_EC103EE49CAA2B25` FOREIGN KEY (`translation_id`) REFERENCES `project_translation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `project_translations`
--

/*!40000 ALTER TABLE `project_translations` DISABLE KEYS */;
INSERT INTO `project_translations` (`object_id`, `translation_id`) VALUES (1,1),(1,2),(2,3),(2,4),(3,5),(3,6),(4,7),(4,8),(5,9),(5,10);
/*!40000 ALTER TABLE `project_translations` ENABLE KEYS */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `firstname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`),
  UNIQUE KEY `UNIQ_8D93D649E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `username`, `email`, `lastname`, `firstname`, `roles`, `password`, `image`) VALUES (1,'astroi.id','anquetin.astrid@gmail.com','Anquetin','Astrid','[\"ROLE_ADMIN\"]','$2y$13$TtlzQ6PB94B1TnjN5UVnr.0ME0kvc9cshxdXucaq//ZuNRpdlRJsW','/images/upload/ASTRID_WEB.jpg'),(2,'williamchristophel','christophel.will@gmail.com','Christophel','William','[\"ROLE_ADMIN\"]','$2y$13$.Vb1e0nuQBTtqauDjV36pOYCkVSmg3DXo5pYKBCs8tuA2xkz4e4jm','/images/upload/WILL_WEB.jpg');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

--
-- Table structure for table `user_translation`
--

DROP TABLE IF EXISTS `user_translation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_translation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `locale` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1D728CFA4180C698BF396750` (`locale`,`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_translation`
--

/*!40000 ALTER TABLE `user_translation` DISABLE KEYS */;
INSERT INTO `user_translation` (`id`, `description`, `locale`) VALUES (1,'<p>\n                                En 2019, Astrid se penche sur le milieu de la BD lors de son mémoire d\'Histoire et décide de faire un virage à 180° pour changer de voie.\n                            </p>\n                            <p>\n                                Désormais étudiante en master de bande dessinée à l\'ESA St Luc (Bruxelles), elle explore la forme du fanzine et s\'amuse via l\'objet à penser la bande dessinée toujours plus loin, équipée de son carnet de croquis et de sa tasse de thé. Toujours en quête de nouveaux médiums, elle définit peu à peu son univers empreint d\'émotions.\n                            </p>\n                            <p>\n                                Vélo : De course, pour filer entre les gouttes de pluie.\n                            </p>','fr'),(2,'<p>In 2019, Astrid looks at the comic book world during her History thesis and decides to make a 180° turn to change her path.\n                                </p>\n                                <p>Now a master student in comics at ESA St Luc (Brussels), she explores the form of the fanzine and has fun via the object to think the comic book always further, equipped with her sketchbook and her cup of tea. Always in search of new mediums, she defines little by little her universe full of emotions.\n                                </p>\n                                <p>Bicycle: Racing, to spin between the raindrops.</p>','en'),(3,'<p>\n                                Après avoir terminé ses études en graphisme publicitaire et motion design en alternance, William était un peu perdu une fois atterri dans le monde du travail . Il renoue avec l\'illustration pour se conforter dans un style qui lui correspond et lui permet de le mêler au design graphique dans ses projets. Touche à tout et (trop) curieux, il s\'étend également à l\'animation, puis aux fanzines suite à sa rencontre avec Astrid.\n                             </p>\n                             <p>\n                                Le cinéma et les BD contribuent grandement à son processus créatif, tout autant que les chocolats chauds et cookies à l\'heure du goûter.\n                             </p>\n                             <p>\n                                Vélo&nbsp;: Inchangé depuis le collège.\n                             </p>','fr'),(4,'<p>After completing his studies in advertising graphics and motion design, William was a little lost once he landed in the working world. He returned to illustration to consolidate a style that suits him and allows him to mix it with graphic design in his projects. Touching everything and (too) curious, he also extends himself to animation, then to fanzines following his meeting with Astrid.\n                                </p>\n                                <p>Movies and comics contribute greatly to his creative process, as well as hot chocolates and cookies at snack time.\n                                </p>\n                                <p>Bicycle: Unchanged since high school.</p>','en');
/*!40000 ALTER TABLE `user_translation` ENABLE KEYS */;

--
-- Table structure for table `user_translations`
--

DROP TABLE IF EXISTS `user_translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_translations` (
  `object_id` int(11) NOT NULL,
  `translation_id` int(11) NOT NULL,
  PRIMARY KEY (`object_id`,`translation_id`),
  UNIQUE KEY `UNIQ_467BA6859CAA2B25` (`translation_id`),
  KEY `IDX_467BA685232D562B` (`object_id`),
  CONSTRAINT `FK_467BA685232D562B` FOREIGN KEY (`object_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_467BA6859CAA2B25` FOREIGN KEY (`translation_id`) REFERENCES `user_translation` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;