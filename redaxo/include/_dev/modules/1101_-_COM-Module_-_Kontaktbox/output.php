<?php
// ***** KONTAKTE
$status = (int) "REX_VALUE[1]"; // 0=Bestaetigte/1=Unbestaetigte/2=Noch zu bestaetigen
$aid = rex_request("article_id","int");
if (isset($REX["COM_USER"]) AND is_object($REX["COM_USER"]))
{
	$user_id = $REX["COM_USER"]->getValue("rex_com_user.id");
	include $REX["INCLUDE_PATH"]."/addons/xform/classes/basic/class.rexform.inc.php";
	include $REX["INCLUDE_PATH"]."/addons/xform/classes/basic/class.rexlist.inc.php";
	include $REX["INCLUDE_PATH"]."/addons/xform/classes/basic/class.rexselect.inc.php";
	
	$filter = $_REQUEST["filter"];
	$add_sql = "";
	if ($filter != "")
	{
		$add_sql = ' AND rex_com_user.lastname LIKE "'.$filter.'%" ';
	}
	
	
	if ($status==0) $sql = '
		select 
			* 
		from 
			rex_com_contact,rex_com_user 
		where 
			rex_com_contact.to_user_id=rex_com_user.id 
			and rex_com_contact.user_id="'.$user_id.'" 
			and accepted=1 
			'.$add_sql;
	if ($status==1) $sql = '
		select 
			* 
		from 
			rex_com_contact,rex_com_user 
		where 
			rex_com_contact.to_user_id=rex_com_user.id and 
			rex_com_contact.user_id="'.$user_id.'" and 
			rex_com_contact.accepted=0 and 
			rex_com_contact.requested=1 
			'.$add_sql;
	if ($status==2) $sql = '
		select 
			* 
		from 
			rex_com_contact,rex_com_user 
		where 
			rex_com_contact.to_user_id=rex_com_user.id and 
			rex_com_contact.user_id="'.$user_id.'" and 
			rex_com_contact.accepted=0 and 
			rex_com_contact.requested=0
			'.$add_sql;
	
	$gl = new rex_sql;
	$gl->debugsql = 0;
	$gl->setQuery($sql);
	
	$max = $gl->getRows();
	$link = 'index.php?article_id='.$aid.'&amp;tab='.$status;
	// Alle | A-Z | Blaettern
	echo '
	<div class="com-navi"><p class="flLeft">&amp;nbsp;</p>
	<!--		<ul class="navi com-navi-letters">
				<li><a href="'.$link.'">Alle | </a></li>
				';
	
	for($i=65;$i<91;$i++)
	{
		echo '		<li><a href="'.$link.'&amp;amp;filter='.chr($i).'">'.chr($i).'</a></li>';
	}
	echo '
			</ul>
	-->
					'.rex_com_blaettern($gl).'
			<div class="clearer"> </div>
	</div>
	';

	// Ergebnisse anzeigen
	for($i=0;$i<$gl->getRows();$i++)
	{
		echo '
			<div class="com-contact">
				<div class="com-image">
					<p class="image">'.rex_com_showUser($gl,"image","", TRUE).'</p>
				</div>
				<div class="com-content">
				<div class="com-content-2">
					<p><span class="color-1">'.rex_com_showUser($gl,"name","", TRUE).', '.rex_com_showUser($gl,"city","", FALSE).'</span><br />Bestätigt am: '.rex_com_formatter($gl->getValue("create_datetime"),'date').'</p>
					';
if(rex_com_showUser($gl,"motto","", FALSE) != "") echo '<p>Motto: '.rex_com_showUser($gl,"motto","", FALSE).'</p>';
echo '
					<p class="link-button"><a href="'.rex_com_showUser($gl,"url").'"><span>Mehr Infos</span></a></p>
				</div></div>
				<div class="clearer"> </div>
			</div>
		';
		$gl->next();
	}
	echo '<div class="clearer"> </div>';
}
?>