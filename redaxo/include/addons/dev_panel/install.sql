DROP TABLE IF EXISTS `rex_919_panel_items`;
CREATE TABLE `rex_919_panel_items` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `prio` tinyint(3) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT '0',
  `rex_redaxo` tinyint(1) NOT NULL DEFAULT '3',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `name` varchar(32) NOT NULL,
  `code` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

INSERT INTO `rex_919_panel_items` VALUES(1, 2, 1, 3, 2, '$_REQUEST', '');
INSERT INTO `rex_919_panel_items` VALUES(2, 3, 1, 3, 2, '$_POST', '');
INSERT INTO `rex_919_panel_items` VALUES(3, 4, 1, 3, 2, '$_GET', '');
INSERT INTO `rex_919_panel_items` VALUES(4, 5, 1, 3, 2, '$_SESSION', '');
INSERT INTO `rex_919_panel_items` VALUES(5, 6, 1, 3, 2, '$_FILES', '');
INSERT INTO `rex_919_panel_items` VALUES(6, 7, 1, 3, 2, '$_COOKIE', '');
INSERT INTO `rex_919_panel_items` VALUES(7, 8, 1, 3, 2, '$_SERVER', '');
INSERT INTO `rex_919_panel_items` VALUES(8, 9, 0, 1, 1, 'REXSEO Meta', '<?php\r\nif(OOAddon::isAvailable(''rexseo''))\r\n{\r\n  $ooa = OOArticle::getArticleById($REX[''ARTICLE_ID''],$REX[''CUR_CLANG'']);\r\n  echo ''\r\n  <style type="text/css">\r\n    td.key {font-weight:bold;text-align:right;padding:1px 4px 1px 0;}\r\n    td.value {color:white;}\r\n  </style>\r\n  <table>\r\n  <tr>\r\n    <td class="key">RexSEO::title():</td><td class="value">''.RexSEO::title().''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">RexSEO::keywords():</td><td class="value">''.RexSEO::keywords().''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">RexSEO::description():</td><td class="value">''.RexSEO::description().''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">RexSEO::canonical():</td><td class="value">''.RexSEO::canonical().''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">art_rexseo_title:</td><td class="value">''.$ooa->getValue(''art_rexseo_title'').''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">art_rexseo_canonicalurl:</td><td class="value">''.$ooa->getValue(''art_rexseo_canonicalurl'').''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">name:</td><td class="value">''.$ooa->getValue(''name'').''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">art_keywords:</td><td class="value">''.$ooa->getValue(''art_keywords'').''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">art_description:</td><td class="value">''.$ooa->getValue(''art_description'').''</td>\r\n  </tr>\r\n  <tr>\r\n    <td class="key">install_subdir:</td><td class="value">''.$REX[''ADDON''][''rexseo''][''settings''][''install_subdir''].''</td>\r\n  </tr>\r\n  </table>\r\n  '';\r\n}\r\n?>');
INSERT INTO `rex_919_panel_items` VALUES(9, 10, 0, 3, 1, 'PHP Info', '<style type="text/css">\r\n#php-info {padding-left:10px;}\r\n#php-info h2,\r\n#php-info h2 a {color:yellow !important;}\r\n#php-info h2:before {content:"\\2022";margin-right:10px;color:white;}\r\n#php-info img {display:none;}\r\n#php-info table {width:99%;}\r\n#php-info table th {text-align:left;color:white;}\r\n</style>\r\n<div id="php-info">\r\n<?php\r\nob_start();\r\nphpinfo();\r\n$info = ob_get_contents();\r\nob_end_clean();\r\n$info = preg_replace(''%^.*<body>(.*)</body>.*$%ms'', ''$1'', $info);\r\n$info = str_replace(''<h2>Environment</h2>'', ''<h2><a name="env">Environment</a></h2>'', $info);\r\n$info = str_replace(''<h2>PHP Variables</h2>'', ''<h2><a name="phpvar">PHP Variables</a></h2>'', $info);\r\n$info = str_replace(''<h2>PHP Core</h2>'', ''<h2><a name="phpcore">PHP Core</a></h2>'', $info);\r\necho $info;\r\n?>\r\n</div>');
INSERT INTO `rex_919_panel_items` VALUES(10, 1, 1, 1, 0, 'REX ARTICLE', '<?php\r\n$langswitch = $sep = '''';\r\nforeach($REX[''CLANG''] as $cid => $cname)\r\n{\r\n  if($cid == $REX[''CUR_CLANG'']){\r\n    $langswitch .= $sep.''[<em>''.$cid.''</em>] (''.$cname.'')'';\r\n  }else{\r\n    $langswitch .= $sep.''<a href="''.rex_getUrl($REX[''ARTICLE_ID''],$cid).''">[''.$cid.''] (''.$cname.'')</a>'';\r\n  }\r\n  $sep = '' , '';\r\n}\r\necho ''<h2 style="padding-bottom:4px;">ARTICLE_ID: [<em>''.$REX[''ARTICLE_ID''].''</em>] CLANG: ''.$langswitch.''</h2>'';\r\n?>');
