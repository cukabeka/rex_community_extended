## Redaxo Database Dump Version 4
## Prefix rex_
## charset utf-8

DROP TABLE IF EXISTS `rex_62_params`;
CREATE TABLE `rex_62_params` (
  `field_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `prior` int(10) unsigned NOT NULL DEFAULT '0',
  `attributes` text NOT NULL,
  `type` int(10) unsigned DEFAULT NULL,
  `default` varchar(255) NOT NULL,
  `params` text,
  `validate` varchar(255) DEFAULT NULL,
  `createuser` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updateuser` varchar(255) NOT NULL,
  `updatedate` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`field_id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_62_params` WRITE;
/*!40000 ALTER TABLE `rex_62_params` DISABLE KEYS */;
INSERT INTO `rex_62_params` VALUES 
  (1,'translate:pool_file_description','med_description',1,'',2,'','','','admin',1189343866,'admin',1189344596),
  (2,'translate:pool_file_copyright','med_copyright',2,'',1,'','','','admin',1189343877,'admin',1189344617),
  (3,'translate:online_from','art_online_from',2,'',10,'','','','admin',1189344934,'admin',1189344934),
  (4,'translate:online_to','art_online_to',3,'',10,'','','','admin',1189344947,'admin',1189344947),
  (5,'translate:description','art_description',4,'',2,'','','','admin',1189345025,'admin',1189345025),
  (6,'translate:keywords','art_keywords',5,'',2,'','','','admin',1189345068,'admin',1189345068),
  (7,'translate:metadata_image','art_file',6,'',6,'','','','admin',1189345109,'admin',1189345109),
  (8,'translate:teaser','art_teaser',7,'',5,'','','','admin',1189345182,'admin',1189345182),
  (9,'translate:header_article_type','art_type_id',8,'size=1',3,'','Standard|Zugriff f&#x00b8;r alle','','admin',1191963797,'admin',1191964038),
  (10,'Zugriffsrechte','art_com_perm',1,'',3,'','0:Alle|-1:Nur nicht Eingeloggte|1:Nur Eingeloggte|2:Nur Moderatoren und Admins|3:Nur Admins','','admin',1212571475,'admin',1212152378),
  (11,'translate:com_board_perm','art_com_boardtype',11,'',3,'','0:translate:com_board_forallboards|1:translate:com_board_inallboards|2:translate:com_board_inoneboard|3:translate:com_board_noboards','','admin',1370880713,'',0),
  (12,'translate:com_board_name','art_com_boards',12,'multiple=multiple',3,'','select name as label,id from rex_com_board order by label','','admin',1370880713,'',0),
  (13,'translate:com_group_perm','art_com_grouptype',9,'',3,'','0:translate:com_group_forallgroups|1:translate:com_group_inallgroups|2:translate:com_group_inonegroup|3:translate:com_group_nogroups','','admin',1370880472,'',0),
  (14,'translate:com_group_name','art_com_groups',10,'multiple=multiple',3,'','select name as label,id from rex_com_group order by label','','admin',1370880472,'',0),
  (15,'translate:com_permtype','art_com_permtype',13,'',3,'','0:translate:com_perm_extends|1:translate:com_perm_only_logged_in|2:translate:com_perm_only_not_logged_in|3:translate:com_perm_all','','admin',1372007052,'',0);
/*!40000 ALTER TABLE `rex_62_params` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_62_type`;
CREATE TABLE `rex_62_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `dbtype` varchar(255) NOT NULL,
  `dblength` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_62_type` WRITE;
/*!40000 ALTER TABLE `rex_62_type` DISABLE KEYS */;
INSERT INTO `rex_62_type` VALUES 
  (1,'text','varchar',255),
  (2,'textarea','text',0),
  (3,'select','varchar',255),
  (4,'radio','varchar',255),
  (5,'checkbox','varchar',255),
  (10,'date','varchar',255),
  (11,'datetime','varchar',255),
  (6,'REX_MEDIA_BUTTON','varchar',255),
  (7,'REX_MEDIALIST_BUTTON','varchar',255),
  (8,'REX_LINK_BUTTON','varchar',255);
/*!40000 ALTER TABLE `rex_62_type` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_679_type_effects`;
CREATE TABLE `rex_679_type_effects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `effect` varchar(255) NOT NULL,
  `parameters` text NOT NULL,
  `prior` int(11) NOT NULL,
  `updatedate` int(11) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL,
  `createuser` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_679_type_effects` WRITE;
/*!40000 ALTER TABLE `rex_679_type_effects` DISABLE KEYS */;
INSERT INTO `rex_679_type_effects` VALUES 
  (1,1,'resize','a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"200\";s:24:\"rex_effect_resize_height\";s:3:\"200\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}',1,1370871685,'%USER%',1370871685,'%USER%'),
  (2,2,'resize','a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"600\";s:24:\"rex_effect_resize_height\";s:3:\"600\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}',1,1370871685,'%USER%',1370871685,'%USER%'),
  (3,3,'resize','a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:2:\"80\";s:24:\"rex_effect_resize_height\";s:2:\"80\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}',1,1370871685,'%USER%',1370871685,'%USER%'),
  (4,4,'resize','a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"246\";s:24:\"rex_effect_resize_height\";s:3:\"246\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}',1,1370871685,'%USER%',1370871685,'%USER%'),
  (5,5,'resize','a:6:{s:15:\"rex_effect_crop\";a:5:{s:21:\"rex_effect_crop_width\";s:0:\"\";s:22:\"rex_effect_crop_height\";s:0:\"\";s:28:\"rex_effect_crop_offset_width\";s:0:\"\";s:29:\"rex_effect_crop_offset_height\";s:0:\"\";s:24:\"rex_effect_crop_position\";s:13:\"middle_center\";}s:22:\"rex_effect_filter_blur\";a:3:{s:29:\"rex_effect_filter_blur_amount\";s:2:\"80\";s:29:\"rex_effect_filter_blur_radius\";s:1:\"8\";s:32:\"rex_effect_filter_blur_threshold\";s:1:\"3\";}s:25:\"rex_effect_filter_sharpen\";a:3:{s:32:\"rex_effect_filter_sharpen_amount\";s:2:\"80\";s:32:\"rex_effect_filter_sharpen_radius\";s:3:\"0.5\";s:35:\"rex_effect_filter_sharpen_threshold\";s:1:\"3\";}s:15:\"rex_effect_flip\";a:1:{s:20:\"rex_effect_flip_flip\";s:1:\"X\";}s:23:\"rex_effect_insert_image\";a:5:{s:34:\"rex_effect_insert_image_brandimage\";s:0:\"\";s:28:\"rex_effect_insert_image_hpos\";s:5:\"right\";s:28:\"rex_effect_insert_image_vpos\";s:6:\"bottom\";s:33:\"rex_effect_insert_image_padding_x\";s:3:\"-10\";s:33:\"rex_effect_insert_image_padding_y\";s:3:\"-10\";}s:17:\"rex_effect_resize\";a:4:{s:23:\"rex_effect_resize_width\";s:3:\"246\";s:24:\"rex_effect_resize_height\";s:3:\"246\";s:23:\"rex_effect_resize_style\";s:7:\"maximum\";s:31:\"rex_effect_resize_allow_enlarge\";s:11:\"not_enlarge\";}}',1,1370871685,'%USER%',1370871685,'%USER%');
/*!40000 ALTER TABLE `rex_679_type_effects` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_679_types`;
CREATE TABLE `rex_679_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_679_types` WRITE;
/*!40000 ALTER TABLE `rex_679_types` DISABLE KEYS */;
INSERT INTO `rex_679_types` VALUES 
  (1,1,'rex_mediapool_detail','Zur Darstellung von Bildern in der Detailansicht im Medienpool'),
  (2,1,'rex_mediapool_maximized','Zur Darstellung von Bildern im Medienpool wenn maximiert'),
  (3,1,'rex_mediapool_preview','Zur Darstellung der Vorschaubilder im Medienpool'),
  (4,1,'rex_mediabutton_preview','Zur Darstellung der Vorschaubilder in REX_MEDIA_BUTTON[]s'),
  (5,1,'rex_medialistbutton_preview','Zur Darstellung der Vorschaubilder in REX_MEDIALIST_BUTTON[]s');
/*!40000 ALTER TABLE `rex_679_types` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_action`;
CREATE TABLE `rex_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `preview` text,
  `presave` text,
  `postsave` text,
  `previewmode` tinyint(4) DEFAULT NULL,
  `presavemode` tinyint(4) DEFAULT NULL,
  `postsavemode` tinyint(4) DEFAULT NULL,
  `createuser` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updateuser` varchar(255) NOT NULL,
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `rex_article`;
CREATE TABLE `rex_article` (
  `pid` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `re_id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `catname` varchar(255) NOT NULL,
  `catprior` int(11) NOT NULL DEFAULT '0',
  `attributes` text NOT NULL,
  `startpage` tinyint(1) NOT NULL DEFAULT '0',
  `prior` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `template_id` int(11) NOT NULL DEFAULT '0',
  `clang` int(11) NOT NULL DEFAULT '0',
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `revision` int(11) DEFAULT NULL,
  `art_online_from` varchar(255) DEFAULT NULL,
  `art_online_to` varchar(255) DEFAULT NULL,
  `art_description` text,
  `art_keywords` text,
  `art_file` varchar(255) DEFAULT NULL,
  `art_teaser` varchar(255) DEFAULT NULL,
  `art_type_id` varchar(255) DEFAULT NULL,
  `art_com_perm` varchar(255) DEFAULT NULL,
  `abc` varchar(255) NOT NULL,
  `art_com_boardtype` varchar(255) NOT NULL,
  `art_com_boards` varchar(255) NOT NULL,
  `art_com_grouptype` varchar(255) NOT NULL,
  `art_com_groups` varchar(255) NOT NULL,
  `art_com_permtype` varchar(255) NOT NULL,
  PRIMARY KEY (`pid`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_article` WRITE;
/*!40000 ALTER TABLE `rex_article` DISABLE KEYS */;
INSERT INTO `rex_article` VALUES 
  (1,1,0,'Home','Home',1,'',1,1,'|',1,1212145395,1212179760,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (2,2,0,'_Usernavi','_Usernavi',6,'',1,1,'|',0,1212167827,1212169137,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (3,3,2,'Mein Profil','Mein Profil',1,'',1,1,'|2|',1,1212149431,1212155738,1,0,'admin','admin',0,'1212098400','1212098400','','','','||','Standard','1','','','','','',''),
  (4,4,0,'Suche nach Mitgliedern','Suche nach Mitgliedern',4,'',1,1,'|',1,1212145398,1212186016,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (5,5,2,'Kontakte','Kontakte',2,'',1,1,'|2|',1,1212149432,1212155774,1,0,'admin','admin',0,'1212098400','1212098400','','','','||','Standard','1','','','','','',''),
  (6,6,2,'Nachrichten','Nachrichten',3,'',1,1,'|2|',1,1212149433,1212155792,1,0,'admin','admin',0,'1212098400','1212098400','','','','||','Standard','1','','','','','',''),
  (7,7,0,'Foren','Foren',3,'',1,1,'|',1,1212145397,1212165384,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (8,8,2,'Rundmail','Rundmail',4,'',1,1,'|2|',1,1212149434,1212170475,1,0,'admin','admin',0,'1212098400','1212098400','','','','||','Standard','3','','','','','',''),
  (9,9,0,'Das AddOn','Das AddOn',2,'',1,1,'|',1,1212145396,1212190602,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (10,10,4,'Mitgliederdetails','Suche nach Mitgliedern',0,'',0,2,'|4|',1,1212050458,1212572567,1,0,'admin','admin',0,'1212530400','1212530400','','','','||','Standard','1','','','','','',''),
  (11,11,5,'Meine Kontakte','Meine Kontakte',1,'',1,1,'|2|5|',0,1212051079,1372002465,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (12,12,5,'Angefragte Kontakte','Angefragte Kontakte',2,'',1,1,'|2|5|',0,1212051086,1212159215,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (13,13,5,'Zu bestätigende Kontakte','Zu bestätigende Kontakte',3,'',1,1,'|2|5|',0,1212051094,1372002622,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (14,14,3,'Basisdaten','Basisdaten',1,'',1,1,'|2|3|',0,1212051113,1371908415,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (15,15,3,'Kontaktdaten','Kontaktdaten',2,'',1,1,'|2|3|',0,1212051120,1371855785,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (16,16,3,'Passwort','Passwort',4,'',1,1,'|2|3|',0,1212051128,1371856615,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (17,17,3,'Persönliches','Persönliches',3,'',1,1,'|2|3|',0,1212051134,1371855625,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (18,18,3,'Gästebuch','Gästebuch',5,'',1,1,'|2|3|',0,1212051141,1371906696,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (19,19,6,'Eingang','Eingang',1,'',1,1,'|2|6|',0,1212051912,1212162813,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (20,20,6,'Ausgang','Ausgang',2,'',1,1,'|2|6|',0,1212051919,1212162819,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (21,21,6,'Post abschicken','Post abschicken',3,'',1,1,'|2|6|',0,1212051927,1212165700,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (22,22,0,'_Community','_Community',7,'',1,1,'|',0,1212052208,1212145366,0,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (23,23,22,'Login','Login',1,'',1,1,'|22|',0,1212052225,1212052271,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (24,24,22,'Registrierung','Registrierung',2,'',1,1,'|22|',0,1212052232,1371997687,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (25,25,22,'Passwort vergessen','Passwort vergessen',3,'',1,1,'|22|',0,1212052241,1212153113,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (26,26,24,'Registierungsbestätigung','Registrierung',0,'',0,2,'|22|24|',0,1212052257,1371997184,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (27,27,0,'Impressum','Impressum',5,'',1,1,'|',1,1212190166,1212190571,1,0,'admin','admin',0,'','','','','','','','','','','','','',''),
  (28,28,2,'Profile','Profile',5,'',1,1,'|2|',1,1372003039,1372003063,1,0,'admin','admin',0,'','','','','','','','','','','','','','');
/*!40000 ALTER TABLE `rex_article` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_article_slice`;
CREATE TABLE `rex_article_slice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clang` int(11) NOT NULL DEFAULT '0',
  `ctype` int(11) NOT NULL DEFAULT '0',
  `re_article_slice_id` int(11) NOT NULL DEFAULT '0',
  `value1` text,
  `value2` text,
  `value3` text,
  `value4` text,
  `value5` text,
  `value6` text,
  `value7` text,
  `value8` text,
  `value9` text,
  `value10` text,
  `value11` text,
  `value12` text,
  `value13` text,
  `value14` text,
  `value15` text,
  `value16` text,
  `value17` text,
  `value18` text,
  `value19` text,
  `value20` text,
  `file1` varchar(255) DEFAULT NULL,
  `file2` varchar(255) DEFAULT NULL,
  `file3` varchar(255) DEFAULT NULL,
  `file4` varchar(255) DEFAULT NULL,
  `file5` varchar(255) DEFAULT NULL,
  `file6` varchar(255) DEFAULT NULL,
  `file7` varchar(255) DEFAULT NULL,
  `file8` varchar(255) DEFAULT NULL,
  `file9` varchar(255) DEFAULT NULL,
  `file10` varchar(255) DEFAULT NULL,
  `filelist1` text,
  `filelist2` text,
  `filelist3` text,
  `filelist4` text,
  `filelist5` text,
  `filelist6` text,
  `filelist7` text,
  `filelist8` text,
  `filelist9` text,
  `filelist10` text,
  `link1` varchar(10) DEFAULT NULL,
  `link2` varchar(10) DEFAULT NULL,
  `link3` varchar(10) DEFAULT NULL,
  `link4` varchar(10) DEFAULT NULL,
  `link5` varchar(10) DEFAULT NULL,
  `link6` varchar(10) DEFAULT NULL,
  `link7` varchar(10) DEFAULT NULL,
  `link8` varchar(10) DEFAULT NULL,
  `link9` varchar(10) DEFAULT NULL,
  `link10` varchar(10) DEFAULT NULL,
  `linklist1` text,
  `linklist2` text,
  `linklist3` text,
  `linklist4` text,
  `linklist5` text,
  `linklist6` text,
  `linklist7` text,
  `linklist8` text,
  `linklist9` text,
  `linklist10` text,
  `php` text,
  `html` text,
  `article_id` int(11) NOT NULL DEFAULT '0',
  `modultyp_id` int(11) NOT NULL DEFAULT '0',
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `next_article_slice_id` int(11) DEFAULT NULL,
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`re_article_slice_id`,`article_id`,`modultyp_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_article_slice` WRITE;
/*!40000 ALTER TABLE `rex_article_slice` DISABLE KEYS */;
INSERT INTO `rex_article_slice` VALUES 
  (1,0,1,15,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','14','15','17','16','18','','','','','','','','','','','','','','','','','',3,7,1212148883,1212154643,'admin','admin',0,0),
  (2,0,1,0,'0','','html|<div class=\"spcl-bgcolor\">\r\nhtml|<input type=\"hidden\" name=\"tab\" value=\"0\" />\r\n\r\nobjparams|form_showformafterupdate|1\r\nobjparams|form_action|index.php?article_id=3\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-kontaktdaten\">#</div>\r\n\r\n\r\nshowvalue|login|Login\r\n\r\nmediafile|image|Persönliches Bild|3|100|jpg,gif,png\r\n\r\nselect|show_basisinfo|Basisdaten|Privat - unsichtbar für alle=0,Sichtbar für meine Kontakte=1,öffentlich - für alle sichtbar=2\r\n\r\n\r\nselect|gender|Anrede *|Frau=2,Herr=1|2\r\ntext|firstname|Vorname *:\r\ntext|name|Nachname *:\r\n\r\ntextarea|motto|Mein Motto\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\nvalidate|notEmpty|gender|Bitte wählen Sie Ihr Geschlecht aus\r\nvalidate|notEmpty|firstname|Bitte geben Sie Ihren Vornamen ein.\r\nvalidate|notEmpty|name|Bitte geben Sie Ihren Namen ein.\r\n\r\nhtml|<div class=\"clearer\"> </div></div>\r\n\r\naction|redirect|3','','','Vielen Dank für die Aktualisierung','0','rex_com_user','<?php \r\n\r\n$user_id = 0;\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"])) $user_id = $REX[\"COM_USER\"]->getValue(\"id\");\r\n$xform->setObjectparams(\"main_where\",\"id=$user_id\");\r\n\r\n?>','1','2','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',14,5,1212148925,1371908415,'admin','admin',0,0),
  (14,0,1,0,'0','','html|<div class=\"spcl-bgcolor\">\r\nhidden|tab||REQUEST|no_db\r\n\r\nobjparams|form_showformafterupdate|1\r\nobjparams|article_id|3\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-kontaktdaten\">#</div>\r\n\r\nselect|show_contactinfo|Kontaktdaten|Privat - unsichtbar für alle=0,Sichtbar für meine Kontakte=1,Öffentlich - f&ür alle sichtbar=2\r\n\r\ncheckbox|sendemail_contactrequest|E-Mail senden wenn Kontakt angefragt wurde|1\r\n\r\ntext|street|Strasse\r\n\r\ntext|zip|Postleitzahl\r\ntext|city|Ort\r\n\r\nshowvalue|email|E-Mail\r\n\r\ntext|phone|Telefonnummer\r\ntext|fax|Fax\r\ntext|icq|ICQ\r\ntext|skype|Skype\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\nhtml|<div class=\"clearer\"> </div></div>','','','Vielen Dank f&#x00b8;r die Aktualisierung','0','rex_com_user','<?php \r\n\r\n$user_id = 0;\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"])) $user_id = $REX[\"COM_USER\"]->getValue(\"id\");\r\n$xform->setObjectparams(\"main_where\",\"id=$user_id\");\r\n\r\n?>','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',15,5,1212154599,1371851820,'admin','admin',0,0),
  (3,0,1,0,'0','','html|<div class=\"spcl-bgcolor\">\r\n\r\nhidden|tab|2|REQUEST|no_db\r\nobjparams|form_showformafterupdate|1\r\nhidden|article_id|3|REQUEST|\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-kontaktdaten\">#</div>\r\n\r\npassword|password|Passwort\r\npassword|password_2|Passwort wiederholen||no_db\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\nvalidate|compare|password|password_2|Bitte geben Sie das gleiche Passwort ein\r\nvalidate|notEmpty|password|Bitte geben Sie ein Passwort ein.\r\n\r\nhtml|<div class=\"clearer\"> </div></div>','','','Passwort wurde aktualisiert','0','rex_com_user','<?php \r\n\r\n$user_id = 0;\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"])) $user_id = $REX[\"COM_USER\"]->getValue(\"id\");\r\n$xform->setObjectparams(\"main_where\",\"id=$user_id\");\r\n\r\n?>','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',16,5,1212149080,1371856615,'admin','admin',0,0),
  (4,0,1,0,'0','','html|<div class=\"spcl-bgcolor\">\r\nhidden|tab||REQUEST|no_db\r\nhidden|article_id||REQUEST|no_db\r\n\r\nobjparams|form_showformafterupdate|1\r\nobjparams|article_id|3\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-kontaktdaten\">#</div>\r\n\r\nselect|show_personalinfo|Persönliche Daten|Privat - unsichtbar für alle=0,Sichtbar für meine Kontakte=1,Öffentlich - für alle sichtbar=2\r\n\r\ncheckbox|sendemail_guestbook|E-Mail senden wenn ein neuer Gästebucheintrag vorhanden ist.|1\r\n\r\ndate|birthday|Geburtsdatum|1900|2010|###Y###-###M###-###D###|0\r\ntextarea|hobby|Hobbies\r\ntextarea|interests|Mich interessiert\r\ntextarea|more|Mehr Über mich\r\n\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\nhtml|<div class=\"clearer\"> </div></div>','','','Vielen Dank f&#x00b8;r die Aktualisierung','0','rex_com_user','<?php \r\n\r\n$user_id = 0;\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"])) $user_id = $REX[\"COM_USER\"]->getValue(\"id\");\r\n// $mainwhere = \"id=$user_id\"; \r\n$xform->setObjectparams(\"main_where\",\"id=$user_id\");\r\n\r\n?>','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',17,5,1212149166,1371852107,'admin','admin',0,0),
  (5,0,1,16,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','11','12','13','','','','','','','','','','','','','','','','','','','',5,7,1212149374,0,'admin','',0,0),
  (6,0,1,17,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','19','20','21','','','','','','','','','','','','','','','','','','','',6,7,1212149423,0,'admin','',0,0),
  (7,0,1,12,'','','html|<div class=\"com-tab com-tab-no-navi\"><div class=\"com-tab-cntnt\"><div class=\"com-tab-cntnt-2\"><div class=\"com-tab-cntnt-3\">\r\n\r\ngenerate_key|activation_key\r\nhidden|status|0\r\nhidden|sendemail_newletter|1\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-register\">#</div>\r\n\r\n\r\nfieldset|Login-Daten:\r\ntext|login|Benutzername:*|\r\n\r\npassword|password|Ihr Passwort:*|\r\npassword|password_2|Ihr Passwort wiederholen:*||no_db\r\ntext|email|E-Mail:*|\r\nmailto|email\r\n\r\nfieldset|Stammdaten:\r\nselect|gender|Anrede *|Frau=2,Herr=1|2\r\ntext|firstname|Vorname:*|\r\ntext|name|Nachname:*|\r\n\r\n\r\nhtml|* Pflichtfelder\r\n\r\ncaptcha|Bitte geben Sie den entsprechenden Sicherheitscode ein|Falsche Eingabe des Codes\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\n\r\nvalidate|notEmpty|firstname|Bitte geben Sie Ihren Vornamen ein.\r\nvalidate|notEmpty|name|Bitte geben Sie Ihren Namen ein.\r\nvalidate|email|email|Bitte geben Sie die E-Mail ein.\r\nvalidate|unique|email|Diese E-Mail existiert schon\r\nvalidate|unique|login|Dieses Login existiert schon\r\nvalidate|notEmpty|login|Bitte geben Sie Ihr Login ein.\r\nvalidate|notEmpty|password|Bitte geben Sie ein Passwort ein.\r\nvalidate|compare|password|password_2|Bitte geben Sie zweimal das gleiche Passwort ein\r\n\r\naction|db|rex_com_user\r\naction|db2email|register|email\r\n\r\nhtml|</div></div></div></div>','','','h1. Vielen Dank \r\n\r\nDanke für Ihre Registrierung und willkommen in der Community!','0','rex_com_user','','','2','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',24,5,1212149588,1371997687,'admin','admin',0,0),
  (8,0,1,13,'','','html|<div class=\"com-tab com-tab-no-navi\"><div class=\"com-tab-cntnt\"><div class=\"com-tab-cntnt-2\"><div class=\"com-tab-cntnt-3\">\r\n\r\nfieldset|\r\n\r\ntext|login|Login:\r\ncaptcha|Bitte geben Sie diese Buchstabenfolge hier ein:|Die Kontrollbuchstaben waren falsch\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-pswvergessen\">#</div>\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Absenden|[no_db]\r\n\r\nvalidate|notEmpty|login|Bitte geben Sie ein Login ein\r\nvalidate|existintable|login|rex_com_user|login|Dieses Login existiert nicht.\r\n\r\naction|readtable|rex_com_user|login|login\r\naction|db2email|send_password|email\r\n\r\nhtml|<div class=\"clearer\"></div></div></div></div></div>','','','Vielen Dank. Ihnen wurde soeben das Passwort zugesendet.','0','','<?php \r\n\r\n$xform->setObjectparams(\"main_where\",\'login=\"###login###\"\');\r\n\r\n?>','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',25,5,1212149697,0,'admin','',0,0),
  (9,0,1,0,'0','','hidden|status|1\r\nobjparams|Error-occured|Die Best&#x2030;tigung ist leider fehlgeschlagen\r\nobjparams|Error-Code-EntryNotFound|Ihr Eintrag wurde nicht gefunden\r\nobjparams|submit_btn_show|0\r\nobjparams|send|1\r\n','','','Vielen Dank f&#x00b8;r Ihre Best&#x2030;tigung. Ihr Zugang ist nun freigeschaltet. ','0','rex_com_user','<?php\r\n\r\n$uid = rex_request(\"uid\",\"int\",0);\r\n$activation_key = rex_request(\"activation_key\",\"string\",\"\");\r\n$login = rex_request(\"login\",\"string\",\"\");\r\n$mainwhere = \'id=\'.$uid.\' AND activation_key=\"\'.$activation_key.\'\" AND login=\"\'.$login.\'\"\';\r\n$xform->setObjectparams(\"main_where\",$mainwhere);\r\n\r\n?>','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',26,5,1212149758,0,'admin','',0,0),
  (10,0,1,39,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',4,8,1212149873,0,'admin','',0,0),
  (11,0,1,40,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',10,9,1212149908,0,'admin','',0,0),
  (12,0,1,0,'Registrierung','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',24,1,1212152949,0,'admin','',0,0),
  (13,0,1,0,'Passwort vergessen?','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',25,1,1212153113,0,'admin','',0,0),
  (15,0,1,0,'Mein Profil','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',3,1,1212155738,0,'admin','',0,0),
  (16,0,1,0,'Kontakte','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',5,1,1212155774,0,'admin','',0,0),
  (17,0,1,0,'Nachrichten','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',6,1,1212155792,0,'admin','',0,0),
  (18,0,1,0,'0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','5','','','','','','','','','','','','','','','','','','','','','',11,10,1212159056,0,'admin','',0,0),
  (19,0,1,0,'1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','5','','','','','','','','','','','','','','','','','','','','','',12,10,1212159188,1212159215,'admin','admin',0,0),
  (20,0,1,0,'2','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','5','','','','','','','','','','','','','','','','','','','','','',13,10,1212159204,0,'admin','',0,0),
  (21,0,1,0,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',18,12,1212161489,1371852173,'admin','admin',0,0),
  (22,0,1,31,'Startseite','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,1,1212161492,0,'admin','',0,0),
  (23,0,1,22,'Mit Blindheit per Definition geschlagen, dennoch nicht unsichtbar, pr&#x2030;sentiere ich mich als unbeachtetes und ungeliebtes Stiefkind zeitgen&#x02c6;ssischer Literatur. Meine Bestimmung liegt - wie ich selbst - in engen Grenzen und ist rein platzhalterischer Natur. Kann ein missbrauchtes Wortgef&#x00b8;ge eigentlich noch Schlimmeres erleiden, als Blindtext erdacht und vor der &#x00f7;ffentlichkeit versteckt zu werden?','','','','','','','0','t','','','','','','','','','','','','visual.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,2,1212161971,1212165225,'admin','admin',0,0),
  (41,0,1,42,'Design und Community AddOn von:\r\n\r\nYakamara Media GmbH &amp; Co. KG\r\nAnsprechpartner: Jan Kristinus\r\nWandersmannstra&#xfb02;e 68\r\n65205 Wiesbaden\r\n\r\nTel +49 611 504.599.21\r\nFax +49 611 504.599.30\r\n\r\nE-Mail info[at]redaxo.de\r\nInternet \"http://www.yakamara.de\":http://www.yakamara.de\r\nInternet \"http://www.redaxo.de\":http://www.redaxo.de\r\n\r\nmit freundlicher Unterst&#x00b8;tzung von Thomas Blum (CSS).\r\n\r\nDesign nur verwendbar mit Google Adsense Leiste oder Spende an \"REDAXO\":http://www.redaxo.de (Rechnung kann gestellt werden)\r\n\r\nPhoto von \"www.istockphoto.com\":http://www.istockphoto.com, weitere Nutzung nicht erlaubt.\r\n\r\n','','','','','','','1','l','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',27,2,1212190225,1212190571,'admin','admin',0,0),
  (25,0,1,23,'Mit Blindheit per Definition geschlagen, dennoch nicht unsichtbar, pr&#x2030;sentiere ich mich als unbeachtetes und ungeliebtes Stiefkind zeitgen&#x02c6;ssischer Literatur. Meine Bestimmung liegt &ntilde; wie ich selbst &ntilde; in engen Grenzen und ist rein platzhalterischer Natur. Kann ein missbrauchtes Wortgef&#x00b8;ge eigentlich noch Schlimmeres erleiden, als Blindtext erdacht und vor der &#x00f7;ffentlichkeit versteckt zu werden?','','','','','','','','r','','','','','','','','','','','','visual_2.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,2,1212162216,0,'admin','',0,0),
  (39,0,1,0,'Suche nach Mitgliedern','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',4,1,1212186016,0,'admin','',0,0),
  (40,0,1,0,'Mitgliederdetails','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',10,1,1212186025,0,'admin','',0,0),
  (26,0,1,0,'0','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','6','','','','','','','','','','','','','','','','','','','','','',19,14,1212162771,0,'admin','',0,0),
  (27,0,1,0,'1','1','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','20','','','','','','','','','','','','','','','','','','','','','',20,14,1212162787,0,'admin','',0,0),
  (28,0,1,0,'','','html|<div class=\"spcl-bgcolor\">\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-messagesend\">#</div>\r\n\r\nfieldset|\r\nhidden|tab|0|REQUEST|no_db\r\nhidden|article_id||REQUEST|no_db\r\n\r\ntimestamp|create_datetime\r\ncom_user|user_id|id||hidden\r\ncom_user|from_user_id|id|Absender\r\ncom_messageto|to_user_id|Empf&#x2030;nger\r\ntext|subject|Betreff\r\ntextarea|body|Nachricht\r\n\r\n\r\nobjparams|submit_btn_show|0\r\nsubmit||Abschicken|no_db\r\n\r\nvalidate|notEmpty|subject|Bitte geben Sie den Betreff ein\r\nvalidate|notEmpty|body|Bitte geben Sie die Nachricht ein\r\n\r\naction|db|rex_com_message\r\naction|user_action|to_user_id|sendemail_newmessage\r\naction|copy_value|to_user_id|user_id\r\naction|db|rex_com_message\r\n\r\nhtml|<div class=\"clearer\"> </div></div>','','','Ihre Nachricht wurde versendet','0','rex_com_message','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',21,5,1212163014,1212165700,'admin','admin',0,0),
  (33,0,1,0,'allgemein','Allgemeines Board','','','','','user','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',7,16,1212165384,0,'admin','',0,0),
  (31,0,2,0,'liegt &ntilde; wie ich selbst &ntilde; in engen Grenzen und ist rein platzhalterischer Natur. Kann ein missbrauchtes Wortgef&#x00b8;ge eigentlich noch Schlimmeres erleiden, als Blindtext erdacht und vor der &#x00f7;ffentlichkeit versteckt zu werden?','Meine',' / Bestimmung','','','','','1','t','','','','','','','','','','','','visual_2.jpg','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,2,1212164767,0,'admin','',0,0),
  (37,0,1,38,'','','html|<div class=\"com-tab com-tab-no-navi\"><div class=\"com-tab-cntnt\"><div class=\"com-tab-cntnt-2\"><div class=\"com-tab-cntnt-3\">\r\n\r\nobjparams|form_wrap|<div id=\"rex-form\" class=\"form-messagesend\">#</div>\r\nhtml|<div class=\"spcl-bgcolor\">\r\n\r\ntimestamp|create_datetime\r\n\r\ncom_user|user_id|id||hidden\r\ncom_user|from_user_id|id|Absender\r\n\r\ntext|subject|Betreff\r\ntextarea|body|Nachricht\r\n\r\nobjparams|submit_btn_show|0\r\n\r\nsubmit|submit|Abschicken|no_db\r\n\r\n\r\nvalidate|notEmpty|subject|Bitte geben Sie den Betreff ein\r\nvalidate|notEmpty|body|Bitte geben Sie die Nachricht ein\r\n\r\naction|com_send_msg2all|subject|body|user_id\r\n\r\nhtml|<div class=\"clearer\"> </div></div>\r\n\r\nhtml|</div>\r\nhtml|</div>\r\n\r\nhtml|</div>\r\nhtml|</div>\r\n','','','Vielen Dank f&#x00b8;r den Versand der Rundmail','0','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',8,5,1212170082,1212170437,'admin','admin',0,0),
  (34,0,2,0,'Rechts ist nun der private Bereich zu sehen. \r\n\r\nMit Blindheit per Definition geschlagen, dennoch nicht unsichtbar, pr&#x2030;sentiere ich mich als unbeachtetes und ungeliebtes Stiefkind zeitgen&#x02c6;ssischer Literatur. Meine Bestimmung liegt &ntilde; wie ich selbst &ntilde; in engen Grenzen','Community Demo','Privater Bereich','','','','','1','l','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',2,2,1212165634,1212169137,'admin','admin',0,0),
  (36,0,1,25,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',1,18,1212166745,0,'admin','',0,0),
  (38,0,1,0,'Rundmail senden','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',8,1,1212170475,0,'admin','',0,0),
  (42,0,1,0,'Impressum','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',27,1,1212190237,0,'admin','',0,0),
  (43,0,1,0,'Das AddOn','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',9,1,1212190602,0,'admin','',0,0),
  (44,0,1,0,'','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','',28,9,1372003063,1372003063,'admin','admin',0,0);
/*!40000 ALTER TABLE `rex_article_slice` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_clang`;
CREATE TABLE `rex_clang` (
  `id` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `rex_clang` WRITE;
/*!40000 ALTER TABLE `rex_clang` DISABLE KEYS */;
INSERT INTO `rex_clang` VALUES 
  (0,'deutsch',0);
/*!40000 ALTER TABLE `rex_clang` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_board`;
CREATE TABLE `rex_com_board` (
  `name` text NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `﻿message_id` text NOT NULL,
  `re_message_id` text NOT NULL,
  `last_message_id` text NOT NULL,
  `board_id` text NOT NULL,
  `user_id` text NOT NULL,
  `user_email` text NOT NULL,
  `user_registered` text NOT NULL,
  `replies` text NOT NULL,
  `last_entry` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `stamp` text NOT NULL,
  `status` text NOT NULL,
  `file_id` text NOT NULL,
  `message_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_com_board` WRITE;
/*!40000 ALTER TABLE `rex_com_board` DISABLE KEYS */;
INSERT INTO `rex_com_board` VALUES 
  ('',1,'1','0','','allgemein','test','','','0','1372013156','Test','Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Morbi commodo, ipsum sed pharetra gravida, orci magna rhoncus neque, id pulvinar odio lorem non turpis. Nullam sit amet enim. Suspendisse id velit vitae ligula volutpat condimentum. Aliquam erat volutpat. Sed quis velit. Nulla facilisi. Nulla libero. Vivamus pharetra posuere sapien. \r\n\r\nNam consectetuer. Sed aliquam, nunc eget euismod ullamcorper, lectus nunc ullamcorper orci, fermentum bibendum enim nibh eget ipsum. Donec porttitor ligula eu dolor. Maecenas vitae nulla consequat libero cursus venenatis. Nam magna enim, accumsan eu, blandit sed, blandit a, eros.\r\n','1372013156','1','','');
/*!40000 ALTER TABLE `rex_com_board` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_comment`;
CREATE TABLE `rex_com_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `article_id` int(11) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `create_datetime` int(11) NOT NULL DEFAULT '0',
  `email` text NOT NULL,
  `name` text NOT NULL,
  `www` text NOT NULL,
  `update_datetime` varchar(255) NOT NULL,
  `ckey` text NOT NULL,
  `info_email` varchar(255) NOT NULL,
  `reply_to` text NOT NULL,
  `ukey` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_com_comment` WRITE;
/*!40000 ALTER TABLE `rex_com_comment` DISABLE KEYS */;
INSERT INTO `rex_com_comment` VALUES 
  (1,1,1,'Hi°',1,0,'','','','','','','','');
/*!40000 ALTER TABLE `rex_com_comment` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_contact`;
CREATE TABLE `rex_com_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `to_user_id` int(11) NOT NULL DEFAULT '0',
  `requested` tinyint(4) NOT NULL DEFAULT '0',
  `accepted` tinyint(4) NOT NULL DEFAULT '0',
  `create_datetime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `rex_com_contact` WRITE;
/*!40000 ALTER TABLE `rex_com_contact` DISABLE KEYS */;
INSERT INTO `rex_com_contact` VALUES 
  (1,2,1,0,0,1372004769),
  (2,1,2,1,0,1372004769);
/*!40000 ALTER TABLE `rex_com_contact` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_group`;
CREATE TABLE `rex_com_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_com_group` WRITE;
/*!40000 ALTER TABLE `rex_com_group` DISABLE KEYS */;
INSERT INTO `rex_com_group` VALUES 
  (1,'A'),
  (2,'B'),
  (3,'C');
/*!40000 ALTER TABLE `rex_com_group` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_guestbook`;
CREATE TABLE `rex_com_guestbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `from_user_id` int(11) NOT NULL DEFAULT '0',
  `text` longtext NOT NULL,
  `create_datetime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

LOCK TABLES `rex_com_guestbook` WRITE;
/*!40000 ALTER TABLE `rex_com_guestbook` DISABLE KEYS */;
INSERT INTO `rex_com_guestbook` VALUES 
  (2,1,1,'test',1371853300),
  (17,1,1,'Hi, ich schreibe was neues',1371909077),
  (18,2,1,'Hi Olala',1372004725),
  (19,2,1,'Hi Olala',1372004761),
  (20,2,1,'Hallo!',1372004839);
/*!40000 ALTER TABLE `rex_com_guestbook` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_message`;
CREATE TABLE `rex_com_message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `from_user_id` int(11) NOT NULL DEFAULT '0',
  `to_user_id` int(11) NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `body` mediumtext NOT NULL,
  `create_datetime` int(11) NOT NULL DEFAULT '0',
  `deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
DROP TABLE IF EXISTS `rex_com_user`;
CREATE TABLE `rex_com_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `activation_key` varchar(255) NOT NULL,
  `session_key` text NOT NULL,
  `last_action_time` varchar(255) NOT NULL,
  `authsource` text NOT NULL,
  `facebookid` text NOT NULL,
  `password_hash` text NOT NULL,
  `rex_com_board` text NOT NULL,
  `rex_com_group` text NOT NULL,
  `gender` text NOT NULL,
  `image` text NOT NULL,
  `admin` varchar(255) NOT NULL,
  `city` text NOT NULL,
  `motto` text NOT NULL,
  `sendemail_newletter` text NOT NULL,
  `show_basisinfo` text NOT NULL,
  `show_contactinfo` text NOT NULL,
  `show_personalinfo` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_com_user` WRITE;
/*!40000 ALTER TABLE `rex_com_user` DISABLE KEYS */;
INSERT INTO `rex_com_user` VALUES 
  (1,'test','test','Nachname','Vorname','test@test.de',1,'','','1370874253','','','','3','1,2,3','Mann','','1','Städtchen','Mein Motto','','','',''),
  (2,'olala','793f970c52ded1276b9264c742f19d1888cbaf73','la','ola','lala@trashmail.de',1,'','','1371997391','','','','','3','Mann','','0','dorf','motoo','','1','1','1'),
  (3,'olalar','ola','la','ola','olala@trashmail.de',0,'a5387a124e3c7842e49cfaedf65a4ef4','','','','','','','','2','','','','','1','','',''),
  (4,'lala','4d13fcc6eda389d4d679602171e11593eadae9b9','la','la','lala@lala.de',1,'0e2944781939b5205ccf712fae30271b','','1372008326','','','','','','Frau','','0','','','1','','0','0');
/*!40000 ALTER TABLE `rex_com_user` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_com_user_field`;
CREATE TABLE `rex_com_user_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prior` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `userfield` varchar(255) NOT NULL,
  `type` int(11) NOT NULL DEFAULT '0',
  `extra1` varchar(255) NOT NULL,
  `extra2` varchar(255) NOT NULL,
  `extra3` varchar(255) NOT NULL,
  `inlist` tinyint(4) NOT NULL DEFAULT '0',
  `editable` tinyint(4) NOT NULL DEFAULT '0',
  `mandatory` tinyint(4) NOT NULL DEFAULT '0',
  `defaultvalue` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_com_user_field` WRITE;
/*!40000 ALTER TABLE `rex_com_user_field` DISABLE KEYS */;
INSERT INTO `rex_com_user_field` VALUES 
  (1,10,'Login','login',2,'','','',1,1,1,''),
  (2,20,'Passwort','password',2,'','','',0,1,0,''),
  (3,30,'Email','email',2,'','','',1,1,0,''),
  (4,40,'Status','status',5,'0=inaktiv|1=aktiv|2=angefragt','','',1,1,1,''),
  (5,100,'session_id','session_id',2,'','','',0,1,0,''),
  (6,110,'last_xs','last_xs',1,'','','',0,1,0,''),
  (7,120,'last_login','last_login',1,'','','',0,1,0,''),
  (8,140,'email_checked','email_checked',6,'','','',0,1,0,''),
  (9,150,'activation_key','activation_key',2,'','','',0,1,0,''),
  (10,160,'last_newsletterid','last_newsletterid',2,'','','',0,1,0,''),
  (11,200,'gender','gender',5,'1=m&amp;auml;nnlich|2=weiblich','','',0,1,0,''),
  (36,205,'Bildname','image',2,'','','',1,1,0,''),
  (12,210,'Name','name',2,'','','',1,1,0,''),
  (14,220,'Vorname','firstname',2,'','','',1,1,0,''),
  (15,230,'Strasse','street',2,'','','',0,1,0,''),
  (16,240,'PLZ','zip',2,'','','',0,1,0,''),
  (17,250,'Ort/Stadt','city',2,'','','',0,1,0,''),
  (18,260,'Telefon','phone',2,'','','',0,1,0,''),
  (39,261,'Fax','fax',2,'','','',0,1,0,''),
  (40,262,'ICQ','icq',2,'','','',0,1,0,''),
  (41,263,'Skype','skype',2,'','','',0,1,0,''),
  (13,280,'Geburtstag','birthday',2,'','','',1,1,0,''),
  (37,299,'Basisinfo anzeigen','show_basisinfo',5,'0=Privat - unsichtbar f&amp;uuml;r alle|1=Sichtbar f&amp;uuml;r meine Kontakte|2=&amp;ouml;ffentlich - f&amp;uuml;r alle sichtbar','','',0,1,1,'0'),
  (19,300,'Kontaktinfo anzeigen','show_contactinfo',5,'0=Privat - unsichtbar f&amp;uuml;r alle|1=Sichtbar f&amp;uuml;r meine Kontakte|2=&amp;ouml;ffentlich - f&amp;uuml;r alle sichtbar','','',0,1,1,'0'),
  (20,310,'Pers&#x02c6;nlich Infos anzeigen','show_personalinfo',5,'0=Privat - unsichtbar f&#x00b8;r alle|1=Sichtbar f&amp;uuml;r meine Kontakte|2=&amp;ouml;ffentlich - f&amp;uuml;r alle sichtbar','','',0,1,1,'0'),
  (22,320,'G&amp;auml;stebuch anzeigen','show_guestbook',5,'0=Privat - unsichtbar f&amp;uuml;r alle|1=Sichtbar f&amp;uuml;r meine Kontakte|2=&amp;ouml;ffentlich - f&amp;uuml;r alle sichtbar','','',0,1,1,'0'),
  (23,330,'E-Mail bei Kontaktanfrage','sendemail_contactrequest',6,'','','',0,1,0,'0'),
  (24,340,'E-Mail bei neuer Nachricht','sendemail_newmessage',6,'','','',0,1,0,'0'),
  (25,350,'E-Mail bei neuem G&#x2030;stebucheintrag','sendemail_guestbook',6,'','','',0,1,0,'0'),
  (26,400,'Admin','admin',6,'','','',1,1,0,'0'),
  (27,410,'Moderator','moderator',6,'','','',0,1,0,'0'),
  (28,500,'Meine Hobbies','hobby',3,'','','',0,1,0,''),
  (29,510,'Mich interessiert','interests',3,'','','',0,1,0,''),
  (30,520,'Mehr &amp;uuml;ber mich','more',3,'','','',0,1,0,''),
  (31,170,'activity','activity',1,'','','',0,1,0,'50'),
  (35,610,'motto','motto',3,'','','',0,1,0,''),
  (33,360,'Newsletter empfangen','sendemail_newletter',6,'','','',0,1,0,''),
  (34,105,'online_status','online_status',6,'','','',0,0,0,'0');
/*!40000 ALTER TABLE `rex_com_user_field` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_file`;
CREATE TABLE `rex_file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `re_file_id` int(11) NOT NULL DEFAULT '0',
  `category_id` int(11) NOT NULL DEFAULT '0',
  `attributes` text,
  `filetype` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `originalname` varchar(255) DEFAULT NULL,
  `filesize` varchar(255) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `revision` int(11) DEFAULT NULL,
  `med_description` text,
  `med_copyright` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`file_id`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_file` WRITE;
/*!40000 ALTER TABLE `rex_file` DISABLE KEYS */;
INSERT INTO `rex_file` VALUES 
  (1,0,1,'','image/jpeg','bg_bdy.jpg','/tmp/php1jQffT','1544',20,180,'',1212150291,1212176534,'admin','admin',0,'',''),
  (30,0,1,'','image/gif','bg_tab_top.gif','bg_tab_top.gif','225',501,3,'',1212190869,1212190869,'admin','admin',0,'',''),
  (3,0,1,'','image/gif','bg_tab_cntnt.gif','bg_tab_cntnt.gif','1934',501,14,'',1212150309,1212150309,'admin','admin',0,'',''),
  (4,0,1,'','image/gif','bg_tab_navi.gif','bg_tab_navi.gif','18033',300,800,'',1212150324,1212150324,'admin','admin',0,'',''),
  (6,0,1,'','image/gif','bg_usr_navi.gif','bg_usr_navi.gif','9347',200,800,'',1212150340,1212150340,'admin','admin',0,'',''),
  (7,0,1,'','image/gif','but_save.gif','but_save.gif','608',300,20,'',1212150348,1212150348,'admin','admin',0,'',''),
  (8,0,1,'','image/gif','but_save_r_nrml.gif','but_save_r_nrml.gif','227',12,20,'',1212150354,1212150354,'admin','admin',0,'',''),
  (9,0,1,'','text/css','css_community.css','css_community.css','8669',0,0,'',1212150361,1212150361,'admin','admin',0,'',''),
  (10,0,1,'','text/css','css_form.css','css_form.css','2912',0,0,'',1212150370,1212150370,'admin','admin',0,'',''),
  (11,0,1,'','text/css','css_website.css','css_website.css','8563',0,0,'',1212150378,1212150378,'admin','admin',0,'',''),
  (12,0,1,'','image/gif','icon_arrw_rght.gif','icon_arrw_rght.gif','51',6,6,'',1212150385,1212150385,'admin','admin',0,'',''),
  (13,0,1,'','image/gif','icon_lgt.gif','icon_lgt.gif','107',12,11,'',1212150393,1212150393,'admin','admin',0,'',''),
  (14,0,1,'','image/gif','icon_myprfl.gif','icon_myprfl.gif','106',9,11,'',1212150399,1212150399,'admin','admin',0,'',''),
  (15,0,1,'','image/gif','icon_psswd_frgttn.gif','icon_psswd_frgttn.gif','116',12,12,'',1212150407,1212150407,'admin','admin',0,'',''),
  (16,0,1,'','image/gif','icon_rgstr.gif','icon_rgstr.gif','128',10,10,'',1212150415,1212150415,'admin','admin',0,'',''),
  (17,0,1,'','image/gif','icon_usr_list.gif','icon_usr_list.gif','94',7,10,'',1212150422,1212150422,'admin','admin',0,'',''),
  (18,0,1,'','image/jpeg','logo.jpg','logo.jpg','13115',280,220,'',1212150431,1212150431,'admin','admin',0,'',''),
  (19,0,1,'','image/gif','shdw_bttm.gif','shdw_bttm.gif','815',100,75,'',1212150439,1212150439,'admin','admin',0,'',''),
  (20,0,1,'','image/gif','shdw_top.gif','shdw_top.gif','808',100,75,'',1212150446,1212150446,'admin','admin',0,'',''),
  (22,0,1,'','image/gif','nobody_m.gif','nobody_m.gif','3346',150,137,'',1212160782,1212160782,'admin','admin',0,'',''),
  (23,0,1,'','image/gif','nobody_w.gif','nobody_w.gif','4481',150,137,'',1212160790,1212160790,'admin','admin',0,'',''),
  (24,0,2,'','image/jpeg','visual.jpg','visual.jpg','16443',497,170,'',1212161966,1212190055,'admin','admin',0,'',''),
  (25,0,2,'','image/jpeg','visual_2.jpg','visual_2.jpg','9771',240,139,'',1212162190,1212190055,'admin','admin',0,'',''),
  (29,0,1,'','image/gif','bg_tab_bttm.gif','bg_tab_bttm.gif','244',501,3,'',1212190858,1212190858,'admin','admin',0,'',''),
  (31,0,2,'','image/gif','jan.gif','jan.gif','487',50,50,'',1372005816,1372005816,'admin','admin',0,'',''),
  (32,0,2,'','image/gif','nobody.gif','nobody.gif','8628',130,138,'',1372005816,1372005816,'admin','admin',0,'',''),
  (33,0,2,'','image/jpeg','tab.jpg','tab.jpg','56441',300,219,'',1372005816,1372005816,'admin','admin',0,'','');
/*!40000 ALTER TABLE `rex_file` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_file_category`;
CREATE TABLE `rex_file_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `re_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `attributes` text,
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_file_category` WRITE;
/*!40000 ALTER TABLE `rex_file_category` DISABLE KEYS */;
INSERT INTO `rex_file_category` VALUES 
  (1,'CSS / Layout',0,'|',1212150254,1212150254,'admin','admin','',0),
  (2,'Allgemeine Grafiken/Photos',0,'|',1212175559,1212175559,'admin','admin','',0),
  (3,'_Userbilder',0,'|',1212175567,1212175567,'admin','admin','',0);
/*!40000 ALTER TABLE `rex_file_category` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_module`;
CREATE TABLE `rex_module` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL DEFAULT '0',
  `ausgabe` text NOT NULL,
  `eingabe` text NOT NULL,
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `attributes` text,
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`,`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_module` WRITE;
/*!40000 ALTER TABLE `rex_module` DISABLE KEYS */;
INSERT INTO `rex_module` VALUES 
  (1,'01 - Headline',0,'<h1><span>REX_VALUE[1]</span></h1>','Headline:\r\n<br /><input type=\"text\" size=\"40\" name=\"VALUE[1]\" value=\"REX_VALUE[1]\"  style=\"width: 90%;\" />\r\n<br />','admin','admin',1212051980,1212153066,'',0),
  (2,'02 - Text [textile] mit/ohne Bild',0,'<?php\r\n\r\n$param = array();\r\n$text = \'\';\r\n$file = \'\';\r\n//	Ausrichtung des Bildes \r\nif (\"REX_VALUE[9]\" == \"l\") {\r\n	$param[\'class\'] = \' class=\"img fl-lft\"\';\r\n}\r\nif (\"REX_VALUE[9]\" == \"r\") {\r\n	$param[\'class\'] = \' class=\"img fl-rght\"\';\r\n}\r\nif (\"REX_VALUE[9]\" == \"b\") {\r\n	$param[\'class\'] = \' class=\"img img-bttm\"\';\r\n}\r\nif (\"REX_VALUE[9]\" == \"t\") {\r\n	$param[\'class\'] = \' class=\"img img-top\"\';\r\n}\r\n\r\n//	Wenn Bild eingefuegt wurde, Code schreiben \r\n$get_desc = false;\r\nif (\"REX_FILE[1]\" != \"\") {\r\n	\r\n	\r\n	if (\'REX_VALUE[8]\' == \'1\' AND (REX_CTYPE_ID == \'2\' OR REX_CTYPE_ID == \'3\')) {\r\n		if (\"REX_VALUE[9]\" == \"r\" OR \"REX_VALUE[9]\" == \"l\")\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=50w__REX_FILE[1]\" /></p>\';\r\n		else\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=170w__REX_FILE[1]\" /></p>\';\r\n	}\r\n	elseif (\'REX_VALUE[8]\' == \'1\') {\r\n		if (\"REX_VALUE[9]\" == \"r\" OR \"REX_VALUE[9]\" == \"l\")\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=200w__REX_FILE[1]\" /></p>\';\r\n		else\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=462w__REX_FILE[1]\" /></p>\';\r\n	}\r\n	else {\r\n		if (\"REX_VALUE[9]\" == \"r\" OR \"REX_VALUE[9]\" == \"l\")\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=240w__REX_FILE[1]\" /></p>\';\r\n		else\r\n			$file = \'<p\'.$param[\'class\'].\'><img src=\"index.php?rex_resize=500w__REX_FILE[1]\" /></p>\';\r\n	}\r\n}\r\n\r\nif (\"REX_VALUE[1]\" != \"\") {\r\n\r\n//	Fliesstext \r\n$input =<<< EOT\r\nREX_HTML_VALUE[1]\r\nEOT;\r\n\r\n\r\n	$textile = new Textile(); \r\n	$text = $textile->TextileThis($input);\r\n}\r\n\r\n$text = str_replace(\'href=\"http://\', \'onclick=\"window.open(this.href); return false\" class=\"link-extern\" href=\"http://\', $text);\r\n\r\nif (\'REX_VALUE[8]\' == \'1\') {\r\n	print \'<div class=\"bx-v1 bx-shdw\">\r\n			<div class=\"bx-v1-2 bx-shdw-2\">\r\n			<div class=\"bx-v1-cntnt\">\';\r\n			\r\n				\r\n	if (\'REX_VALUE[2]\' != \'\')\r\n		print \'<h3><strong>REX_VALUE[2]</strong> REX_VALUE[3]</h3>\';\r\n}\r\n\r\nif (\"REX_VALUE[9]\" == \"b\") {\r\n	print \'<div class=\"slc\">\'.$text.$file.\'<div class=\"clearer\"> </div></div>\';\r\n}\r\nelse {\r\n	print \'<div class=\"slc\">\'.$file.$text.\'<div class=\"clearer\"> </div></div>\';\r\n}\r\n\r\n\r\nif (\'REX_VALUE[8]\' == \'1\')\r\n	print \'</div></div></div>\';\r\n\r\n?>','<strong>spezielle Headline f&#x00b8;r Darstellung als Box:</strong><br />\r\n<input name=\"VALUE[2]\" style=\"width: 30%\" value=\"REX_VALUE[2]\"> \r\n<input name=\"VALUE[3]\" style=\"width: 30%\" value=\"REX_VALUE[3]\">\r\n<br /><br />\r\n\r\n<strong>Fliesstext:</strong><br />\r\n<textarea name=\"VALUE[1]\" cols=\"80\" rows=\"30\" class=\"inp100\">REX_VALUE[1]</textarea>\r\n<br /><br />\r\nREX_LINK_BUTTON[1]\r\n<strong>Artikelfoto</strong>:<br />\r\nREX_MEDIA_BUTTON[1]\r\n<?\r\nif (\"REX_FILE[1]\" != \"\") {\r\n	echo \"<img src=\".$REX[\'HTDOCS_PATH\'].\"/files/REX_FILE[1]><br />\";\r\n}\r\n\r\n?><br />\r\n<br />\r\n\r\n\r\n<strong>Ausrichtung des Artikelfotos:</strong><br />\r\n<select name=\"VALUE[9]\" style=\"width: 200px;\">\r\n	<option value=\"l\" <? if (\"REX_VALUE[9]\" == \'l\') echo \'selected=\"selected\"\'; ?>>links vom Text</option>\r\n	<option value=\"r\" <? if (\"REX_VALUE[9]\" == \'r\') echo \'selected=\"selected\"\'; ?>>rechts vom Text</option>\r\n	<option value=\"t\" <? if (\"REX_VALUE[9]\" == \'t\') echo \'selected=\"selected\"\'; ?>>oberhalb vom Text</option>\r\n	<option value=\"b\" <? if (\"REX_VALUE[9]\" == \'b\') echo \'selected=\"selected\"\'; ?>>unterhalb vom Text</option>\r\n</select><br />\r\n<br />\r\n\r\n<strong>Darsellung als Box:</strong><br />\r\n<select name=\"VALUE[8]\" style=\"width: 200px;\">\r\n	<option value=\"0\" <? if (\"REX_VALUE[8]\" == \'0\') echo \'selected=\"selected\"\'; ?>>nein</option>\r\n	<option value=\"1\" <? if (\"REX_VALUE[8]\" == \'1\') echo \'selected=\"selected\"\'; ?>>ja</option>\r\n</select><br />\r\n<br />\r\n\r\n<strong>Anleitung / Hinweise</strong>:\r\n<table class=\"warning\" style=\"width:100%\">\r\n<tr>\r\n	<th style=\"width:200px;\"><strong>Beschreibung</strong></th>\r\n	<th><strong>Eingabe</strong></th>\r\n</tr>\r\n<tr>\r\n	<td><h1>&#x2039;berschrift 1</h1></td>\r\n	<td>h1. &#x2039;berschrift (Leerzeile vor und nach der Eingabe)</td>\r\n</tr>\r\n<tr>\r\n	<td><h2>&#x2039;berschrift 2</h2></td>\r\n	<td>h2. &#x2039;berschrift (Leerzeile vor und nach der Eingabe)</td>\r\n</tr>\r\n<tr>\r\n	<td><strong>fetter Text</strong></td>\r\n	<td>*fetter Text*</td>\r\n</tr>\r\n<tr>\r\n	<td><i>kursiver Text</i></td>\r\n	<td>__kursiver Text__</td>\r\n</tr>\r\n<tr>\r\n	<td><del>gestrichener Text</del></td>\r\n	<td>-gestrichener Text-</td>\r\n</tr>\r\n<tr>\r\n	<td>geordnete Liste mit Zahlen</td>\r\n	<td># Listenpunkt</td>\r\n</tr>\r\n<tr>\r\n	<td>ungeordnete Liste mit Zeichen</td>\r\n	<td>* Listenpunkt</td>\r\n</tr>\r\n<tr>\r\n	<td>Link (intern)</td>\r\n	<td>\"zum Impressum\":redaxo://5</td>\r\n</tr>\r\n<tr>\r\n	<td>Link (extern)</td>\r\n	<td>\"zu unserem Partner\":http://yakamara.de</td>\r\n</tr>\r\n<tr>\r\n	<td>Link mit Ankersprung (intern/extern)</td>\r\n	<td>\"zum Kontakt\":http://domain.de#Kontakt<br />\"zum Impressum\":redaxo://5#Kontakt</td>\r\n</tr>\r\n<tr>\r\n	<td>Anker definieren</td>\r\n	<td>p(#Impressum). Hier steht das Impressum</td>\r\n</tr>\r\n</table>','admin','admin',1212052091,1372000573,'',0),
  (12,'1201 - COM-Module - Gästebuch',0,'<?php\r\n$tab = rex_request(\"tab\",\"int\");\r\n$article_id = rex_request(\"article_id\",\"int\");\r\nif (isset($REX[\'COM_USER\']) AND is_object($REX[\'COM_USER\'])) \r\n	echo rex_com_guestbook::getGuestbook($REX[\'COM_USER\']->getValue(\"rex_com_user.id\"),$article_id,array(\"tab\"=>$tab));\r\n?>','','','admin',0,1371852927,'',0),
  (3,'08 - Trenner',0,'<div class=\"splt\"></div>','','admin','',1212052125,0,'',0),
  (4,'07 - Download',0,'<?php\r\n\r\n	if (!function_exists(\'Dateigroesse\')) {\r\n		function Dateigroesse($URL) {\r\n			$Groesse = @filesize($URL);\r\n			if($Groesse<1000) {\r\n				return number_format($Groesse, 0, \",\", \".\").\" Bytes\";\r\n			}\r\n			elseif($Groesse<1000000) {\r\n				return number_format($Groesse/1024, 0, \",\", \".\").\" kB\";\r\n			}\r\n			else {\r\n				return number_format($Groesse/1048576, 0, \",\", \".\").\" MB\";\r\n			}\r\n		}\r\n	}\r\n	\r\n	if (!function_exists(\'parse_icon\')) {\r\n		function parse_icon($ext) {\r\necho \"<!-- $ext -->\";\r\n			switch (strtolower($ext)) {\r\n	\r\n				case \'doc\': return \'mime-doc.gif\';\r\n				case \'rtf\': return \'mime-doc.gif\';\r\n				case \'txt\': return \'mime-txt.gif\';\r\n				case \'xls\': return \'mime-xls.gif\';\r\n				case \'eps\': return \'mime-eps.gif\';\r\n				case \'csv\': return \'mime-xls.gif\';\r\n				case \'ppt\': return \'mime-ppt.gif\';\r\n				case \'html\': return \'mime-html.gif\';\r\n				case \'htm\': return \'mime-html.gif\';\r\n				case \'php\': return \'mime-script.gif\';\r\n				case \'php3\': return \'mime-script.gif\';\r\n				case \'cgi\': return \'mime-script.gif\';\r\n				case \'pdf\': return \'mime-pdf.gif\';\r\n				case \'rar\': return \'mime-rar.gif\';\r\n				case \'zip\': return \'mime-zip.gif\';\r\n				case \'gz\': return \'mime-gz.gif\';\r\n				case \'jpg\': return \'mime-jpg.gif\';\r\n				case \'gif\': return \'mime-gif.gif\';\r\n				case \'png\': return \'mime-png.gif\';\r\n				case \'bmp\': return \'mime-image.gif\';\r\n				case \'tif\': return \'mime-image.gif\';\r\n				case \'exe\': return \'mime-binary.gif\';\r\n				case \'bin\': return \'mime-binary.gif\';\r\n				case \'avi\': return \'mime-mov.gif\';\r\n				case \'mpg\': return \'mime-mov.gif\';\r\n				case \'moc\': return \'mime-mov.gif\';\r\n				case \'asf\': return \'mime-mov.gif\';\r\n				case \'mp3\': return \'mime-sound.gif\';\r\n				case \'wav\': return \'mime-sound.gif\';\r\n				case \'org\': return \'mime-sound.gif\';\r\n			\r\n				default:\r\n					return \'icon_def.gif\';\r\n			}\r\n		}\r\n	}\r\n	$out	= \"\";\r\n	\r\n	$extFile1	= \"\";\r\n	$nameFile1	= \"\";\r\n	$sizeFile1	= \"\";\r\n	\r\n	if (\"REX_FILE[1]\" != \"\") {\r\n		$extFile1 	= substr(strrchr(\'REX_FILE[1]\', \'.\'), 1);\r\n		$iconFile1 	= $REX[\'HTDOCS_PATH\'].\'/redaxo/media/\'.parse_icon($extFile1);\r\n		$ooFile1 	= OOMedia::getMediaByName (\'REX_FILE[1]\');\r\n		$nameFile1 	= $ooFile1->getTitle();\r\n		$sizeFile1 	= Dateigroesse($REX[\'HTDOCS_PATH\'].\"files/REX_FILE[1]\");\r\n	\r\n		$out .= \'\r\n			<p class=\"link-download\">\r\n				<a href=\"\'.$REX[\'HTDOCS_PATH\'].\'files/REX_FILE[1]\" target=\"_blank\"><img src=\"\'.$iconFile1.\'\" alt=\"Datei zum herunterladen\" title=\"\'.$nameFile1.\' (\'.$sizeFile1.\')\" /></a>\r\n				<span class=\"name\">\'.$nameFile1.\'</span>\r\n				<span class=\"size\">(\'.$sizeFile1.\')</span>\r\n			</p>\';\r\n	}\r\n	\r\n	\r\n	print \'\r\n	<div class=\"com-tab com-tab-no-navi download\"><div class=\"com-tab-cntnt\"><div class=\"com-tab-cntnt-2\"><div class=\"com-tab-cntnt-3\">\'.$out.\'</div></div></div></div>\';\r\n \r\n?>','<br /><br />\r\nREX_MEDIA_BUTTON[1]\r\n<br /><br />\r\n\r\n','admin','',1212052159,0,'',0),
  (5,'rex - X-Form',0,'<?php\r\n\r\n// module:xform_basic_out\r\n// v0.2\r\n//--------------------------------------------------------------------------------\r\n\r\n$xform = new rex_xform;\r\nif (\"REX_VALUE[7]\" == 1) { $xform->setDebug(TRUE); }\r\n$form_data = \'REX_VALUE[3]\';\r\n$form_data = trim(str_replace(\"<br />\",\"\",rex_xform::unhtmlentities($form_data)));\r\n$xform->setFormData($form_data);\r\n$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID); \r\n\r\n?>REX_PHP_VALUE[9]<?php\r\n\r\n// action - showtext\r\nif(\"REX_IS_VALUE[6]\" == \"true\")\r\n{\r\n  $html = \"0\"; // plaintext\r\n  if(\'REX_VALUE[11]\' == 1) $html = \"1\"; // html\r\n  if(\'REX_VALUE[11]\' == 2) $html = \"2\"; // textile\r\n  \r\n  $e3 = \'\'; $e4 = \'\';\r\n  if ($html == \"0\") {\r\n    $e3 = \'<div class=\"rex-message\"><div class=\"rex-info\"><p>\';\r\n    $e4 = \'</p></div></div>\';\r\n  }\r\n  \r\n  $t = str_replace(\"<br />\",\"\",rex_xform::unhtmlentities(\'REX_VALUE[6]\'));\r\n  $xform->setActionField(\"showtext\",array(\r\n      $t,\r\n      $e3,\r\n      $e4,\r\n      $html // als HTML interpretieren\r\n    )\r\n  );\r\n}\r\n\r\n$form_type = \"REX_VALUE[1]\";\r\n\r\n// action - email\r\nif ($form_type == \"1\" || $form_type == \"2\" || $form_type == \"3\")\r\n{\r\n  $mail_from = $REX[\'ERROR_EMAIL\'];\r\n  if(\"REX_VALUE[2]\" != \"\") $mail_from = \"REX_VALUE[2]\";\r\n  $mail_to = $REX[\'ERROR_EMAIL\'];\r\n  if(\"REX_VALUE[12]\" != \"\") $mail_to = \"REX_VALUE[12]\";\r\n  $mail_subject = \"REX_VALUE[4]\";\r\n  $mail_body = str_replace(\"<br />\",\"\",rex_xform::unhtmlentities(\'REX_VALUE[5]\'));\r\n  $xform->setActionField(\"email\", array(\r\n      $mail_from,\r\n      $mail_to,\r\n      $mail_subject,\r\n      $mail_body\r\n    )\r\n  );\r\n}\r\n\r\n// action - db\r\nif ($form_type == \"0\" || $form_type == \"2\" || $form_type == \"3\")\r\n{\r\n  $xform->setObjectparams(\'main_table\', \'REX_VALUE[8]\');\r\n  \r\n  //getdata\r\n  if (\"REX_VALUE[10]\" != \"\")\r\n    $xform->setObjectparams(\"getdata\",TRUE);\r\n  \r\n  $xform->setActionField(\"db\", array(\r\n      \"REX_VALUE[8]\", // table\r\n      $xform->objparams[\"main_where\"], // where\r\n      )\r\n    );\r\n}\r\n\r\necho $xform->getForm();\r\n\r\n?>\r\n','<?php\r\n\r\n// module:xform_basic_in\r\n// v0.2.1\r\n// --------------------------------------------------------------------------------\r\n\r\n// DEBUG SELECT\r\n////////////////////////////////////////////////////////////////////////////////\r\n$dbg_sel = new rex_select();\r\n$dbg_sel->setName(\'VALUE[7]\');\r\n$dbg_sel->setSize(1);\r\n$dbg_sel->addOption(\'inaktiv\',\'0\');\r\n$dbg_sel->addOption(\'aktiv\',\'1\');\r\n$dbg_sel->setSelected(\'REX_VALUE[7]\');\r\n$dbg_sel = $dbg_sel->get();\r\n\r\n\r\n// TABLE SELECT\r\n////////////////////////////////////////////////////////////////////////////////\r\n$gc = rex_sql::factory();\r\n$gc->setQuery(\'SHOW TABLES\');\r\n$tables = $gc->getArray();\r\n$tbl_sel = new rex_select;\r\n$tbl_sel->setName(\'VALUE[8]\');\r\n$tbl_sel->setSize(1);\r\n$tbl_sel->addOption(\'Keine Tabelle ausgewählt\', \'\');\r\nforeach ($tables as $key => $value)\r\n{\r\n  $tbl_sel->addOption(current($value), current($value));\r\n}\r\n$tbl_sel->setSelected(\'REX_VALUE[8]\');\r\n$tbl_sel = $tbl_sel->get();\r\n\r\n\r\n// PLACEHOLDERS\r\n////////////////////////////////////////////////////////////////////////////////\r\n$xform = new rex_xform;\r\n$form_data = \'REX_VALUE[3]\';\r\n$form_data = trim(str_replace(\'<br />\',\'\',rex_xform::unhtmlentities($form_data)));\r\n$xform->setFormData($form_data);\r\n$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID);\r\n$placeholders = \'\';\r\nif(\'REX_VALUE[3]\'!=\'\')\r\n{\r\n$ignores = array(\'html\',\'validate\',\'action\');\r\n  $placeholders .= \'  <strong class=\"hint\">Platzhalter: <span>[<a href=\"#\" id=\"xform-placeholders-help-toggler\">?</a>]</span></strong>\r\n  <p id=\"xform-placeholders\">\'.PHP_EOL;\r\nforeach($xform->objparams[\'form_elements\'] as $e)\r\n{\r\n  if(!in_array($e[0],$ignores) && isset($e[1]))\r\n  {\r\n      $placeholders .= \'<span>###\'.$e[1].\'###</span> \'.PHP_EOL;\r\n  }\r\n}\r\n  $placeholders .= \'  </p>\'.PHP_EOL;\r\n}\r\n\r\n\r\n// OTHERS\r\n////////////////////////////////////////////////////////////////////////////////\r\n$row_pad = 1;\r\n\r\n$sel = \'REX_VALUE[1]\';\r\n$db_display   = ($sel==\'\' || $sel==1) ?\'style=\"display:none\"\':\'\';\r\n$mail_display = ($sel==\'\' || $sel==0) ?\'style=\"display:none\"\':\'\';\r\n\r\n?>\r\n\r\n<style type=\"text/css\" media=\"screen\">\r\n  /*BAISC MODUL STYLE*/\r\n  #xform-modul                       {margin:0;padding:0;line-height:25px;}\r\n  #xform-modul fieldset              {background:#E4E1D1;margin:-20px 0 0 0;padding: 4px 10px 10px 10px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}\r\n  #xform-modul fieldset legend       {display:block !important;position:relative !important;height:auto !important;top:0 !important;left:0 !important;width:100% !important;margin:0 0 0 0 !important;padding:30px 0 0 0px !important;background:transparent !important;border-bottom:1px solid #B1B1B1 !important;color:gray;font-size:14px;font-weight:bold;}\r\n  #xform-modul fieldset legend em    {font-size:10px;font-weight:normal;font-style:normal;}\r\n  #xform-modul fieldset strong.label,\r\n  #xform-modul fieldset label        {display:inline-block !important;width:150px !important;font-weight:bold;}\r\n  #xform-modul fieldset label span   {font-weight:normal;}\r\n  #xform-modul input,\r\n  #xform-modul select                {width:460px;border:auto;margin:0 !important;padding:0 !important;}\r\n  #xform-modul input[type=\"checkbox\"]{width:auto;}\r\n  #xform-modul hr                    {border:0;height:0;margin:4px 0 4px 0;padding:0;border-top:1px solid #B1B1B1 !important;clear:left;}\r\n  #xform-modul a.blank               {background:url(\"../files/addons/be_style/plugins/agk_skin/popup.gif\") no-repeat 100% 0;padding-right:17px;}\r\n  #xform-modul #modulinfo            {font-size:10px;text-align:right;}\r\n  /*XFORM MODUL*/\r\n  #xform-modul textarea              {min-height:50px;font-family:monospace;font-size:12px;}\r\n  #xform-modul pre                   {clear:left;}\r\n  #xform-modul strong span           {font-weight:normal;}\r\n  #xform-modul .help                 {display:none;color:#2C8EC0;line-height:12px;}\r\n  #xform-modul .area-wrapper         {background:white;border:1px solid #737373;margin-bottom:10px;width:100%;}\r\n  #xform-modul .fullwidth            {width:100% !important;}\r\n  #xform-modul #thx-markup           {width:auto !important;}\r\n  #xform-modul #thx-markup input     {width:auto !important;}\r\n  #xform-modul #xform-placeholders-help,\r\n  #xform-modul #xform-where-help     {display:none;}\r\n  #xform-modul #xform-placeholders,\r\n  #xform-modul #xform-classes-showhelp {background:white;border:1px solid #737373;margin-bottom:10px;width:100%;}\r\n  #xform-modul #xform-placeholders {padding:4px 10px;float:none;width:auto;}\r\n  #xform-modul #xform-placeholders span:hover {color:red;cursor:pointer;}\r\n  #xform-modul em.hint               {color:silver;margin:0;padding:0 0 0 10px;}\r\n  /*SHOWHELP OVERRIDES*/\r\n  #xform-modul ul.xform.root         {border:0;outline:0;margin:4px 0;padding:0;width:100%;background:transparent;}\r\n  #xform-modul ul.xform              {font-size:1.1em;line-height:1.4em;}\r\n</style>\r\n\r\n\r\n<div id=\"xform-modul\">\r\n<fieldset>\r\n  <legend>Formular</legend>\r\n\r\n  <label>DebugModus:</label>\r\n  <?php echo $dbg_sel;?>\r\n\r\n  <hr />\r\n\r\n  <label class=\"fullwidth\">Felddefinitionen:</label>\r\n  <textarea name=\"VALUE[3]\" id=\"xform-form-definition\" class=\"fullwidth\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[3]\'))+$row_pad);?>\">REX_VALUE[3]</textarea>\r\n\r\n  <strong class=\"label\">Verfügbare Feld-Klassen:</strong>\r\n  <div id=\"xform-classes-showhelp\">\r\n    <?php echo rex_xform::showHelp(true,true); ?>\r\n  </div><!-- #xform-classes-showhelp -->\r\n\r\n  <div id=\"thx-markup\"><strong>Meldung bei erfolgreichen Versand:</strong> (\r\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"0\" <?php if(\"REX_VALUE[11]\" == \"0\") echo \'checked=\"checked\"\'; ?>> Plaintext\r\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"1\" <?php if(\"REX_VALUE[11]\" == \"1\") echo \'checked=\"checked\"\'; ?>> HTML\r\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"2\" <?php if(\"REX_VALUE[11]\" == \"2\") echo \'checked=\"checked\"\'; ?>> Textile)\r\n  </div><!-- #thx-markup -->\r\n  <textarea name=\"VALUE[6]\" id=\"xform-thx-message\" class=\"fullwidth\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[6]\'))+$row_pad);?>\">REX_VALUE[6]</textarea>\r\n\r\n</fieldset>\r\n\r\n\r\n<fieldset>\r\n  <legend>Vordefinierte Aktionen</legend>\r\n\r\n  <label>Bei Submit:</label>\r\n  <select name=\"VALUE[1]\" id=\"xform-action-select\" style=\"width:auto;\">\r\n    <option value=\"\"  <?php if(\"REX_VALUE[1]\" == \"\")  echo \" selected \"; ?>>Nichts machen (actions im Formular definieren)</option>\r\n    <option value=\"0\" <?php if(\"REX_VALUE[1]\" == \"0\") echo \" selected \"; ?>>Nur in Datenbank speichern oder aktualisieren wenn \"main_where\" gesetzt ist</option>\r\n    <option value=\"1\" <?php if(\"REX_VALUE[1]\" == \"1\") echo \" selected \"; ?>>Nur E-Mail versenden</option>\r\n    <option value=\"2\" <?php if(\"REX_VALUE[1]\" == \"2\") echo \" selected \"; ?>>E-Mail versenden und in Datenbank speichern</option>\r\n    <!--  <option value=\"3\" <?php if(\"REX_VALUE[1]\" == \"3\") echo \" selected \"; ?>>E-Mail versenden und Datenbank abfragen</option> -->\r\n  </select>\r\n\r\n</fieldset>\r\n\r\n\r\n<fieldset id=\"xform-mail-fieldset\" <?php echo $mail_display;?> >\r\n  <legend>Emailversand:</legend>\r\n\r\n  <label>Absender:</label>\r\n  <input type=\"text\" name=\"VALUE[2]\" value=\"REX_VALUE[2]\" />\r\n\r\n  <label>Empfänger:</label>\r\n  <input type=\"text\" name=\"VALUE[12]\" value=\"REX_VALUE[12]\" />\r\n\r\n  <label>Subject:</label>\r\n  <input type=\"text\" name=\"VALUE[4]\" value=\"REX_VALUE[4]\" />\r\n  <label class=\"fullwidth\">Mailbody:</label>\r\n  <textarea id=\"xform-mail-body\" class=\"fullwidth\" name=\"VALUE[5]\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[5]\'))+$row_pad);?>\">REX_VALUE[5]</textarea>\r\n\r\n    <?php echo $placeholders;?>\r\n\r\n  <ul class=\"help\" id=\"xform-placeholders-help\">\r\n    <li>Die Platzhalter ergeben sich aus den obenstehenden Felddefinitionen.</li>\r\n    <li>Per click können einzelne Platzhalter in den Mail-Body kopiert werden.</li>\r\n    <li>Aktualisierung der Platzhalter erfolgt über die Aktualisierung des Moduls.</li>\r\n  </ul>\r\n\r\n\r\n</fieldset>\r\n\r\n\r\n<fieldset id=\"xform-db-fieldset\" <?php echo $db_display;?> >\r\n  <legend>Datenbank Einstellungen</legend>\r\n\r\n  <label>Tabelle wählen <span>[<a href=\"#\" id=\"xform-db-help-toggler\">?</a>]</span></label>\r\n  <?php echo $tbl_sel;?>\r\n  <ul class=\"help\" id=\"xform-db-select-help\">\r\n    <li>Diese Tabelle gilt auch bei Uniqueabfragen (Pflichtfeld=2) siehe oben</li>\r\n  </ul>\r\n\r\n  <hr />\r\n\r\n  <label for=\"getdatapre\">Daten initial aus DB holen</label>\r\n  <input id=\"getdatapre\" type=\"checkbox\" value=\"1\" name=\"VALUE[10]\" <?php if(\"REX_VALUE[10]\" != \"\") echo \'checked=\"checked\"\'; ?> />\r\n\r\n  <div id=\"db_data\">\r\n    <hr />\r\n    <label>Where Klausel: <span>[<a href=\"#\" id=\"xform-xform-where-help-toggler\">?</a>]</span></label>\r\n    <textarea name=\"VALUE[9]\" cols=\"30\" id=\"xform-db-where\" class=\"fullwidth\"rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[9]\'))+$row_pad);?>\">REX_VALUE[9]</textarea>\r\n    <ul class=\"help\" id=\"xform-where-help\">\r\n      <li>PHP erlaubt. Beispiel: <em>$xform-&gt;setObjectparams(\"main_where\",$where);</em></li>\r\n      <li>Die Benutzereingaben aus dem Formular können mittels Platzhaltern (Schema: ###<em>FELDNAME</em>###) in der WHERE Klausel verwendet werden - Beispiel: text|myname|Name|1 -> Platzhalter: ###myname###</li>\r\n    </ul>\r\n  </div><!-- #db_data -->\r\n\r\n  </fieldset>\r\n\r\n  <p id=\"modulinfo\">XForm Formbuilder v0.2.1</p>\r\n\r\n</div><!-- #xform-modul -->\r\n\r\n<script type=\"text/javascript\">\r\n<!--\r\n(function($){\r\n\r\n  // FIX WEBKIT CSS QUIRKS\r\n  if ($.browser.webkit) {\r\n    $(\'#xform-modul textarea\').css(\'min-height\',\'70px\');\r\n    $(\'#xform-modul textarea\').css(\'width\',\'701px\');\r\n    $(\'#xform-modul fieldset\').css(\'width\',\'705px\');\r\n  }\r\n\r\n  // AUTOGROW BY ROWS\r\n  $(\'#xform-modul textarea\').keyup(function(){\r\n    var rows = $(this).val().split(/\\r?\\n|\\r/).length + <?php echo $row_pad;?>;\r\n    $(this).attr(\'rows\',rows);\r\n  });\r\n\r\n  // TOGGLERS\r\n  $(\'#xform-placeholders-help-toggler\').click(function(){\r\n    $(\'#xform-placeholders-help\').toggle(50);return false;\r\n  });\r\n  $(\'#xform-xform-where-help-toggler\').click(function(){\r\n    $(\'#xform-where-help\').toggle(50);return false;\r\n  });\r\n  $(\'#xform-db-help-toggler\').click(function(){\r\n    $(\'#xform-db-select-help\').toggle(50);return false;\r\n  });\r\n\r\n\r\n  // INSERT PLACEHOLDERS\r\n  $(\'#xform-placeholders span\').click(function(){\r\n    newval = $(\'#xform-mail-body\').val()+\' \'+$(this).html();\r\n    $(\'#xform-mail-body\').val(newval);\r\n  });\r\n\r\n  // TOGGLE MAIL/DB PANELS\r\n  $(\'#xform-action-select\').change(function(){\r\n    switch($(this).val()){\r\n      case \'\':\r\n        $(\'#xform-db-fieldset\').hide(0);\r\n        $(\'#xform-mail-fieldset\').hide(0);\r\n        break;\r\n      case \'1\':\r\n        $(\'#xform-db-fieldset\').hide(0);\r\n        $(\'#xform-mail-fieldset\').show(0);\r\n        break;\r\n      case \'0\':\r\n        $(\'#xform-db-fieldset\').show(0);\r\n        $(\'#xform-mail-fieldset\').hide(0);\r\n        break;\r\n      case \'2\':\r\n      case \'3\':\r\n        $(\'#xform-db-fieldset\').show(0);\r\n        $(\'#xform-mail-fieldset\').show(0);\r\n        break;\r\n    }\r\n  });\r\n\r\n})(jQuery)\r\n//-->\r\n</script>','admin','admin',1212070590,1370875011,'',0),
  (7,'1001 - COM-Module - Tabbox',0,'<?php\r\n$tab_arr = array(\r\n	\'REX_LINK_ID[1]\', \r\n	\'REX_LINK_ID[2]\', \r\n	\'REX_LINK_ID[3]\', \r\n	\'REX_LINK_ID[4]\', \r\n	\'REX_LINK_ID[5]\', \r\n	\'REX_LINK_ID[6]\', \r\n	);\r\n\r\n\r\n\r\n$tab_arr_in = array();\r\nforeach($tab_arr as $v)\r\n{\r\n	if ($a = OOArticle::getArticleById($v))\r\n	{\r\n		$tab_arr_in[$a->getName()] = $v;\r\n	}\r\n}	\r\n\r\n$tab_arr = array();\r\nforeach($tab_arr_in as $k => $v)\r\n{\r\n	if ($k != \"\" AND $v != \"\")\r\n	{\r\n		$tab_arr[$k] = $v;\r\n	}\r\n}\r\n\r\n$tab_g = rex_request(\'tab\',\'int\',\'\');	\r\nif ($tab_g < 0 || $tab_g >= count($tab_arr)) $tab_g = 0;\r\n			\r\n$tab_cnt = \'\';\r\n$tab_list = \'\';\r\n$tab_c = 0; // Counter\r\n// $tab_g -> active tab\r\nforeach ($tab_arr as $key => $val)\r\n{\r\n	$link = rex_getUrl(\'\', \'\', array(\'tab\' => $tab_c));\r\n	$tab_class = \'\';\r\n	if ($tab_g == $tab_c) {\r\n		$tab_cnt = $val;\r\n		$tab_class = \'active \';\r\n	}\r\n	\r\n	if ($tab_c == 0)\r\n		$tab_class = \'tab-frst \';\r\n		\r\n	if ($tab_c == 0 AND $tab_g == $tab_c)\r\n		$tab_class = \'tab-frst-active \';\r\n		\r\n	if (($tab_c+1) == count($tab_arr))\r\n		$tab_class = \'tab-lst \';\r\n		\r\n	if (($tab_c+1) == count($tab_arr) AND $tab_g == $tab_c)\r\n		$tab_class = \'tab-lst-active \';\r\n		\r\n	if (count($tab_arr) == 1)\r\n		$tab_class = \'tab-aln\';\r\n	\r\n	$tab_c_active_nxt = $tab_g - 1;\r\n	if ($tab_c == $tab_c_active_nxt)\r\n		$tab_class .= \'active-nxt \';\r\n	\r\n	trim($tab_class);\r\n	if ($tab_class != \'\') {\r\n		$tab_class = \' class=\"\'.$tab_class.\'\"\';\r\n	}\r\n		\r\n	$tab_list .= \'<li\'.$tab_class.\'><a href=\"\'.rex_getUrl(\'\', \'\', array(\'tab\' => $tab_c)).\'\"><span>\'.$key.\'</span></a></li>\';\r\n	$tab_c++;\r\n}\r\n			\r\nprint \'\r\n	<div class=\"com-tab\">\r\n		<div class=\"com-tab-navi\">\r\n			<ul>\r\n				\'.$tab_list.\'\r\n			</ul>\r\n		</div>\r\n		\r\n		<div class=\"com-tab-cntnt\">\r\n		<div class=\"com-tab-cntnt-2\">\r\n		<div class=\"com-tab-cntnt-3\">\';\r\n\r\nif (!isset($REX[\'TMP\'][\'TAB_CID\']) || \"REX_ARTICLE_ID\" != $REX[\'TMP\'][\'TAB_CID\'])\r\n{\r\n  $REX[\'TMP\'][\'TAB_CID\'] = (int) $tab_cnt;\r\n  $ma = new rex_article;\r\n  $ma->setClang(REX_CLANG_ID);\r\n  if ($ma->setArticleId($tab_cnt) == TRUE) \r\n  	\r\n  	echo $ma->getArticle();\r\n	\r\n\r\n}else\r\n{\r\n  echo \"ERROR: ArticleinArticle\";\r\n}\r\nprint \'\r\n			<div class=\"clearer\"> </div>\r\n		</div>\r\n		</div>\r\n		</div>\r\n	</div>\';\r\n?>','Tab 1 Artikel:\r\n<br />REX_LINK_BUTTON[1]\r\n<br /><br />Tab 2 Artikel:\r\n<br />REX_LINK_BUTTON[2]\r\n<br /><br />Tab 3 Artikel:\r\n<br />REX_LINK_BUTTON[3]\r\n<br /><br />Tab 4 Artikel:\r\n<br />REX_LINK_BUTTON[4]\r\n<br /><br />Tab 5 Artikel:\r\n<br />REX_LINK_BUTTON[5]\r\n<br /><br />Tab 6 Artikel:\r\n<br />REX_LINK_BUTTON[6]\r\n<br /><br />','','admin',0,1371849590,'',0),
  (8,'1002 - COM-Module - Usersuche',0,'<?php\r\n// *********************** USERSUCHE\r\n$searchtext = rex_request(\"searchtext\",\"string\",\"\");\r\n$send = rex_request(\"send\",\"string\",\"\");\r\n$orderArr = array(\'firstname\' => \'Vorname\', \'name\' => \'Name\', \'email\' => \'E-Mail\');\r\n$orderArr = array(\'login\' => \'Login\');\r\n\r\n\r\n$ordersql = \'login\';\r\n$ordr = rex_request(\"ordr\",\"string\");\r\nif (isset($_REQUEST[\'ordr\']) AND (isset($orderArr[$ordr]))) {	\r\n	$ordersql = \'\'.$_REQUEST[\'ordr\'];\r\n}\r\n$ordersql = \' ORDER BY \'.$ordersql;\r\n\r\n// **** SQL AUFBAUEN\r\n$felder = array(\"login\",\"firstname\",\"name\",\"city\");\r\n$felder = array(\"login\");\r\n\r\n$addsql = \"\";\r\n$urlArr = array();\r\nif ($searchtext != \"\")\r\n{\r\n	foreach($felder as $feld)\r\n	{\r\n		if ($addsql != \"\") $addsql .= \' or \';\r\n		$addsql .= $feld.\' LIKE \"%\'.$searchtext.\'%\"\';\r\n	}\r\n	$addsql = \' and (\'.$addsql.\')\';\r\n	\r\n	$urlArr[\'searchtext\'] = htmlspecialchars(stripslashes($searchtext));\r\n}\r\n\r\n$filter = $_REQUEST[\"filter\"];\r\nif ($filter != \"\")\r\n{\r\n	$addsql = \'and login LIKE \"\'.$filter.\'%\"\';\r\n}\r\n\r\n$sql = \"select * from rex_com_user where status > 0 \".$addsql.$ordersql;\r\n\r\n$ms = new rex_sql;\r\n//$ms->debugsql = true;\r\n$ms->setQuery($sql);\r\n$sortLinks = \'\';\r\nforeach ($orderArr AS $key => $val) {\r\n	\r\n	$urlArr[\'ordr\'] = $key;\r\n	$sortLinks .= \'<a href=\"\'.rex_getUrl(\'\', \'\', $urlArr).\'\">\'.$val.\'</a> \';\r\n}\r\n\r\necho \'\r\n	<div class=\"com-usersearch\">\r\n		<form action=\"\'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array(\"send\"=>1),\"&amp;\").\'\" method=\"post\" name=\"searchform\" id=\"searchform\">\r\n			\r\n			<p class=\"ftxt\">\r\n				<label for=\"usersearch\">Mitgliedsuche:</label>\r\n				<input type=\"text\" name=\"searchtext\" value=\"\'.htmlspecialchars(stripslashes($searchtext)).\'\" id=\"usersearch\" />\r\n			</p>\r\n			\r\n			<p class=\"link-save\">\r\n				<a href=\"javascript:void(0);\" onclick=\"document.getElementById(\\\'searchform\\\').submit();\"><span>Suche starten</span></a>\r\n			</p>\r\n			\r\n		</form>\';\r\n		\r\n\r\n// if ($ms->getRows()>0)\r\n//{\r\n	echo \'\r\n	<div class=\"com-tab com-tab-no-navi\">\r\n	<div class=\"com-tab-cntnt\">\r\n	<div class=\"com-tab-cntnt-2\">\r\n	<div class=\"com-tab-cntnt-3\">\r\n				\';\r\n				\r\n\r\n	// ***** Alle | A-Z | Blaettern\r\n	\r\n	$gn = \'select UPPER(SUBSTR(login,1,1)) as ch from rex_com_user where status > 0 group by ch\';\r\n	$ga = new rex_sql;\r\n	// $ga->debugsql = 1;\r\n	$ga->setQuery($gn);\r\n	$ga_array = $ga->getArray();\r\n	echo \'\r\n	<div class=\"com-navi\">\r\n			<ul class=\"navi com-navi-letters\">\r\n				<li><a href=\"\'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID).\'\">Alle | </a></li>\r\n				\';\r\n				foreach ($ga_array as $k => $v)\r\n				{\r\n					# echo \"<br />** $k ** \".$v[\"ch\"];\r\n					echo \'		<li><a href=\"\'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array(\"filter\"=>$v[\"ch\"])).\'\">\'.$v[\"ch\"].\'</a></li>\';\r\n				}\r\n				/*\r\n				for($i=65;$i<91;$i++)\r\n				{\r\n					echo \'		<li><a href=\"\'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array(\"filter\"=>chr($i))).\'\">\'.chr($i).\'</a></li>\';\r\n				}\r\n				*/\r\n	echo \'\r\n			</ul>\r\n			\'.\r\n			#rex_com_blaettern($ms).\r\n			\'\r\n			<div class=\"clearer\"> </div>\r\n	</div>\r\n	\';\r\n				\r\n				\r\n	// ***** Sortieren\r\n	/*\r\n	echo \'\r\n				<div class=\"com-navi\">\r\n					<p class=\"flLeft\">Sortieren nach: \'.$sortLinks.\'</p>\r\n					\'.rex_com_blaettern($ms).\'\r\n					<div class=\"clearer\"> </div>\r\n				</div>\';\r\n	*/\r\n				\r\n				\r\n	\r\n	for($i=0;$i<$ms->getRows();$i++) \r\n	{			\r\n	\r\n		echo \'	<div class=\"com-contact\">\r\n					<div class=\"com-image\">\r\n						<p class=\"image\">\'.rex_com_showUser($ms, \"image\", \"\", TRUE, FALSE).\'</p>\r\n					</div>\r\n					\r\n					<div class=\"com-content\">\r\n					<div class=\"com-content-2\">\r\n						<p><span class=\"color-1\">\';\r\n		\r\n		echo rex_com_showUser($ms, \"login\", \"\", TRUE);\r\n		if ($ms->getValue(\"show_basisinfo\")==2)\r\n		{\r\n			echo \' [ \';\r\n			echo rex_com_showUser($ms, \"name\", \"\", TRUE);\r\n			echo \' ]\';\r\n		}\r\n		\r\n		echo \'</span></p>\';\r\n		if (rex_com_showUser($ms,\"motto\",\"\", FALSE)) echo \'<p>Motto: \'.rex_com_showUser($ms,\"motto\",\"\", FALSE).\'</p>\';\r\n		echo \'\r\n					</div>\r\n					</div>\r\n					<div class=\"clearer\"> </div>\r\n				</div>\';\r\n		\r\n		\r\n		$ms->next();\r\n				\r\n	}\r\n	echo \'\r\n				\r\n				<div class=\"clearer\"> </div>\r\n			</div>\r\n			</div>\r\n	\r\n		</div>\r\n		</div>\';\r\n// }\r\necho \'</div>\';\r\n?>','','','admin',0,1372006214,'',0),
  (9,'1003 - COM-Module - Userdetails',0,'<?php\r\n$user_id = (int) $_REQUEST[\"user_id\"];\r\necho rex_com_showUserProfil($user_id,REX_ARTICLE_ID);\r\n?>','','','',0,0,'',0),
  (10,'1101 - COM-Module - Kontaktbox',0,'<?php\r\n// ***** KONTAKTE\r\n$status = (int) \"REX_VALUE[1]\"; // 0=Bestaetigte/1=Unbestaetigte/2=Noch zu bestaetigen\r\n$aid = rex_request(\"article_id\",\"int\");\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"]))\r\n{\r\n	$user_id = $REX[\"COM_USER\"]->getValue(\"rex_com_user.id\");\r\n	include $REX[\"INCLUDE_PATH\"].\"/addons/xform/classes/basic/class.rexform.inc.php\";\r\n	include $REX[\"INCLUDE_PATH\"].\"/addons/xform/classes/basic/class.rexlist.inc.php\";\r\n	include $REX[\"INCLUDE_PATH\"].\"/addons/xform/classes/basic/class.rexselect.inc.php\";\r\n	\r\n	$filter = $_REQUEST[\"filter\"];\r\n	$add_sql = \"\";\r\n	if ($filter != \"\")\r\n	{\r\n		$add_sql = \' AND rex_com_user.lastname LIKE \"\'.$filter.\'%\" \';\r\n	}\r\n	\r\n	\r\n	if ($status==0) $sql = \'\r\n		select \r\n			* \r\n		from \r\n			rex_com_contact,rex_com_user \r\n		where \r\n			rex_com_contact.to_user_id=rex_com_user.id \r\n			and rex_com_contact.user_id=\"\'.$user_id.\'\" \r\n			and accepted=1 \r\n			\'.$add_sql;\r\n	if ($status==1) $sql = \'\r\n		select \r\n			* \r\n		from \r\n			rex_com_contact,rex_com_user \r\n		where \r\n			rex_com_contact.to_user_id=rex_com_user.id and \r\n			rex_com_contact.user_id=\"\'.$user_id.\'\" and \r\n			rex_com_contact.accepted=0 and \r\n			rex_com_contact.requested=1 \r\n			\'.$add_sql;\r\n	if ($status==2) $sql = \'\r\n		select \r\n			* \r\n		from \r\n			rex_com_contact,rex_com_user \r\n		where \r\n			rex_com_contact.to_user_id=rex_com_user.id and \r\n			rex_com_contact.user_id=\"\'.$user_id.\'\" and \r\n			rex_com_contact.accepted=0 and \r\n			rex_com_contact.requested=0\r\n			\'.$add_sql;\r\n	\r\n	$gl = new rex_sql;\r\n	$gl->debugsql = 0;\r\n	$gl->setQuery($sql);\r\n	\r\n	$max = $gl->getRows();\r\n	$link = \'index.php?article_id=\'.$aid.\'&amp;tab=\'.$status;\r\n	// Alle | A-Z | Blaettern\r\n	echo \'\r\n	<div class=\"com-navi\"><p class=\"flLeft\">&amp;nbsp;</p>\r\n	<!--		<ul class=\"navi com-navi-letters\">\r\n				<li><a href=\"\'.$link.\'\">Alle | </a></li>\r\n				\';\r\n	\r\n	for($i=65;$i<91;$i++)\r\n	{\r\n		echo \'		<li><a href=\"\'.$link.\'&amp;amp;filter=\'.chr($i).\'\">\'.chr($i).\'</a></li>\';\r\n	}\r\n	echo \'\r\n			</ul>\r\n	-->\r\n					\'.rex_com_blaettern($gl).\'\r\n			<div class=\"clearer\"> </div>\r\n	</div>\r\n	\';\r\n\r\n	// Ergebnisse anzeigen\r\n	for($i=0;$i<$gl->getRows();$i++)\r\n	{\r\n		echo \'\r\n			<div class=\"com-contact\">\r\n				<div class=\"com-image\">\r\n					<p class=\"image\">\'.rex_com_showUser($gl,\"image\",\"\", TRUE).\'</p>\r\n				</div>\r\n				<div class=\"com-content\">\r\n				<div class=\"com-content-2\">\r\n					<p><span class=\"color-1\">\'.rex_com_showUser($gl,\"name\",\"\", TRUE).\', \'.rex_com_showUser($gl,\"city\",\"\", FALSE).\'</span><br />Bestätigt am: \'.rex_com_formatter($gl->getValue(\"create_datetime\"),\'date\').\'</p>\r\n					\';\r\nif(rex_com_showUser($gl,\"motto\",\"\", FALSE) != \"\") echo \'<p>Motto: \'.rex_com_showUser($gl,\"motto\",\"\", FALSE).\'</p>\';\r\necho \'\r\n					<p class=\"link-button\"><a href=\"\'.rex_com_showUser($gl,\"url\").\'\"><span>Mehr Infos</span></a></p>\r\n				</div></div>\r\n				<div class=\"clearer\"> </div>\r\n			</div>\r\n		\';\r\n		$gl->next();\r\n	}\r\n	echo \'<div class=\"clearer\"> </div>\';\r\n}\r\n?>','<?php\r\n$g = new rex_select;\r\n$g->setName(\"VALUE[1]\");\r\n$g->addOption(\"Best&#x2030;tigte Kontakte\",0);\r\n$g->addOption(\"Unbest&#x2030;tigte Kontakte\",1);\r\n$g->addOption(\"Zu best&#x2030;tigende Kontakte\",2);\r\n$g->setSelected(\"REX_VALUE[1]\");\r\n$g->setSize(1);\r\necho $g->show();\r\n?><br />\r\n','','admin',0,1372006216,'',0),
  (14,'1301 - COM-Module - Nachrichten',0,'<?php\r\n// ----- Meine Nachrichten\r\n$tab = rex_request(\"tab\",\"int\",\"0\");\r\n$aid = rex_request(\"article_id\",\"int\",\"0\");\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"]))\r\n{\r\n	if (\"REX_VALUE[1]\" == \"1\")\r\n	{\r\n		// ***** outbox\r\n		 // von mir an andere\r\n		 // -> anderen user anzeigen\r\n		$who = \"from_user_id\";\r\n		$text = \"Zu\";\r\n		$show = \"to_user_id\"; // diesen user anzeigen\r\n	}else\r\n	{\r\n		// ***** inbox\r\n		// an mich\r\n		// -> user von anzeigen\r\n		$who = \"to_user_id\"; // an mich\r\n		$text = \"Von\";\r\n		$show = \"from_user_id\"; // diesen user anzeigen\r\n	}\r\n	$user_id = $REX[\"COM_USER\"]->getValue(\"id\");\r\n	\r\n	if($_REQUEST[\'func\'] == \"delete\")\r\n	{\r\n	\r\n		$del_id = (int) $_REQUEST[\'del_id\'];\r\n		$delsql = new rex_sql();\r\n		$delsql->setQuery(\"DELETE FROM `rex_com_message` WHERE (`user_id`=\'\".$user_id.\"\') AND `id`=\'\".$del_id.\"\'\");	\r\n		echo \'<p class=\"warning\">Nachricht wurde gel&#x02c6;scht.</p>\';\r\n	\r\n	}\r\n	\r\n	$sql = \"SELECT \r\n		* \r\n		FROM \r\n			rex_com_message, rex_com_user\r\n		WHERE \r\n			rex_com_message.user_id=\".$user_id .\"\r\n			AND rex_com_message.$who=\".$user_id .\"\r\n			AND rex_com_message.$show=rex_com_user.id \r\n        ORDER BY \r\n        	rex_com_message.create_datetime DESC\";\r\n\r\n	$link = \"index.php?article_id=$aid&amp;tab=$tab\";\r\n	$m = new rex_sql;\r\n	// $m->debugsql = 1;\r\n	$m->setQuery($sql);\r\n	// Ergebnisse anzeigen\r\n	for($i=0;$i<$m->getRows();$i++)\r\n	{\r\n		echo \'\r\n			<div class=\"com-contact\">\r\n				<div class=\"com-image\">\r\n					<p class=\"image\">\'.rex_com_showUser($m,\"image\",\"\", TRUE, FALSE).\'</p>\r\n				</div>\r\n				<div class=\"com-content\">\r\n					<p><span class=\"color-1\">\'.rex_com_showUser($m,\"name\",\"\", TRUE).\', \'.rex_com_showUser(&amp;$m,\"city\",\"\", FALSE).\'</span><br />Erstellt am: <b>\'.rex_formatter($m->getValue(\"create_datetime\"),\"datetime\",\"timestamp\").\'</b></p>\r\n					<p>\r\n					Betreff: <b>\'.htmlspecialchars($m->getValue(\"rex_com_message.subject\")).\'</b>\r\n					<br />Nachricht: \r\n					<br /><b>\'.nl2br(htmlspecialchars($m->getValue(\"rex_com_message.body\"))).\'</b></p>\r\n					<p class=\"link-button\"><a href=\"\'.$link.\'&amp;amp;func=delete&amp;del_id=\'.$m->getValue(\"rex_com_message.id\").\'\"><span>L&#x02c6;schen</span></a></p>\r\n				</div>\r\n				<div class=\"clearer\"> </div>\r\n			</div>\r\n		\';\r\n		$m->next();\r\n	}\r\n\r\n	if ($m->getRows()<1)\r\n	{\r\n		echo \'<p class=\"nomessage\">Es befinden sich derzeit keine aktuellen Nachrichten in Ihrer Nachrichtenbox.</p>\';\r\n	}\r\n	echo \'<div class=\"clearer\"> </div>\';\r\n}\r\n?>','Outbox = 1\r\nWelche Box soll angezeigt werden:\r\n<br /><?php\r\n$sel = new rex_select;\r\n$sel->setName(\"VALUE[1]\");\r\n$sel->setSize(1);\r\n$sel->addOption(\"Inbox\",\"0\");\r\n$sel->addOption(\"Outbox\",\"1\");\r\n$sel->setSelected(\"REX_VALUE[1]\");\r\necho $sel->show();\r\n?><br />\r\n','','admin',0,1372006216,'',0),
  (18,'1501 - COM-Module - Artikelkommentar',0,'<div class=\"rex-com-articlecommentbox\">\r\n<?php\r\n$ADMIN = FALSE;\r\nif (isset($REX[\"COM_USER\"]) AND is_object($REX[\"COM_USER\"]))\r\n{\r\n	if ($REX[\"COM_USER\"]->getValue(\"admin\")==1) $ADMIN = TRUE; \r\n	if ($ADMIN AND isset($_REQUEST[\"delete_message\"]) AND $_REQUEST[\"delete_message\"]==1)\r\n	{\r\n		$msg_id = (int) $_REQUEST[\"msg_id\"];\r\n		$d = new rex_sql;\r\n		$d->setQuery(\'update rex_com_comment set status=0 where article_id=REX_ARTICLE_ID AND id=\'.$msg_id);\r\n	}\r\n	$xform = new rex_xform;\r\n	$xform->setDebug(FALSE);\r\n	$form_data = \'\r\nhtml|<div class=\"com-tab com-tab-no-navi\">\r\nhtml|<div class=\"com-tab-cntnt\">\r\nhtml|<div class=\"com-tab-cntnt-2\">\r\nhtml|<div class=\"com-tab-cntnt-3\">\r\nhtml|<div id=\"rex-form\">\r\nhtml|<div class=\"spcl-bgcolor\">\r\nhidden|article_id|REX_ARTICLE_ID\r\nhidden|status|1\r\ncom_user|user_id|id|Absender\r\ntextarea|comment|Kommentar\r\ntimestamp|create_datetime\r\nvalidate|notEmpty|comment|Bitte gib einen Kommentar ein.\r\naction|db|rex_com_comment\r\nobjparams|submit_btn_show|0\r\nsubmit|submit|Abschicken|no_db\r\nhtml|<div class=\"clearer\"> </div>\r\nhtml|</div>\r\nhtml|</div>\r\nhtml|</div>\r\nhtml|</div>\r\nhtml|</div>\r\nhtml|</div>\r\n	\';\r\n	\r\n	$form_data = trim(str_replace(\"<br />\",\"\",rex_xform::unhtmlentities($form_data)));\r\n	\r\n	$xform->setFormData($form_data);\r\n	$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID); \r\n	$xform->setObjectparams(\"answertext\",\"Vielen Dank für den Eintrag\"); // Antworttext\r\n	$xform->setObjectparams(\"main_table\",\"rex_com_comment\"); // für db speicherungen und unique abfragen\r\n	\r\n	// Aktion einstellen\r\n	$xform->setObjectparams(\"form_type\",-1); // form_typ\r\n	$addcomment = $xform->getForm();\r\n}else\r\n{\r\n	$addcomment = \'<div class=\"nologin\"><p>Sie sind nicht eingeloggt. Bitte melden Sie sich an, wenn Sie Kommentare schreiben wollen</p></div>\';\r\n}\r\n// ***** SHOW MESSAGES\r\necho \'\r\n<div class=\"com-tab com-tab-no-navi\">\r\n<div class=\"com-tab-cntnt\">\r\n<div class=\"com-tab-cntnt-2\">\r\n<div class=\"com-tab-cntnt-3\">\';\r\n\r\n$commentsql = new rex_sql();\r\n$commentsql->debugsql = 0;\r\n$commentsql->setQuery(\"SELECT * \r\n	FROM  rex_com_comment \r\n	LEFT JOIN rex_com_user ON rex_com_comment.user_id=rex_com_user.id \r\n	WHERE rex_com_comment.article_id=REX_ARTICLE_ID  and rex_com_comment.status=1\r\n	ORDER BY rex_com_comment.create_datetime desc\");\r\nif($commentsql->getRows()<=0)\r\n{\r\n	echo \'<p class=\"com-whitebox\">Kein Kommentar vorhanden !</p>\';\r\n}else\r\n{\r\n	$cl = \"\";\r\n	for($i=0;$i<$commentsql->getRows();$i++)\r\n	{\r\n		// $cl\r\n		echo \'\r\n		<div class=\"com-comment\">\r\n			<div class=\"com-image\">\r\n				<p class=\"image\">\'.rex_com_showUser($commentsql,\"image\").\'</p>\r\n			</div>\r\n			\r\n			<div class=\"com-content-name\">\r\n				<p><span class=\"color-1\">\'.rex_com_showUser($commentsql,\"name\").\'</span>\r\n					<br />\'.rex_com_formatter($commentsql->getValue(\"rex_com_comment.create_datetime\"),\'datetime\').\'\r\n				</p>\r\n			</div>\r\n			<div class=\"com-content\">\r\n				<p><b>\'.nl2br(htmlspecialchars($commentsql->getValue(\"rex_com_comment.comment\"))).\'</b></p>\';\r\n			\r\n			if ($commentsql->getValue(\"rex_com_user.motto\") != \'\')\r\n				echo \'<p>Motto: \'.$commentsql->getValue(\"rex_com_user.motto\").\'</p>\';\r\n	\r\n		if ($ADMIN)\r\n		{\r\n			$link_params = array_merge($params,array(\"article_id\"=>REX_ARTICLE_ID,\"delete_message\"=>1,\"msg_id\"=>$commentsql->getValue(\"rex_com_comment.id\")));\r\n			echo \'<p class=\"link-button\"><a href=\"\'.rex_getUrl(REX_ARTICLE_ID,\'\',$link_params).\'\"><span>Löschen</span></a></p>\';\r\n		}\r\n		echo \'</div>\r\n			<div class=\"clearer\"> </div>\r\n		</div>\';\r\n		\r\n		if ($cl == \"\") $cl = \' class=\"alternative\"\';\r\n		else $cl = \"\";\r\n		$commentsql->next();\r\n	}\r\n}\r\necho \'\r\n<div class=\"clearer\"> </div>\r\n</div>\r\n</div>\r\n</div>\r\n</div>\r\n\';\r\necho $addcomment;\r\n?>\r\n</div>','','','admin',0,1372006217,'',0),
  (16,'1401 - COM-Module - Board',0,'<div class=\"com-board\"><?php\r\n$board = new rex_com_board;\r\nif (isset($REX[\"COM_USER\"]) AND $REX[\"COM_USER\"]->getValue(\"admin\")==1) $board->setAdmin(true);\r\n$board->setArticleId(\"REX_ARTICLE_ID\");\r\n$board->setBoardname(\"REX_VALUE[1]\");\r\n$board->setRealBoardname(\"REX_VALUE[2]\");\r\nif (\"REX_VALUE[7]\" != \"user\") $board->setAnonymous(true);\r\nelseif (isset($REX[\"COM_USER\"]) AND $REX[\"COM_USER\"]->getValue(\"status\")>0) $board->setUser($REX[\"COM_USER\"]->getValue(\"login\"));\r\n\r\n$board->setFormPostAction(\"index.php\");\r\necho $board->showBoard();\r\n?></div>\r\n','Boardbezeichnung/ Allgemeiner Titel:\r\n<br /><input type=text size=50 name=\"VALUE[2]\" value=\"REX_VALUE[2]\" />\r\n<br /><br />Datenbankbezeichnung (nur kleine Buchstaben verwenden):\r\n<br /><input type=text size=50 name=\"VALUE[1]\" value=\"REX_VALUE[1]\" />\r\n<br /><br /><?\r\n$se = new rex_select;\r\n$se->setName(\"VALUE[7]\");\r\n$se->setSize(1);\r\n$se->addOption(\"Anonym\",\"anonym\");\r\n$se->addOption(\"Nur eingeloggte User\",\"user\");\r\n$se->setSelected(\"REX_VALUE[7]\");\r\necho $se->show();\r\n?><br /><br />','','admin',0,1370873024,'',0),
  (17,'1402 - COM-Module - Boardteaser',0,'<?php\r\nif(OOAddon::isAvailable(\'textile\'))\r\n{\r\n	$text = \'\';\r\n	if(REX_IS_VALUE[1])\r\n	{\r\n	\r\n$input =<<< EOT123451827235\r\nREX_HTML_VALUE[1]\r\nEOT123451827235;\r\n	\r\n		$board_id = \'REX_VALUE[2]\';\r\n		$gt = new rex_sql();\r\n		$gt->debugsql = 0;\r\n		$gt->setQuery(\'select count(message_id) as c from rex_com_board where board_id=\"REX_VALUE[2]\" and status=1\');\r\n		$input = str_replace(\"###board-eintraege###\",$gt->getValue(\"c\"),$input);\r\n		$gt->setQuery(\'select count(message_id) as c from rex_com_board where board_id=\"REX_VALUE[2]\" and status=1 and re_message_id=0\');\r\n		$input = str_replace(\"###board-themen###\",$gt->getValue(\"c\"),$input);\r\n		// $text = str_replace(\"###\",\"&amp;#x20;\",$text);\r\n		$textile = new Textile(); \r\n		$input = $textile->TextileThis($input);\r\n	} \r\n	\r\n	print \'<div class=\"txt-img rex-com-boardteaser\">\'. $input. \'</div>\';\r\n}else\r\n{\r\n	echo rex_warning(\'Dieses Modul benötigt das \"textile\" Addon!\');\r\n}\r\n?>','<strong>Text</strong>\r\n<br />[F&#x00b8;r Anzahl der Eintr&#x2030;ge bitte ###board-eintraege### verwenden]:\r\n<br />[F&#x00b8;r Anzahl der Themen bitte ###board-themen### verwenden]:\r\n<br />\r\n<?php if(OOAddon::isAvailable(\'textile\')) { ?>\r\n<textarea name=\"VALUE[1]\" cols=\"80\" rows=\"10\" class=\"inp100\">REX_VALUE[1]</textarea>\r\n<br />\r\n<?php rex_a79_help_overview(); }else { echo rex_warning(\'Dieses Modul ben&#x02c6;tigt das \"textile\" Addon!\'); } ?>\r\n<br />Boardkey:\r\n<input type=\"text\" name=\"VALUE[2]\" value=\"REX_VALUE[2]\" size=\"20\" />\r\n<br /><br />','','admin',0,1372008063,'',0),
  (19,'XForm Formbuilder',0,'<?php\n\n// module:xform_basic_out\n// v0.2\n//--------------------------------------------------------------------------------\n\n$xform = new rex_xform;\nif (\"REX_VALUE[7]\" == 1) { $xform->setDebug(TRUE); }\n$form_data = \'REX_VALUE[3]\';\n$form_data = trim(str_replace(\"<br />\",\"\",rex_xform::unhtmlentities($form_data)));\n$xform->setFormData($form_data);\n$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID); \n\n?>REX_PHP_VALUE[9]<?php\n\n// action - showtext\nif(\"REX_IS_VALUE[6]\" == \"true\")\n{\n  $html = \"0\"; // plaintext\n  if(\'REX_VALUE[11]\' == 1) $html = \"1\"; // html\n  if(\'REX_VALUE[11]\' == 2) $html = \"2\"; // textile\n  \n  $e3 = \'\'; $e4 = \'\';\n  if ($html == \"0\") {\n    $e3 = \'<div class=\"rex-message\"><div class=\"rex-info\"><p>\';\n    $e4 = \'</p></div></div>\';\n  }\n  \n  $t = str_replace(\"<br />\",\"\",rex_xform::unhtmlentities(\'REX_VALUE[6]\'));\n  $xform->setActionField(\"showtext\",array(\n      $t,\n      $e3,\n      $e4,\n      $html // als HTML interpretieren\n    )\n  );\n}\n\n$form_type = \"REX_VALUE[1]\";\n\n// action - email\nif ($form_type == \"1\" || $form_type == \"2\" || $form_type == \"3\")\n{\n  $mail_from = $REX[\'ERROR_EMAIL\'];\n  if(\"REX_VALUE[2]\" != \"\") $mail_from = \"REX_VALUE[2]\";\n  $mail_to = $REX[\'ERROR_EMAIL\'];\n  if(\"REX_VALUE[12]\" != \"\") $mail_to = \"REX_VALUE[12]\";\n  $mail_subject = \"REX_VALUE[4]\";\n  $mail_body = str_replace(\"<br />\",\"\",rex_xform::unhtmlentities(\'REX_VALUE[5]\'));\n  $xform->setActionField(\"email\", array(\n      $mail_from,\n      $mail_to,\n      $mail_subject,\n      $mail_body\n    )\n  );\n}\n\n// action - db\nif ($form_type == \"0\" || $form_type == \"2\" || $form_type == \"3\")\n{\n  $xform->setObjectparams(\'main_table\', \'REX_VALUE[8]\');\n  \n  //getdata\n  if (\"REX_VALUE[10]\" != \"\")\n    $xform->setObjectparams(\"getdata\",TRUE);\n  \n  $xform->setActionField(\"db\", array(\n      \"REX_VALUE[8]\", // table\n      $xform->objparams[\"main_where\"], // where\n      )\n    );\n}\n\necho $xform->getForm();\n\n?>\n','<?php\n\n// module:xform_basic_in\n// v0.2.1\n// --------------------------------------------------------------------------------\n\n// DEBUG SELECT\n////////////////////////////////////////////////////////////////////////////////\n$dbg_sel = new rex_select();\n$dbg_sel->setName(\'VALUE[7]\');\n$dbg_sel->setSize(1);\n$dbg_sel->addOption(\'inaktiv\',\'0\');\n$dbg_sel->addOption(\'aktiv\',\'1\');\n$dbg_sel->setSelected(\'REX_VALUE[7]\');\n$dbg_sel = $dbg_sel->get();\n\n\n// TABLE SELECT\n////////////////////////////////////////////////////////////////////////////////\n$gc = rex_sql::factory();\n$gc->setQuery(\'SHOW TABLES\');\n$tables = $gc->getArray();\n$tbl_sel = new rex_select;\n$tbl_sel->setName(\'VALUE[8]\');\n$tbl_sel->setSize(1);\n$tbl_sel->addOption(\'Keine Tabelle ausgewählt\', \'\');\nforeach ($tables as $key => $value)\n{\n  $tbl_sel->addOption(current($value), current($value));\n}\n$tbl_sel->setSelected(\'REX_VALUE[8]\');\n$tbl_sel = $tbl_sel->get();\n\n\n// PLACEHOLDERS\n////////////////////////////////////////////////////////////////////////////////\n$xform = new rex_xform;\n$form_data = \'REX_VALUE[3]\';\n$form_data = trim(str_replace(\'<br />\',\'\',rex_xform::unhtmlentities($form_data)));\n$xform->setFormData($form_data);\n$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID);\n$placeholders = \'\';\nif(\'REX_VALUE[3]\'!=\'\')\n{\n$ignores = array(\'html\',\'validate\',\'action\');\n  $placeholders .= \'  <strong class=\"hint\">Platzhalter: <span>[<a href=\"#\" id=\"xform-placeholders-help-toggler\">?</a>]</span></strong>\n  <p id=\"xform-placeholders\">\'.PHP_EOL;\nforeach($xform->objparams[\'form_elements\'] as $e)\n{\n  if(!in_array($e[0],$ignores) && isset($e[1]))\n  {\n      $placeholders .= \'<span>###\'.$e[1].\'###</span> \'.PHP_EOL;\n  }\n}\n  $placeholders .= \'  </p>\'.PHP_EOL;\n}\n\n\n// OTHERS\n////////////////////////////////////////////////////////////////////////////////\n$row_pad = 1;\n\n$sel = \'REX_VALUE[1]\';\n$db_display   = ($sel==\'\' || $sel==1) ?\'style=\"display:none\"\':\'\';\n$mail_display = ($sel==\'\' || $sel==0) ?\'style=\"display:none\"\':\'\';\n\n?>\n\n<style type=\"text/css\" media=\"screen\">\n  /*BAISC MODUL STYLE*/\n  #xform-modul                       {margin:0;padding:0;line-height:25px;}\n  #xform-modul fieldset              {background:#E4E1D1;margin:-20px 0 0 0;padding: 4px 10px 10px 10px;-moz-border-radius:6px;-webkit-border-radius:6px;border-radius:6px;}\n  #xform-modul fieldset legend       {display:block !important;position:relative !important;height:auto !important;top:0 !important;left:0 !important;width:100% !important;margin:0 0 0 0 !important;padding:30px 0 0 0px !important;background:transparent !important;border-bottom:1px solid #B1B1B1 !important;color:gray;font-size:14px;font-weight:bold;}\n  #xform-modul fieldset legend em    {font-size:10px;font-weight:normal;font-style:normal;}\n  #xform-modul fieldset strong.label,\n  #xform-modul fieldset label        {display:inline-block !important;width:150px !important;font-weight:bold;}\n  #xform-modul fieldset label span   {font-weight:normal;}\n  #xform-modul input,\n  #xform-modul select                {width:460px;border:auto;margin:0 !important;padding:0 !important;}\n  #xform-modul input[type=\"checkbox\"]{width:auto;}\n  #xform-modul hr                    {border:0;height:0;margin:4px 0 4px 0;padding:0;border-top:1px solid #B1B1B1 !important;clear:left;}\n  #xform-modul a.blank               {background:url(\"../files/addons/be_style/plugins/agk_skin/popup.gif\") no-repeat 100% 0;padding-right:17px;}\n  #xform-modul #modulinfo            {font-size:10px;text-align:right;}\n  /*XFORM MODUL*/\n  #xform-modul textarea              {min-height:50px;font-family:monospace;font-size:12px;}\n  #xform-modul pre                   {clear:left;}\n  #xform-modul strong span           {font-weight:normal;}\n  #xform-modul .help                 {display:none;color:#2C8EC0;line-height:12px;}\n  #xform-modul .area-wrapper         {background:white;border:1px solid #737373;margin-bottom:10px;width:100%;}\n  #xform-modul .fullwidth            {width:100% !important;}\n  #xform-modul #thx-markup           {width:auto !important;}\n  #xform-modul #thx-markup input     {width:auto !important;}\n  #xform-modul #xform-placeholders-help,\n  #xform-modul #xform-where-help     {display:none;}\n  #xform-modul #xform-placeholders,\n  #xform-modul #xform-classes-showhelp {background:white;border:1px solid #737373;margin-bottom:10px;width:100%;}\n  #xform-modul #xform-placeholders {padding:4px 10px;float:none;width:auto;}\n  #xform-modul #xform-placeholders span:hover {color:red;cursor:pointer;}\n  #xform-modul em.hint               {color:silver;margin:0;padding:0 0 0 10px;}\n  /*SHOWHELP OVERRIDES*/\n  #xform-modul ul.xform.root         {border:0;outline:0;margin:4px 0;padding:0;width:100%;background:transparent;}\n  #xform-modul ul.xform              {font-size:1.1em;line-height:1.4em;}\n</style>\n\n\n<div id=\"xform-modul\">\n<fieldset>\n  <legend>Formular</legend>\n\n  <label>DebugModus:</label>\n  <?php echo $dbg_sel;?>\n\n  <hr />\n\n  <label class=\"fullwidth\">Felddefinitionen:</label>\n  <textarea name=\"VALUE[3]\" id=\"xform-form-definition\" class=\"fullwidth\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[3]\'))+$row_pad);?>\">REX_VALUE[3]</textarea>\n\n  <strong class=\"label\">Verfügbare Feld-Klassen:</strong>\n  <div id=\"xform-classes-showhelp\">\n    <?php echo rex_xform::showHelp(true,true); ?>\n  </div><!-- #xform-classes-showhelp -->\n\n  <div id=\"thx-markup\"><strong>Meldung bei erfolgreichen Versand:</strong> (\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"0\" <?php if(\"REX_VALUE[11]\" == \"0\") echo \'checked=\"checked\"\'; ?>> Plaintext\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"1\" <?php if(\"REX_VALUE[11]\" == \"1\") echo \'checked=\"checked\"\'; ?>> HTML\n    <input type=\"radio\" name=\"VALUE[11]\" value=\"2\" <?php if(\"REX_VALUE[11]\" == \"2\") echo \'checked=\"checked\"\'; ?>> Textile)\n  </div><!-- #thx-markup -->\n  <textarea name=\"VALUE[6]\" id=\"xform-thx-message\" class=\"fullwidth\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[6]\'))+$row_pad);?>\">REX_VALUE[6]</textarea>\n\n</fieldset>\n\n\n<fieldset>\n  <legend>Vordefinierte Aktionen</legend>\n\n  <label>Bei Submit:</label>\n  <select name=\"VALUE[1]\" id=\"xform-action-select\" style=\"width:auto;\">\n    <option value=\"\"  <?php if(\"REX_VALUE[1]\" == \"\")  echo \" selected \"; ?>>Nichts machen (actions im Formular definieren)</option>\n    <option value=\"0\" <?php if(\"REX_VALUE[1]\" == \"0\") echo \" selected \"; ?>>Nur in Datenbank speichern oder aktualisieren wenn \"main_where\" gesetzt ist</option>\n    <option value=\"1\" <?php if(\"REX_VALUE[1]\" == \"1\") echo \" selected \"; ?>>Nur E-Mail versenden</option>\n    <option value=\"2\" <?php if(\"REX_VALUE[1]\" == \"2\") echo \" selected \"; ?>>E-Mail versenden und in Datenbank speichern</option>\n    <!--  <option value=\"3\" <?php if(\"REX_VALUE[1]\" == \"3\") echo \" selected \"; ?>>E-Mail versenden und Datenbank abfragen</option> -->\n  </select>\n\n</fieldset>\n\n\n<fieldset id=\"xform-mail-fieldset\" <?php echo $mail_display;?> >\n  <legend>Emailversand:</legend>\n\n  <label>Absender:</label>\n  <input type=\"text\" name=\"VALUE[2]\" value=\"REX_VALUE[2]\" />\n\n  <label>Empfänger:</label>\n  <input type=\"text\" name=\"VALUE[12]\" value=\"REX_VALUE[12]\" />\n\n  <label>Subject:</label>\n  <input type=\"text\" name=\"VALUE[4]\" value=\"REX_VALUE[4]\" />\n  <label class=\"fullwidth\">Mailbody:</label>\n  <textarea id=\"xform-mail-body\" class=\"fullwidth\" name=\"VALUE[5]\" rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[5]\'))+$row_pad);?>\">REX_VALUE[5]</textarea>\n\n    <?php echo $placeholders;?>\n\n  <ul class=\"help\" id=\"xform-placeholders-help\">\n    <li>Die Platzhalter ergeben sich aus den obenstehenden Felddefinitionen.</li>\n    <li>Per click können einzelne Platzhalter in den Mail-Body kopiert werden.</li>\n    <li>Aktualisierung der Platzhalter erfolgt über die Aktualisierung des Moduls.</li>\n  </ul>\n\n\n</fieldset>\n\n\n<fieldset id=\"xform-db-fieldset\" <?php echo $db_display;?> >\n  <legend>Datenbank Einstellungen</legend>\n\n  <label>Tabelle wählen <span>[<a href=\"#\" id=\"xform-db-help-toggler\">?</a>]</span></label>\n  <?php echo $tbl_sel;?>\n  <ul class=\"help\" id=\"xform-db-select-help\">\n    <li>Diese Tabelle gilt auch bei Uniqueabfragen (Pflichtfeld=2) siehe oben</li>\n  </ul>\n\n  <hr />\n\n  <label for=\"getdatapre\">Daten initial aus DB holen</label>\n  <input id=\"getdatapre\" type=\"checkbox\" value=\"1\" name=\"VALUE[10]\" <?php if(\"REX_VALUE[10]\" != \"\") echo \'checked=\"checked\"\'; ?> />\n\n  <div id=\"db_data\">\n    <hr />\n    <label>Where Klausel: <span>[<a href=\"#\" id=\"xform-xform-where-help-toggler\">?</a>]</span></label>\n    <textarea name=\"VALUE[9]\" cols=\"30\" id=\"xform-db-where\" class=\"fullwidth\"rows=\"<?php echo (count(explode(\"\\r\",\'REX_VALUE[9]\'))+$row_pad);?>\">REX_VALUE[9]</textarea>\n    <ul class=\"help\" id=\"xform-where-help\">\n      <li>PHP erlaubt. Beispiel: <em>$xform-&gt;setObjectparams(\"main_where\",$where);</em></li>\n      <li>Die Benutzereingaben aus dem Formular können mittels Platzhaltern (Schema: ###<em>FELDNAME</em>###) in der WHERE Klausel verwendet werden - Beispiel: text|myname|Name|1 -> Platzhalter: ###myname###</li>\n    </ul>\n  </div><!-- #db_data -->\n\n  </fieldset>\n\n  <p id=\"modulinfo\">XForm Formbuilder v0.2.1</p>\n\n</div><!-- #xform-modul -->\n\n<script type=\"text/javascript\">\n<!--\n(function($){\n\n  // FIX WEBKIT CSS QUIRKS\n  if ($.browser.webkit) {\n    $(\'#xform-modul textarea\').css(\'min-height\',\'70px\');\n    $(\'#xform-modul textarea\').css(\'width\',\'701px\');\n    $(\'#xform-modul fieldset\').css(\'width\',\'705px\');\n  }\n\n  // AUTOGROW BY ROWS\n  $(\'#xform-modul textarea\').keyup(function(){\n    var rows = $(this).val().split(/\\r?\\n|\\r/).length + <?php echo $row_pad;?>;\n    $(this).attr(\'rows\',rows);\n  });\n\n  // TOGGLERS\n  $(\'#xform-placeholders-help-toggler\').click(function(){\n    $(\'#xform-placeholders-help\').toggle(50);return false;\n  });\n  $(\'#xform-xform-where-help-toggler\').click(function(){\n    $(\'#xform-where-help\').toggle(50);return false;\n  });\n  $(\'#xform-db-help-toggler\').click(function(){\n    $(\'#xform-db-select-help\').toggle(50);return false;\n  });\n\n\n  // INSERT PLACEHOLDERS\n  $(\'#xform-placeholders span\').click(function(){\n    newval = $(\'#xform-mail-body\').val()+\' \'+$(this).html();\n    $(\'#xform-mail-body\').val(newval);\n  });\n\n  // TOGGLE MAIL/DB PANELS\n  $(\'#xform-action-select\').change(function(){\n    switch($(this).val()){\n      case \'\':\n        $(\'#xform-db-fieldset\').hide(0);\n        $(\'#xform-mail-fieldset\').hide(0);\n        break;\n      case \'1\':\n        $(\'#xform-db-fieldset\').hide(0);\n        $(\'#xform-mail-fieldset\').show(0);\n        break;\n      case \'0\':\n        $(\'#xform-db-fieldset\').show(0);\n        $(\'#xform-mail-fieldset\').hide(0);\n        break;\n      case \'2\':\n      case \'3\':\n        $(\'#xform-db-fieldset\').show(0);\n        $(\'#xform-mail-fieldset\').show(0);\n        break;\n    }\n  });\n\n})(jQuery)\n//-->\n</script>','','',0,0,'',0),
  (20,'rex - comment',0,'<?php\n\n// module:com_comment_basic_out\n// v2.9\n// --------------------------------------------------------------------------------\n\n$c = new rex_com_comments();\n$c->setCommentKey(\'aid-REX_ARTICLE_ID\');\n$c->setShowAddForm(true);\n$c->setPageLink(rex_getUrl(REX_ARTICLE_ID));\nif(\"REX_MEDIA[1]\" != \"\")\n{\n  $c->setDefaultUserImage(\'/files/REX_MEDIA[1]\');\n}\n\n$c->setArticleName($this->getValue(\'name\'));\n\necho $c->getCommentsView();\n\n?>','<?php\n\n// module:com_comment_basic_in\n// v2.9\n// --------------------------------------------------------------------------------\n\n?>\n\nDefault Userbild auswählen:\n<br />REX_MEDIA_BUTTON[1]\n','','',0,0,'',0);
/*!40000 ALTER TABLE `rex_module` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_module_action`;
CREATE TABLE `rex_module_action` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module_id` int(11) NOT NULL DEFAULT '0',
  `action_id` int(11) NOT NULL DEFAULT '0',
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `rex_template`;
CREATE TABLE `rex_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `content` text,
  `active` tinyint(1) DEFAULT NULL,
  `createuser` varchar(255) NOT NULL,
  `updateuser` varchar(255) NOT NULL,
  `createdate` int(11) NOT NULL DEFAULT '0',
  `updatedate` int(11) NOT NULL DEFAULT '0',
  `attributes` text,
  `revision` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_template` WRITE;
/*!40000 ALTER TABLE `rex_template` DISABLE KEYS */;
INSERT INTO `rex_template` VALUES 
  (1,'','1011 - COM-Template - Standardtemplate','<?php\r\nerror_reporting(E_ALL ^ E_NOTICE);\r\n\r\n// Die IDs der Templates muessen angepasst werden\r\n// Permission Funktion includen, passende ID einsetzen\r\n?>REX_TEMPLATE[9]<?php\r\n\r\n// Authentifizierung includen, passende ID einsetzen\r\n?>REX_TEMPLATE[8]<?php\r\n\r\n/*\r\nNavigation anpassen an neue Auth*/\r\nif (rex_com_checkUserPerm($this->getValue(\"art_com_perm\")))\r\n{\r\n  // Zugriff erlaubt\r\n  $cont  = $this->getArticle(1);\r\n  $cont_l  = $this->getArticle(2);\r\n  $cont_r  = $this->getArticle(3);\r\n	$art = OOArticle::getArticleById(REX_ARTICLE_ID);\r\n	$cat = OOCategory::getCategoryById($art->getCategoryId());\r\n	if ($cont_l == \'\') {\r\n		while ($cont_l == \'\') {\r\n			if ($cat == null) break;\r\n			$a = new rex_article($cat->getId());\r\n			$cont_l = $a->getArticle(2);\r\n			$cat = $cat->getParent();\r\n		} \r\n	}\r\n	if ($cont_l == \'\') {\r\n		$a = new rex_article($REX[\'START_ARTICLE_ID\']);\r\n		$cont_l = $a->getArticle(2);\r\n	}\r\n	if ($cont_r == \'\') {\r\n		while ($cont_r == \'\') {\r\n			if ($cat == null) break;\r\n			$a = new rex_article($cat->getId());\r\n			$cont_r = $a->getArticle(3);\r\n			$cat = $cat->getParent();\r\n		} \r\n	}\r\n	if ($cont_r == \'\') {\r\n		$a = new rex_article($REX[\'START_ARTICLE_ID\']);\r\n		$cont_r = $a->getArticle(3);\r\n	}\r\n}\r\n\r\nelse\r\n{\r\n  // Zugriff verboten\r\n  ob_end_clean();\r\n  ob_end_clean();\r\n  header(\'Location:\'.rex_getUrl(REX_COM_PAGE_LOGIN_ID,\'\',array(\"errmsg\"=>\'Sie haben keine Rechte f&uuml;r diese Seite und wurden deswegen auf die Startseite geleitet.\')));\r\n  exit;\r\n}/*\r\n*/\r\n\r\n?><!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Strict//EN\" \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">\r\n<html xmlns=\"http://www.w3.org/1999/xhtml\" xml:lang=\"de\" lang=\"de\">\r\n<head>\r\n	<title>Community REDAXO</title>\r\n	<meta http-equiv=\"content-type\" content=\"text/html; charset=utf-8\" />\r\n	<meta name=\"robots\" content=\"index, follow\" />\r\n	<meta name=\"language\" content=\"deutsch\" />\r\n	<meta name=\"distribution\" content=\"global\" />\r\n	<meta name=\"revisit-after\" content=\"30 days\" />\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"files/css_website.css\" media=\"screen\" />\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"files/css_community.css\" media=\"screen\" />\r\n	<link rel=\"stylesheet\" type=\"text/css\" href=\"files/css_form.css\" media=\"screen\" />\r\n</head>\r\n<body>\r\n<!--\r\n<div style=\"background-color:#f90; padding:10px; color:#fff; display:block;\">Ich arbeite gerade an der Seite, es kann sein das diese hin und wieder ausf&#x2030;llt</div>\r\n-->\r\n<div id=\"wbst\">\r\n	\r\n	<div id=\"logo\"><p><a href=\"/\">Community AddOn</a></p></div>\r\n	\r\n	<div id=\"hdr\">\r\n		<div id=\"com-usr-navi\">\r\n			REX_TEMPLATE[13]\r\n		</div>\r\n		REX_TEMPLATE[14]\r\n	</div>\r\n	\r\n	\r\n	<div id=\"wrppr\">\r\n		<div id=\"f-lft\">\r\n			<div class=\"bx-v1 bx-shdw\">\r\n			<div class=\"bx-v1-2 bx-shdw-2\">\r\n				<div class=\"bx-v1-cntnt\">\r\n					<h3><strong>Navigation</strong></h3>\r\n					<div id=\"com-site-navi\">\r\n						REX_TEMPLATE[12]\r\n					</div>\r\n				</div>\r\n			</div>\r\n			</div>\r\n			<?php echo $cont_l\r\n			?>\r\n		</div>\r\n	\r\n		<div id=\"f-cntnt\">\r\n			<div id=\"cntnt\">\r\n				<?php echo $cont; ?>\r\n			</div>\r\n			\r\n		</div>\r\n		\r\n		<div id=\"f-rght\">\r\n			REX_TEMPLATE[10]\r\n			<?php echo $cont_r; ?>\r\n			REX_TEMPLATE[15]\r\n		</div>\r\n		\r\n		<div class=\"clearer\"> </div>\r\n	</div>\r\n</div>\r\n<div id=\"ftr\">\r\n	<p><a href=\"<?php echo rex_getUrl(35); ?>\">Impressum</a> | &copy; 2007 By Yakamara Media GmbH &amp; Co. KG</p>\r\n</div>\r\n</body>\r\n</html>',1,'admin','admin',1370873828,1371851628,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (8,'','1012 - COM-Template - Authentifizierung','<?php\r\n// -------------------------------------------------------------- USER AUTH\r\n\r\nunset($REX[\'COM_USER\']);\r\n$pagekey = \'comrex\'; // Frontendkey, muss sich unterscheiden, damit frontend und backend sich nicht schneiden.\r\n\r\n$login_name = rex_request(\"login_name\",\"string\");\r\n$login_psw = rex_request(\"login_psw\",\"string\");\r\n$logout = rex_request(\"logout\",\"int\");\r\n$msg = \'Bitte einloggen\';\r\n\r\n// ----- session start\r\nsession_start();\r\n$COM_USER_SAVE = new rex_sql();\r\n$COM_USER_SAVE->setTable(\'rex_com_user\');\r\nif ((isset($_SESSION[$pagekey][\'UID\']) AND $_SESSION[$pagekey][\'UID\'] != \"\") or $login_name != \"\" or $login_psw != \"\")\r\n{\r\n	$user_id = (int) $_SESSION[$pagekey][\'UID\'];\r\n	$GLOBALS[\"I18N\"] = rex_create_lang(\"de\");\r\n	$REX[\'COM_USER\'] = new rex_login();\r\n	$REX[\'COM_USER\']->setSqlDb(1);\r\n	$REX[\'COM_USER\']->setSysID($pagekey);\r\n	$REX[\'COM_USER\']->setSessiontime(3000);\r\n	$REX[\'COM_USER\']->setLogin($login_name,$login_psw);\r\n	if ($logout == 1) { $REX[\'COM_USER\']->setLogout(true); }\r\n	$REX[\'COM_USER\']->setUserID(\"rex_com_user.id\");\r\n	$REX[\'COM_USER\']->setUserquery(\"select * from rex_com_user where id=\'USR_UID\' and status>0\");\r\n	$REX[\'COM_USER\']->setLoginquery(\"select * from rex_com_user where login=\'USR_LOGIN\' and password=\'USR_PSW\' and status>0\");\r\n	\r\n	if ($REX[\'COM_USER\']->checkLogin())\r\n	{\r\n		// ----- Login gelungen\r\n		if ($login_name != \"\")\r\n		{\r\n			// ----- Login gelungen und gerade erst eingeloggt\r\n			// -> last_xs\r\n			$msg = \'Sie haben sich eingeloggt!\';\r\n			$COM_USER_SAVE->setValue(\'last_login\',time());\r\n			$jump_aid = $REX[\'START_ARTICLE_ID\'];\r\n		}\r\n\r\n	}else\r\n	{\r\n		$ud = new rex_sql;\r\n		// $ud->debugsql = 1;\r\n		if ($user_id != 0 || $logout == 1) $ud->setQuery(\'update rex_com_user set online_status=0 where id=\"\'.$user_id.\'\"\');\r\n		\r\n		\r\n		// ----- Login failed\r\n		$msg = \'Login ist fehlgeschlagen.\';\r\n		if ($logout == 1) $msg = \'Sie haben sich ausgeloggt\';\r\n		\r\n		unset($REX[\'COM_USER\']);\r\n		if ($logout == 1) $jump_aid = $REX[\'START_ARTICLE_ID\'];\r\n	}\r\n}else\r\n{\r\n	// ----- nicht eingeloggt und kein login\r\n	$msg = \'Sie sind nicht eingeloggt.\';\r\n	unset($REX[\'COM_USER\']);\r\n}\r\nif (isset($REX[\'COM_USER\']) AND is_object($REX[\'COM_USER\'])AND $REX[\'COM_USER\']->getValue(\'rex_com_user.id\')!=\'\')\r\n{\r\n	// ----- session speichern\r\n	\r\n	$COM_USER_SAVE->setValue(\'online_status\',\'1\');\r\n	$COM_USER_SAVE->setValue(\'session_id\',session_id());\r\n	$COM_USER_SAVE->setValue(\'last_xs\',time());\r\n	$COM_USER_SAVE->setWhere(\'id=\'.$REX[\'COM_USER\']->getValue(\'rex_com_user.id\'));\r\n	$COM_USER_SAVE->update();\r\n}\r\nunset($COM_USER_SAVE);\r\n\r\nif (isset($jump_aid))\r\n{\r\n  header(\'Location:\'.rex_getUrl($jump_aid));\r\n  exit;\r\n}\r\n\r\n?>',0,'admin','admin',1370873443,1370873443,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (9,'','1013 - COM-Template - Permission/Rechte','<?php\r\n/*\r\n   	 0  Standard   	Zugriff f&#x00b8;r alle \r\n  	-1 	Zugriff f&#x00b8;r nicht eingeloggte User  \r\n  	 1 	Zugriff f&#x00b8;r eingeloggte User  \r\n  	 2 	Zugriff f&#x00b8;r eingeloggte Moderatoren und Admins\r\n  	 3 	Zugriff f&#x00b8;r eingeloggte Admins\r\n*/\r\nfunction rex_com_checkUserPerm($type,$group = \"\")\r\n{\r\n	global $REX;\r\n	if ($type == \"\") return true; // Zugriff f&#x00b8;r alle \r\n	if ($type == \"0\") return true; // Zugriff f&#x00b8;r alle \r\n  \r\n	if (isset($REX[\'COM_USER\']) AND is_object($REX[\'COM_USER\']))\r\n	{\r\n		if ($type == \"1\") return true; // Zugriff f&#x00b8;r eingeloggte User\r\n		if ($type == \"2\" AND ($REX[\'COM_USER\']->getValue(\"admin\")==1 || $REX[\'COM_USER\']->getValue(\"moderator\")==1)) return true;\r\n		if ($type == \"3\" AND $REX[\'COM_USER\']->getValue(\"admin\")==1) return true;\r\n	}\r\n	if(!isset($REX[\'COM_USER\']) || !is_object($REX[\'COM_USER\']))\r\n	{\r\n		if ($type == \"-1\") return true; // Zugriff f&#x00b8;r nicht eingeloggte User \r\n	} \r\n	return false;\r\n}\r\n	\r\n?>',0,'admin','admin',1370873391,1370873391,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (10,'','1014 - COM-Template - Userloginfenster','<?php\r\n// ********************************************************* LOGIN\r\n$login = \'\';\r\n$status = \'\';\r\n$now = time();\r\n$gab = 60*60;\r\n$ti = $now-$gab;\r\n// User sind online\r\n$gu = new rex_sql;\r\n$gu->setQuery(\'select * from rex_com_user where last_xs>\'.$ti.\' and online_status=1\');\r\n$user_online = $gu->getRows();\r\nif ($user_online == 0) $user_online_text = \'Kein Benutzer ist online\'; \r\nelseif ($user_online < 2) $user_online_text = \'Ein Benutzer ist online\';\r\nelse $user_online_text = $user_online.\' Benutzer sind online\';\r\n$users_online = \"\";\r\n$users_online = \'<ul class=\"com-usr-list\">\';\r\nfor($i=0;$i<$gu->getRows();$i++)\r\n{\r\n  //if ($users_online != \"\") $users_online .= \' + \';\r\n  $users_online .= \'<li>\'.rex_com_showUser($gu, \"login\", \"\", TRUE).\'</li>\';\r\n  $gu->next();\r\n}\r\nif ($gu->getRows()==0) $users_online .= \'<li>Kein User ist online</li>\';\r\n$users_online .= \'</ul>\';\r\nif (isset($REX[\'COM_USER\']) && is_object($REX[\'COM_USER\']))\r\n{\r\n	$status = \'Login\';\r\n\r\n	$gu->setQuery(\'select count(id) from rex_com_contact where user_id=\'.$REX[\'COM_USER\']->getValue(\'id\').\' and accepted=1\');\r\n	// $gu->debugsql = 1;\r\n	$user_contacts = $gu->getValue(\"count(id)\");\r\n	$gu->setQuery(\'select count(id) from rex_com_contact where user_id=\'.$REX[\'COM_USER\']->getValue(\'id\').\' and accepted=0 and requested=0\');\r\n	$user_contact_requests = $gu->getValue(\"count(id)\");\r\n	$login .= \'<div id=\"com-user-box\">\';\r\n	$login .= \'<h4>User</h4>\';\r\n	$login .= \'<p>Sie sind eingeloggt als:<br /> <strong>\'.$REX[\'COM_USER\']->getValue(\'login\').\'</strong></p>\';\r\n	$login .= \'<p><strong>\'.$REX[\'COM_USER\']->getValue(\'login\').\'</strong></p>\';\r\n	$login .= \'<ul>\r\n					<li><a class=\"icon icon-myprfl\" href=\"\'.rex_getUrl(3).\'\"><span>Mein Profil</span></a></li>\r\n					<li><a class=\"icon icon-lgt\" href=\"\'.rex_getUrl($logout_aid,\'\',array(\'logout\'=>1)).\'\"><span>Logout</span></a></li>\r\n				</ul>\r\n			\';\r\n	\r\n	//$login .= \'<p><br /><a href=\"\'.rex_getUrl(REX_COM_PAGE_MYPROFIL_ID).\'\">&amp;raquo; Mein Profil</a></p>\';\r\n	//$login .= \'<p class=\"logout\"><a href=\"\'.rex_getUrl($logout_aid,\'\',array(\'logout\'=>1)).\'\">&amp;raquo; Logout</a></p>\';\r\n	\r\n	$login .= \'<div class=\"splt\"></div>\';\r\n	$login .= \'<ul>\';\r\n	$login .= \'<li>\'.$user_online_text.\'</li>\';\r\n	if ($user_contacts == 1) $login .= \'<li>Sie haben einen Kontakt</li>\';\r\n	elseif ($user_contacts == 0) $login .= \'<li>Sie haben keinen Kontakt</li>\';\r\n	else $login .= \'<li>Sie haben \'.$user_contacts.\' Kontakte</li>\';\r\n	if ($user_contact_requests == 1) $login .= \'<li>Sie haben eine Kontaktanfrage</li>\';\r\n	elseif ($user_contact_requests == 0) $login .= \'<li>Sie haben keine Kontaktanfrage</li>\';\r\n	else $login .= \'<li>Sie haben \'.$user_contact_requests.\' Kontaktanfragen</li>\';\r\n	// $login .= \'<li>Aktivit&#x2030;t: \'.$REX[\'COM_USER\']->getValue(\'activity\').\'%</li>\';\r\n	$login .= \'</ul>\';\r\n	\r\n	$login .= \'<div class=\"splt\"></div>\';\r\n	$login .= \'<h4>Folgende User sind online:</h4>\'.$users_online;\r\n	$login .= \'</div>\';\r\n}else\r\n{\r\n	$status = \'Logout\';\r\n	$login .= \'<div id=\"com-user-box\">\';\r\n	$login .= \'<h4>Login</h4>\';\r\n	$login .= \'<form action=\"index.php\" method=\"post\">\r\n				<input type=\"hidden\" name=\"article_id\" value=\"\'.\'23\'.\'\" />\r\n					<fieldset>\r\n					<p class=\"formtext\">\r\n						<label for=\"name\" class=\"hidden\">Benutzername:</label>\r\n						<input type=\"text\" id=\"name\" name=\"login_name\" value=\"Benutzername...\" onblur=\"if(this.value == \\\'\\\') this.value=\\\'Benutzername...\\\'\" onfocus=\"if(this.value == \\\'Benutzername...\\\') this.value=\\\'\\\'\" />\r\n					</p>\r\n					<p class=\"formtext\">\r\n						<label for=\"password\" class=\"hidden\">Passwort:</label>\r\n						<input type=\"password\" id=\"password\" name=\"login_psw\" value=\"Passwort...\" onblur=\"if(this.value == \\\'\\\') this.value=\\\'Passwort...\\\'\" onfocus=\"if(this.value == \\\'Passwort...\\\') this.value=\\\'\\\'\" />\r\n					</p>\r\n					<!-- <p class=\"formcheckbox\">\r\n						<input type=\"checkbox\" id=\"loginsave\" name=\"login_save\" />\r\n						<label for=\"loginsave\">Login speichern</label>\r\n					</p>-->\r\n					<p class=\"formsubmit\">\r\n						<input class=\"submit\" type=\"submit\" value=\"Login\" title=\"Anmeldung durchf&#x00b8;hren\" />\r\n					</p>\r\n					</fieldset>\r\n				</form>\r\n				\r\n				<ul>\r\n					<li><a class=\"icon icon-rgstr\" href=\"\'.rex_getUrl(24).\'\"><span>Registrieren ?</span></a></li>\r\n					<li><a class=\"icon icon-psswd-frgttn\" href=\"\'.rex_getUrl(25).\'\"><span>Passwort ?</span></a></li>\r\n				</ul>\r\n				\r\n				<div class=\"splt\"></div>\r\n				\r\n				<h4>Folgende User sind online:</h4>\r\n				\'.$users_online.\'\r\n			\';\r\n	$login .= \'</div>\';\r\n\r\n} \r\necho \'<div class=\"bx-v1 bx-shdw\"><div class=\"bx-v1-2 bx-shdw-2\"><div class=\"bx-v1-cntnt\"><h3><strong>Status</strong> / \'.$status.\'</h3>\'.$login.\'</div></div></div>\';\r\n?>',0,'admin','admin',1370872697,1371855534,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (15,'','1018 - COM-Template - Yakamara Adsense','',0,'admin','admin',1370874563,1370874563,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (12,'','1015 - COM-Template - Navigation mit 3 Ebenen','<?php\r\n// EXPLODE PATH\r\n$PATH = explode(\"|\",$this->getValue(\"path\").$this->getValue(\"article_id\").\"|\");\r\n// GET CURRENTS\r\n$path1 = $PATH[1];\r\n$path2 = $PATH[2];\r\n$path3 = $PATH[3];\r\n$catsArr = array();\r\n$nav = \'\';\r\n$c1 = 0;\r\n$lev1Cats = OOCategory::getRootCategories(true);\r\nforeach ($lev1Cats as $lev1) {\r\n	\r\n	if (rex_com_checkUserPerm($lev1->getValue(\"art_com_perm\"))) {\r\n				\r\n		if ($lev1->getId() == $path1)\r\n			$nav .= \'<li><a class=\"active\" href=\"\'.rex_getUrl($lev1->getId()).\'\"><span>\'.strtoupper($lev1->getName()).\'</span></a>\';\r\n		else\r\n			$nav .= \'<li><a href=\"\'.rex_getUrl($lev1->getId()).\'\"><span>\'.strtoupper($lev1->getName()).\'</span></a>\';\r\n		\r\n		\r\n		$lev2Cats = $lev1->getChildren(true);\r\n		\r\n		$nav2 = \'\';\r\n		if ($lev1->getId() == $path1 AND sizeof($lev2Cats) != 0) {\r\n			foreach ($lev2Cats as $lev2) {\r\n				if (rex_com_checkUserPerm($lev2->getValue(\"art_com_perm\"))) {\r\n					if ($lev2->getId() == $path2)\r\n						$nav2 .= \'<li><a class=\"active\" href=\"\'.rex_getUrl($lev2->getId()).\'\"><span>\'.strtoupper($lev2->getName()).\'</span></a>\';\r\n					else\r\n						$nav2 .= \'<li><a href=\"\'.rex_getUrl($lev2->getId()).\'\"><span>\'.strtoupper($lev2->getName()).\'</span></a>\';\r\n					\r\n					\r\n					$lev3Cats = $lev2->getChildren(true);\r\n			\r\n					$nav3 = \'\';\r\n					if ($lev2->getId() == $path2 AND sizeof($lev3Cats) != 0) {\r\n						foreach ($lev3Cats as $lev3) {\r\n							if (rex_com_checkUserPerm($lev3->getValue(\"art_com_perm\"))) {\r\n							\r\n								if ($lev3->getId() == $path3)\r\n									$nav3 .= \'<li><a class=\"active\" href=\"\'.rex_getUrl($lev3->getId()).\'\"><span>\'.strtoupper($lev3->getName()).\'</span></a></li>\';\r\n								else\r\n									$nav3 .= \'<li><a href=\"\'.rex_getUrl($lev3->getId()).\'\"><span>\'.strtoupper($lev3->getName()).\'</span></a></li>\';\r\n							}\r\n						}\r\n					}\r\n					if ($nav3 != \'\')\r\n						$nav2 .= \'<ul>\'.$nav3.\'</ul>\';\r\n					$nav2 .= \'</li>\';\r\n				}\r\n			}\r\n		}\r\n		if ($nav2 != \'\')\r\n			$nav .= \'<ul>\'.$nav2.\'</ul>\';\r\n		$nav .= \'</li>\';\r\n	}\r\n}\r\nprint \'<ul>\'.$nav.\'</ul>\';\r\n?>',0,'admin','admin',1212572403,1212184378,'a:1:{s:5:\"ctype\";a:0:{}}',0),
  (13,'','1016 - COM-Template - Navigation - Userbereiche 1 Ebene','<?php\r\n// Navigation f&#x00b8;r Usercategorien\r\n// BItte die Kategorie eintragen, die die Kategorien wie \"Mein Profil\", \"Meine Kontakte\" etc enth&#x2030;llt.\r\n$cat_id = REX_COM_USERCAT_ID;\r\n// EXPLODE PATH\r\n$PATH = explode(\"|\",$this->getValue(\"path\").$this->getValue(\"article_id\").\"|\");\r\n$cats = OOCategory::getChildrenById($cat_id, true);\r\n$catsArr = array();\r\nforeach ($cats as $lev1) {\r\n	if (rex_com_checkUserPerm($lev1->getValue(\"art_com_perm\")))		\r\n		$catsArr[$lev1->getId()][\'name\'] = $lev1->getName();\r\n}\r\n$c1 = 0;\r\n$nav = \'<ul>\';\r\nif (is_array($catsArr) AND sizeof($catsArr) != 0) \r\n{\r\n	foreach ($catsArr AS $lev1Id => $value) \r\n	{\r\n		$c1++;\r\n		$cl1 = \'\';\r\n		\r\n		if ($c1 == 1)\r\n			$cl1 = \' class=\"li-frst\"\';\r\n		elseif ($c1 == count($catsArr))\r\n			$cl1 = \' class=\"li-lst\"\';\r\n		\r\n		if (count($catsArr) == 1)\r\n			$cl1 = \' class=\"li-aln\"\';\r\n			\r\n		if ($lev1Id == $PATH[2])\r\n			$nav .= \'<li\'.$cl1.\'><a class=\"active\" href=\"\'.rex_getUrl($lev1Id).\'\"><span>\'.strtoupper($value[\'name\']).\'</span></a></li>\';\r\n		else\r\n			$nav .= \'<li\'.$cl1.\'><a href=\"\'.rex_getUrl($lev1Id).\'\"><span>\'.strtoupper($value[\'name\']).\'</span></a></li>\';\r\n		\r\n	}\r\n}\r\nif (isset($REX[\'COM_USER\']) AND is_object($REX[\'COM_USER\'])) \r\n{\r\n	$nav .= \'<li class=\"li-aln\"><a href=\"\'.rex_getUrl(\'\', \'\', array(\'logout\'=>1)).\'\"><span>LOGOUT</span></a></li>\';\r\n}else \r\n{\r\n	$cl1_a =\'\';\r\n	if ($this->getValue(\'article_id\') == REX_COM_PAGE_LOGIN_ID)\r\n		$cl1_a = \' class=\"active\"\';\r\n	$nav .= \'<li class=\"li-aln\"><a\'.$cl1_a.\' href=\"\'.rex_getUrl(REX_COM_PAGE_LOGIN_ID).\'\"><span>LOGIN</span></a></li>\';\r\n}\r\n$nav .= \'</ul>\';\r\nprint $nav;\r\n?>',0,'admin','admin',1370872734,1370872734,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0),
  (14,'','1017 - COM-Template - Breadcrumb','<?php\r\n/*	Breadcrumb Navi	*************************************/\r\n$aid = $this->getValue(\'article_id\');\r\n$navi_brdcrmb = \'\';\r\n$article = OOArticle :: getArticleById($aid);\r\n$article_tree = $article->getParentTree();\r\nif (!$article->isStartpage()) {\r\n	$article_tree[] = $article;\r\n}\r\nif (is_array($article_tree)) {\r\n	$navi_brdcrmb .= \'<div class=\"com-path\"><p>Sie befinden sich hier: \';\r\n	\r\n	if ($aid != $REX[\'START_ARTICLE_ID\']) {\r\n		$navi_brdcrmb .= \'<a href=\"\'.rex_getUrl($REX[\'START_ARTICLE_ID\']).\'\">Home</a> &raquo; \';\r\n	}\r\n	\r\n	foreach ($article_tree as $article) {\r\n				\r\n		if ($article->hasTemplate() AND $article->isOnline()) {\r\n			if ($article->getId() == $aid) {\r\n				$navi_brdcrmb .= \'<span><a href=\"\'.$article->getUrl().\'\">\'.$article->_name.\'</a></span>\';\r\n			}\r\n			else {\r\n				$navi_brdcrmb .= \'<a href=\"\'.$article->getUrl().\'\">\'.$article->_name.\'</a> &raquo; \';\r\n			}\r\n		}\r\n	}\r\n	\r\n	if (substr($navi_brdcrmb, -9, 9) == \' &raquo; \')\r\n		$navi_brdcrmb = substr($navi_brdcrmb, 0, -9);\r\n	\r\n	$navi_brdcrmb .= \'</p></div>\';\r\n	\r\n	print $navi_brdcrmb;\r\n}\r\n?>',0,'admin','admin',1370872773,1372007646,'a:3:{s:10:\"categories\";a:1:{s:3:\"all\";s:1:\"1\";}s:5:\"ctype\";a:0:{}s:7:\"modules\";a:1:{i:1;a:1:{s:3:\"all\";s:1:\"1\";}}}',0);
/*!40000 ALTER TABLE `rex_template` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_xform_email_template`;
CREATE TABLE `rex_xform_email_template` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `mail_from` varchar(255) NOT NULL,
  `mail_from_name` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `body` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_xform_email_template` WRITE;
/*!40000 ALTER TABLE `rex_xform_email_template` DISABLE KEYS */;
INSERT INTO `rex_xform_email_template` VALUES 
  (1,'register','info@redaxo.org','info@redaxo.org','Community: Bitte best&#x2030;tigen Sie die Registrierung','Guten Tag ###firstname### ###name###,\r\nIhre Registrierung zur Community war erfolgreich. \r\nBitte klicken Sie auf diesen Link, um Ihre E-Mail zu best&#x2030;tigen.\r\nhttp://redaxo.de/index.php?article_id=26&amp;clang=0&amp;uid=###ID###&amp;activation_key=###activation_key###&amp;login=###login###\r\nIhr Logindaten (bitte abspeichern):\r\n- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -\r\nWebsite: redaxo.de\r\nBenutzername: ###login###\r\nPasswort: ###password###\r\nE-Mail: ###email###\r\nVorname: ###firstname###\r\nNachname: ###name###\r\nBei Schwierigkeiten oder f&#x00b8;r Anregungen k&#x02c6;nnen Sie uns gerne eine E-Mail an info@redaxo.org schicken. \r\nWir freuen uns, Sie in unserer Community dabei zu haben!\r\nIhr Team\r\n'),
  (2,'send_password','info@redaxo.org','info@redaxo.org','Community: Neues Passwort','Guten Tag ###firstname### ###name###,\r\nF&#x00b8;r Ihren Zugang in die Community verwenden Sie bitte folgendes Passwort:\r\nPasswort: ###password###\r\nHerzliche Gr&#x00b8;&#xfb02;e,\r\nIhr Team\r\n'),
  (3,'sendemail_contactrequest','info@redaxo.org','info@redaxo.org','Community: Neue Kontaktanfrage','Guten Tag ###firstname### ###name###,\r\nein Mitglied der Community m&#x02c6;chte Sie als Kontakt hinzuf&#x00b8;gen. Best&#x2030;tigen Sie die Kontaktanfrage unter http://redaxo.de/ .\r\nHerzliche Gr&#x00b8;&#xfb02;e,\r\nIhr Team'),
  (4,'sendemail_guestbook','info@redaxo.org','info@redaxo.org','Community: Neuer Eintrag in Ihr G&#x2030;stebuch','Guten Tag ###firstname### ###name###,\r\nein Mitglied der Community hat einen Eintrag in Ihrem G&#x2030;stebuch hinterlassen. Um diesen einzusehen, loggen Sie sich unter http://redaxo.de/ ein.\r\nHerzliche Gr&#x00b8;&#xfb02;e,\r\nIhr Team'),
  (5,'sendemail_newmessage','info@redaxo.org','info@redaxo.org','Community: Neue private Nachricht','Guten Tag ###firstname### ###name###,\r\nein Mitglied der Community hat Ihnen eine Nachricht geschrieben. Loggen Sie sich unter http://redaxo.de/ ein, um diese zu lesen und zu beantworten.\r\nHerzliche Gr&#x00b8;&#xfb02;e,\r\nIhr Team');
/*!40000 ALTER TABLE `rex_xform_email_template` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_xform_field`;
CREATE TABLE `rex_xform_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `table_name` varchar(100) NOT NULL,
  `prio` int(11) NOT NULL,
  `type_id` varchar(100) NOT NULL,
  `type_name` varchar(100) NOT NULL,
  `f1` text NOT NULL,
  `f2` text NOT NULL,
  `f3` text NOT NULL,
  `f4` text NOT NULL,
  `f5` text NOT NULL,
  `f6` text NOT NULL,
  `f7` text NOT NULL,
  `f8` text NOT NULL,
  `f9` text NOT NULL,
  `list_hidden` tinyint(4) NOT NULL,
  `search` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_xform_field` WRITE;
/*!40000 ALTER TABLE `rex_xform_field` DISABLE KEYS */;
INSERT INTO `rex_xform_field` VALUES 
  (1,'rex_com_user',5,'value','text','login','translate:login','','0','','','','','',0,1),
  (2,'rex_com_user',6,'validate','empty','login','translate:com_please_enter_login','','','','','','','',1,0),
  (3,'rex_com_user',7,'validate','unique','login','translate:com_this_login_exists_already','rex_com_user','','','','','','',1,0),
  (4,'rex_com_user',8,'value','text','password','translate:password','','0','','','','','',1,1),
  (5,'rex_com_user',9,'validate','empty','password','translate:com_please_enter_password','','','','','','','',1,0),
  (6,'rex_com_user',10,'value','text','email','translate:email','','0','','','','','',0,1),
  (7,'rex_com_user',11,'validate','empty','email','translate:com_please_enter_email','','','','','','','',1,0),
  (8,'rex_com_user',12,'validate','email','email','translate:com_please_enter_email','','','','','','','',1,0),
  (9,'rex_com_user',13,'validate','unique','email','translate:com_this_email_exists_already','','','','','','','',1,0),
  (10,'rex_com_user',14,'value','select','status','translate:status','translate:com_account_requested=0,translate:com_account_active=1,translate:com_account_inactive=-1','0','-1','0','','','',0,1),
  (11,'rex_com_user',15,'value','text','firstname','translate:firstname','','0','','','','','',0,1),
  (12,'rex_com_user',16,'value','text','name','translate:name','','0','','','','','',0,1),
  (13,'rex_com_user',17,'value','text','activation_key','translate:activation_key','','0','','','','','',1,1),
  (14,'rex_com_user',18,'value','text','session_key','translate:session_key','','0','','','','','',1,1),
  (15,'rex_com_user',19,'value','datestamp','last_action_time','U','0','1','','','','','',1,1),
  (16,'rex_hardy',3,'value','checkbox','test','testbox','','0','','','','','',1,1),
  (17,'rex_hardy',2,'value','text','testf','text','','','','','','','',0,1),
  (18,'rex_hardy',1,'value','mediafile','media','','','','0','','','','',0,1),
  (64,'rex_com_contact',2,'value','text','accepted','','','','','','','','',1,1),
  (65,'rex_com_contact',1,'value','datestamp','create_datetime','create_datetime','','0','','','','','',1,1),
  (61,'rex_com_contact',5,'value','text','user_id','user_id','','','','','','','',1,1),
  (62,'rex_com_contact',4,'value','text','to_user_id','to_user_id','','','','','','','',1,1),
  (22,'rex_com_group',1,'value','text','name','translate:name','','0','','','','','',0,0),
  (23,'rex_com_group',2,'validate','empty','name','translate:com_group_xform_enter_name','','','','','','','',1,0),
  (24,'rex_com_user',23,'value','be_manager_relation','rex_com_group','translate:com_group_name','rex_com_group','name','1','1','','','',1,0),
  (75,'rex_com_user',55,'value','com_auth_password_hash','password_hash','password','','','','','','','',1,0),
  (26,'rex_com_user',21,'value','text','authsource','translate:com_auth_authsource','','','','','','','',1,0),
  (27,'rex_com_user',22,'value','text','facebookid','translate:com_auth_facebook_facebookid','','','','','','','',1,0),
  (31,'rex_com_comment',90,'value','text','ckey','translate:com_comment_ckey','','','','','','','',0,1),
  (32,'rex_com_comment',190,'value','index','ukey','email,user_id,name,comment,ckey,www','','sha1','','','','','',1,0),
  (33,'rex_com_comment',110,'value','checkbox','info_email','translate:com_comment_infomail','','0','','','','','',1,1),
  (34,'rex_com_comment',80,'value','checkbox','status','translate:status','','0','','','','','',1,1),
  (35,'rex_com_comment',70,'value','datestamp','update_datetime','mysql','','0','','','','','',0,0),
  (36,'rex_com_comment',60,'value','datestamp','create_datetime','mysql','','1','','','','','',1,0),
  (37,'rex_com_comment',50,'value','be_manager_relation','user_id','translate:com_user','rex_com_user','name','0','1','','','',0,1),
  (38,'rex_com_comment',40,'value','text','name','translate:name','','','','','','','',0,1),
  (39,'rex_com_comment',30,'value','text','email','translate:email','','','','','','','',0,1),
  (40,'rex_com_comment',35,'validate','type','email','email','translate:com_comment_enteremail','0','','','','','',1,0),
  (41,'rex_com_comment',20,'validate','empty','comment','translate:com_comment_enter_comment','','','','','','','',1,0),
  (42,'rex_com_comment',10,'value','textarea','comment','translate:com_comment_name','','','','','','','',1,1),
  (43,'rex_com_comment',45,'validate','empty','name','translate:com_comment_enter_name','','','','','','','',1,0),
  (44,'rex_com_comment',55,'value','text','www','translate:com_comment_www','','','','','','','',1,1),
  (45,'rex_com_comment',130,'value','be_manager_relation','reply_to','translate:com_comment_replyto','rex_com_comment','ckey','0','1','','','',1,1),
  (46,'rex_com_comment',200,'validate','unique','ukey','translate:com_comment_enter_exists','','','','','','','',1,0),
  (60,'rex_com_user',24,'value','be_manager_relation','rex_com_board','translate:com_board_name','rex_com_board','name','1','1','','','',1,0),
  (55,'rex_com_board',4,'value','text','name','translate:name','','0','','','','','',0,0),
  (56,'rex_com_board',5,'validate','empty','name','translate:com_board_xform_enter_name','','','','','','','',1,0),
  (63,'rex_com_contact',3,'value','text','requested','requested','','','','','','','',1,1),
  (57,'rex_com_user',30,'value','be_manager_relation','rex_com_board','translate:com_board_name','rex_com_board','name','1','1','','','',1,0),
  (66,'rex_com_user',25,'value','select','gender','Gender','Frau,Mann,Keine Angabe','','','0','','','',1,1),
  (67,'rex_com_user',4,'value','mediafile','image','Bild','','','0','','','3','community',1,1),
  (68,'rex_com_user',3,'value','checkbox','admin','Admin?','0,1','0','','','','','',1,1),
  (69,'rex_com_user',2,'value','text','city','Stadt','','','','','','','',1,1),
  (70,'rex_com_user',1,'value','textarea','motto','Motto','','','','','','','',1,1),
  (71,'rex_com_user',26,'value','text','sendemail_newletter','sendemail_newletter','','','','','','','',1,1),
  (72,'rex_com_user',29,'value','text','show_basisinfo','show_basisinfo','','','','','','','',1,1),
  (73,'rex_com_user',28,'value','select','show_contactinfo','Show Contactinfo?','0,1','','0','0','','','',1,1),
  (74,'rex_com_user',27,'value','select','show_personalinfo','Show Personalinfo?','0,1','','0','0','','','',1,1),
  (76,'rex_com_board',3,'value','text','board_id','board_id','','','','','','','',1,1),
  (77,'rex_com_board',2,'value','text','re_message_id','re_message_id','','','','','','','',1,1),
  (78,'rex_com_board',1,'value','text','message_id','ID','','','','','','','',1,1);
/*!40000 ALTER TABLE `rex_xform_field` ENABLE KEYS */;
UNLOCK TABLES;

DROP TABLE IF EXISTS `rex_xform_relation`;
CREATE TABLE `rex_xform_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `source_table` varchar(100) NOT NULL,
  `source_name` varchar(100) NOT NULL,
  `source_id` int(11) NOT NULL,
  `target_table` varchar(100) NOT NULL,
  `target_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
DROP TABLE IF EXISTS `rex_xform_table`;
CREATE TABLE `rex_xform_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` tinyint(4) NOT NULL,
  `table_name` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `list_amount` tinyint(3) unsigned NOT NULL DEFAULT '50',
  `prio` int(11) NOT NULL,
  `search` tinyint(4) NOT NULL,
  `hidden` tinyint(4) NOT NULL,
  `export` tinyint(4) NOT NULL,
  `import` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_name` (`table_name`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

LOCK TABLES `rex_xform_table` WRITE;
/*!40000 ALTER TABLE `rex_xform_table` DISABLE KEYS */;
INSERT INTO `rex_xform_table` VALUES 
  (1,1,'rex_com_user','translate:com_user','communityuser',100,100,1,0,1,1),
  (10,1,'rex_com_contact','Comunity Kontakte','',50,1,1,0,1,1),
  (4,1,'rex_com_group','translate:com_group_name','',50,110,0,0,0,0),
  (6,1,'rex_com_comment','translate:com_comment','',50,120,1,0,0,0),
  (9,1,'rex_com_board','Community Board / Forum','',50,110,1,0,1,1);
/*!40000 ALTER TABLE `rex_xform_table` ENABLE KEYS */;
UNLOCK TABLES;

