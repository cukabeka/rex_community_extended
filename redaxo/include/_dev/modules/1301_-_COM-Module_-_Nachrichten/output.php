<?php
// ----- Meine Nachrichten
$tab = rex_request("tab","int","0");
$aid = rex_request("article_id","int","0");
if (isset($REX["COM_USER"]) AND is_object($REX["COM_USER"]))
{
	if ("REX_VALUE[1]" == "1")
	{
		// ***** outbox
		 // von mir an andere
		 // -> anderen user anzeigen
		$who = "from_user_id";
		$text = "Zu";
		$show = "to_user_id"; // diesen user anzeigen
	}else
	{
		// ***** inbox
		// an mich
		// -> user von anzeigen
		$who = "to_user_id"; // an mich
		$text = "Von";
		$show = "from_user_id"; // diesen user anzeigen
	}
	$user_id = $REX["COM_USER"]->getValue("id");
	
	if($_REQUEST['func'] == "delete")
	{
	
		$del_id = (int) $_REQUEST['del_id'];
		$delsql = new rex_sql();
		$delsql->setQuery("DELETE FROM `rex_com_message` WHERE (`user_id`='".$user_id."') AND `id`='".$del_id."'");	
		echo '<p class="warning">Nachricht wurde gel&#x02c6;scht.</p>';
	
	}
	
	$sql = "SELECT 
		* 
		FROM 
			rex_com_message, rex_com_user
		WHERE 
			rex_com_message.user_id=".$user_id ."
			AND rex_com_message.$who=".$user_id ."
			AND rex_com_message.$show=rex_com_user.id 
        ORDER BY 
        	rex_com_message.create_datetime DESC";

	$link = "index.php?article_id=$aid&amp;tab=$tab";
	$m = new rex_sql;
	// $m->debugsql = 1;
	$m->setQuery($sql);
	// Ergebnisse anzeigen
	for($i=0;$i<$m->getRows();$i++)
	{
		echo '
			<div class="com-contact">
				<div class="com-image">
					<p class="image">'.rex_com_showUser($m,"image","", TRUE, FALSE).'</p>
				</div>
				<div class="com-content">
					<p><span class="color-1">'.rex_com_showUser($m,"name","", TRUE).', '.rex_com_showUser(&amp;$m,"city","", FALSE).'</span><br />Erstellt am: <b>'.rex_formatter($m->getValue("create_datetime"),"datetime","timestamp").'</b></p>
					<p>
					Betreff: <b>'.htmlspecialchars($m->getValue("rex_com_message.subject")).'</b>
					<br />Nachricht: 
					<br /><b>'.nl2br(htmlspecialchars($m->getValue("rex_com_message.body"))).'</b></p>
					<p class="link-button"><a href="'.$link.'&amp;amp;func=delete&amp;del_id='.$m->getValue("rex_com_message.id").'"><span>L&#x02c6;schen</span></a></p>
				</div>
				<div class="clearer"> </div>
			</div>
		';
		$m->next();
	}

	if ($m->getRows()<1)
	{
		echo '<p class="nomessage">Es befinden sich derzeit keine aktuellen Nachrichten in Ihrer Nachrichtenbox.</p>';
	}
	echo '<div class="clearer"> </div>';
}
?>