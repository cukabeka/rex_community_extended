<?php

//
// Initialisierung
//
include $REX["INCLUDE_PATH"]."/addons/community/plugins/guestbook/classes/class.rex_com_guestbook.inc.php";


if ($REX["REDAXO"])
{
	// Diese Seite noch extra einbinden
	$REX['ADDON']['community']['subpages'][] = array('plugin.guestbook','G�stebuch');

	// Im Setup aufnehmen - f�r Module.
	$REX["ADDON"]["community"]["plugins"]["setup"]["modules"][] = array("guestbook","guestbook","1201 - COM-Module - G�stebuch");

	// EMails
	$REX["ADDON"]["community"]["plugins"]["setup"]["emails"][] = array("guestbook","sendemail_guestbook","sendemail_guestbook","Community: Neuer Eintrag in Ihr G�stebuch", $REX['ERROR_EMAIL'], $REX['ERROR_EMAIL']);

}else
{




}

?>