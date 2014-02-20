<?php
	


// ------------------------------- Ist Modul schon vorhanden ?

$searchtext = 'module:com_comment_basic_out';

$gm = rex_sql::factory();
$gm->setQuery('select * from rex_module where ausgabe LIKE "%'.$searchtext.'%"');

$module_id = 0;
$module_name = "";
foreach($gm->getArray() as $module)
{
	$module_id = $module["id"];
	$module_name = $module["name"];
}

if (isset($_REQUEST["install"]) && $_REQUEST["install"]==1)
{

	$xform_module_name = "rex - comment";

	// Daten einlesen
	$in = rex_get_file_contents($REX["INCLUDE_PATH"]."/addons/community/plugins/comment/module/module_in.inc");
	$out = rex_get_file_contents($REX["INCLUDE_PATH"]."/addons/community/plugins/comment/module/module_out.inc");

	$mi = rex_sql::factory();
	// $mi->debugsql = 1;
	$mi->setTable("rex_module");
	$mi->setValue("eingabe",addslashes($in));
	$mi->setValue("ausgabe",addslashes($out));

	// altes Module aktualisieren
	if (isset($_REQUEST["module_id"]) && $module_id==$_REQUEST["module_id"])
	{
		$mi->setWhere('id="'.$module_id.'"');
		$mi->update();
		echo rex_info('Kommentarmodul "'.$module_name.'" wurde aktualisiert');

	}else
	{
		$mi->setValue("name",$xform_module_name);
		$mi->insert();
		$module_id = (int) $mi->getLastId();
		echo rex_info('Kommentarmodul wurde angelegt unter "'.$xform_module_name.'"');
		
	}

}

echo '

<div class="rex-addon-output">
	<h2 class="rex-hl2">'.$I18N->msg('com_comment_install_modul').'</h2>
	<div class="rex-addon-content">
	<p>'.$I18N->msg('com_comment_install_modul_description').'</p>
	<ul>
		<li><a href="index.php?page=community&amp;subpage=plugin.comment&amp;install=1">'.$I18N->msg('com_comment_install_comment_modul').'</a></li>';
		
		if ($module_id > 0) {
			echo '<li><a href="index.php?page=community&amp;subpage=plugin.comment&amp;install=1&amp;module_id='.$module_id.'">'.$I18N->msg('com_comment_update_following_modul',htmlspecialchars($module_name)).'</a></li>'; 
		}	

echo '
	</ul>	
	</div>
</div>';







?>