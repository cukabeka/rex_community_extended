<?php

/**
 * Community - board
 * @author jan.kristinus[at]redaxo[dot]de Jan Kristinus
 * @author <a href="http://www.yakamara.de">www.yakamara.de</a>
 */

$REX['ADDON']['install']['board'] = 1;

## Wegen Bug erst ab REX5 nutzbar 
//a62_add_field($title,							$name,					$prior,	$attributes, 			$type, 	$default, 	$params = null,																															$validate = null,	$restrictions = '')
//a62_add_field('translate:com_board_perm', 	'art_com_boardtype', 	100,	'',						3,		'',			'0:translate:com_board_forallboards|1:translate:com_board_inallboards|2:translate:com_board_inoneboard|3:translate:com_board_noboards',	'',					'');
//a62_add_field('translate:com_board_name', 	'art_com_boards', 		101, 	'multiple=multiple', 	3, 		'', 		'select name as label,id from rex_com_board order by label',																			'',					'');

// ----- Art der Gruppenrechte
$a = new rex_sql;
$a->setTable("rex_62_params");
$a->setValue("title","translate:com_board_perm");
$a->setValue("name","art_com_boardtype");
$a->setValue("prior","110");
$a->setValue("type","3");
$a->setValue("params","0:translate:com_board_forallboards|1:translate:com_board_inallboards|2:translate:com_board_inoneboard|3:translate:com_board_noboards");
$a->setValue("validate",NULL);
$a->addGlobalCreateFields();
$g = new rex_sql;
$g->setQuery('select * from rex_62_params where name="art_com_boardtype"');
if ($g->getRows()==1) {
	$a->setWhere('name="art_com_boardtype"');
	$a->update();
}else {
	$a->insert();
}
$g = new rex_sql;
$g->setQuery('show columns from rex_article Like "art_com_boardtype"');
if ($g->getRows()==0)
{
	$a->setQuery("ALTER TABLE `rex_article` ADD `art_com_boardtype` VARCHAR( 255 ) NOT NULL");
}

// ----- Gruppen
$a = new rex_sql;
$a->setTable("rex_62_params");
$a->setValue("title","translate:com_board_name");
$a->setValue("name","art_com_boards");
$a->setValue("prior","111");
$a->setValue("type","3");
$a->setValue("attributes","multiple=multiple");
$a->setValue("params","select name as label,id from rex_com_board order by label");
$a->setValue("validate",NULL);
$a->addGlobalCreateFields();
$g = new rex_sql;
$g->setQuery('select * from rex_62_params where name="art_com_boards"');
if ($g->getRows()==1) {
	$a->setWhere('name="art_com_boards"');
	$a->update();
}else {
	$a->insert();
}
$g = new rex_sql;
$g->setQuery('show columns from rex_article Like "art_com_boards"');
if ($g->getRows()==0) {
	$a->setQuery("ALTER TABLE `rex_article` ADD `art_com_boards` VARCHAR( 255 ) NOT NULL");
}

## Prio neu sortieren // Metainfo
rex_organize_priorities($REX['TABLE_PREFIX']. '62_params', 'prior', 'name LIKE "art_%"', 'prior, updatedate', 'field_id');

$REX['ADDON']['installmsg']['board'] = ""; // $I18N->msg('community_board_install','2.8');

$info = rex_generateAll(); // quasi kill cache ..

function rex_com_board_install() {
	$r = new rex_xform_manager;
	$r->generateAll();
}
rex_register_extension('OUTPUT_FILTER', 'rex_com_board_install');



?>