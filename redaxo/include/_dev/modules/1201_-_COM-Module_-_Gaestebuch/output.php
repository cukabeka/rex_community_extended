<?php
$tab = rex_request("tab","int");
$article_id = rex_request("article_id","int");
if (isset($REX['COM_USER']) AND is_object($REX['COM_USER'])) 
	echo rex_com_guestbook::getGuestbook($REX['COM_USER']->getValue("rex_com_user.id"),$article_id,array("tab"=>$tab));
?>