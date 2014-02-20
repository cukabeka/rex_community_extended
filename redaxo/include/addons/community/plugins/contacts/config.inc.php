<?php



$mypage = "Kontakte";
$REX['ADDON']['version'][$mypage] = '1';
$REX['ADDON']['author'][$mypage] = 'Jan Kristinus';
$REX['ADDON']['supportpage'][$mypage] = 'www.yakamara.de/tag/redaxo/';

if (isset($I18N) && is_object($I18N)) {
  $I18N->appendFile($REX['INCLUDE_PATH'] . '/addons/community/plugins/contacts/lang');
}

if($REX["REDAXO"] && !$REX['SETUP'])
{
	if ($REX['USER'])
	{
		$REX['ADDON']['community']['SUBPAGES'][] = array('plugin.contacts' , $I18N->msg("com_contacts"));
	}
}

	// Module für das Setup aufnehmen
	$REX["ADDON"]["community"]["plugins"]["setup"]["modules"][] = array("contacts","contacts","1101 - COM-Module - Kontaktbox");

	// Emails aufnehmen
	$REX["ADDON"]["community"]["plugins"]["setup"]["emails"][] = array("contacts","sendemail_contactrequest","sendemail_contactrequest","Community: Neue Kontaktanfrage", $REX['ERROR_EMAIL'], $REX['ERROR_EMAIL']);

include $REX["INCLUDE_PATH"]."/addons/community/plugins/contacts/functions/functions.rex_com_blaettern.inc.php";
include $REX["INCLUDE_PATH"]."/addons/community/plugins/contacts/functions/functions.rex_com_formatter.inc.php";
include $REX["INCLUDE_PATH"]."/addons/community/plugins/contacts/functions/functions.rex_com_user_xt.inc.php";


// make this dynamic on the plugin's config subpage
$REX["ADDON"]["community"]["settings"]["REX_COM_PAGE_PROFIL_ID"] = "28";

?>