<div class="rex-com-articlecommentbox">
<?php
$ADMIN = FALSE;
if (isset($REX["COM_USER"]) AND is_object($REX["COM_USER"]))
{
	if ($REX["COM_USER"]->getValue("admin")==1) $ADMIN = TRUE; 
	if ($ADMIN AND isset($_REQUEST["delete_message"]) AND $_REQUEST["delete_message"]==1)
	{
		$msg_id = (int) $_REQUEST["msg_id"];
		$d = new rex_sql;
		$d->setQuery('update rex_com_comment set status=0 where article_id=REX_ARTICLE_ID AND id='.$msg_id);
	}
	$xform = new rex_xform;
	$xform->setDebug(FALSE);
	$form_data = '
html|<div class="com-tab com-tab-no-navi">
html|<div class="com-tab-cntnt">
html|<div class="com-tab-cntnt-2">
html|<div class="com-tab-cntnt-3">
html|<div id="rex-form">
html|<div class="spcl-bgcolor">
hidden|article_id|REX_ARTICLE_ID
hidden|status|1
com_user|user_id|id|Absender
textarea|comment|Kommentar
timestamp|create_datetime
validate|notEmpty|comment|Bitte gib einen Kommentar ein.
action|db|rex_com_comment
objparams|submit_btn_show|0
submit|submit|Abschicken|no_db
html|<div class="clearer"> </div>
html|</div>
html|</div>
html|</div>
html|</div>
html|</div>
html|</div>
	';
	
	$form_data = trim(str_replace("<br />","",rex_xform::unhtmlentities($form_data)));
	
	$xform->setFormData($form_data);
	$xform->setRedaxoVars(REX_ARTICLE_ID,REX_CLANG_ID); 
	$xform->setObjectparams("answertext","Vielen Dank für den Eintrag"); // Antworttext
	$xform->setObjectparams("main_table","rex_com_comment"); // für db speicherungen und unique abfragen
	
	// Aktion einstellen
	$xform->setObjectparams("form_type",-1); // form_typ
	$addcomment = $xform->getForm();
}else
{
	$addcomment = '<div class="nologin"><p>Sie sind nicht eingeloggt. Bitte melden Sie sich an, wenn Sie Kommentare schreiben wollen</p></div>';
}
// ***** SHOW MESSAGES
echo '
<div class="com-tab com-tab-no-navi">
<div class="com-tab-cntnt">
<div class="com-tab-cntnt-2">
<div class="com-tab-cntnt-3">';

$commentsql = new rex_sql();
$commentsql->debugsql = 0;
$commentsql->setQuery("SELECT * 
	FROM  rex_com_comment 
	LEFT JOIN rex_com_user ON rex_com_comment.user_id=rex_com_user.id 
	WHERE rex_com_comment.article_id=REX_ARTICLE_ID  and rex_com_comment.status=1
	ORDER BY rex_com_comment.create_datetime desc");
if($commentsql->getRows()<=0)
{
	echo '<p class="com-whitebox">Kein Kommentar vorhanden !</p>';
}else
{
	$cl = "";
	for($i=0;$i<$commentsql->getRows();$i++)
	{
		// $cl
		echo '
		<div class="com-comment">
			<div class="com-image">
				<p class="image">'.rex_com_showUser($commentsql,"image").'</p>
			</div>
			
			<div class="com-content-name">
				<p><span class="color-1">'.rex_com_showUser($commentsql,"name").'</span>
					<br />'.rex_com_formatter($commentsql->getValue("rex_com_comment.create_datetime"),'datetime').'
				</p>
			</div>
			<div class="com-content">
				<p><b>'.nl2br(htmlspecialchars($commentsql->getValue("rex_com_comment.comment"))).'</b></p>';
			
			if ($commentsql->getValue("rex_com_user.motto") != '')
				echo '<p>Motto: '.$commentsql->getValue("rex_com_user.motto").'</p>';
	
		if ($ADMIN)
		{
			$link_params = array_merge($params,array("article_id"=>REX_ARTICLE_ID,"delete_message"=>1,"msg_id"=>$commentsql->getValue("rex_com_comment.id")));
			echo '<p class="link-button"><a href="'.rex_getUrl(REX_ARTICLE_ID,'',$link_params).'"><span>Löschen</span></a></p>';
		}
		echo '</div>
			<div class="clearer"> </div>
		</div>';
		
		if ($cl == "") $cl = ' class="alternative"';
		else $cl = "";
		$commentsql->next();
	}
}
echo '
<div class="clearer"> </div>
</div>
</div>
</div>
</div>
';
echo $addcomment;
?>
</div>