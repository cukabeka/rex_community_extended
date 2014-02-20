<?php
// -------------------------------------------------------------- USER AUTH

unset($REX['COM_USER']);
$pagekey = 'comrex'; // Frontendkey, muss sich unterscheiden, damit frontend und backend sich nicht schneiden.

$login_name = rex_request("login_name","string");
$login_psw = rex_request("login_psw","string");
$logout = rex_request("logout","int");
$msg = 'Bitte einloggen';

// ----- session start
session_start();
$COM_USER_SAVE = new rex_sql();
$COM_USER_SAVE->setTable('rex_com_user');
if ((isset($_SESSION[$pagekey]['UID']) AND $_SESSION[$pagekey]['UID'] != "") or $login_name != "" or $login_psw != "")
{
	$user_id = (int) $_SESSION[$pagekey]['UID'];
	$GLOBALS["I18N"] = rex_create_lang("de");
	$REX['COM_USER'] = new rex_login();
	$REX['COM_USER']->setSqlDb(1);
	$REX['COM_USER']->setSysID($pagekey);
	$REX['COM_USER']->setSessiontime(3000);
	$REX['COM_USER']->setLogin($login_name,$login_psw);
	if ($logout == 1) { $REX['COM_USER']->setLogout(true); }
	$REX['COM_USER']->setUserID("rex_com_user.id");
	$REX['COM_USER']->setUserquery("select * from rex_com_user where id='USR_UID' and status>0");
	$REX['COM_USER']->setLoginquery("select * from rex_com_user where login='USR_LOGIN' and password='USR_PSW' and status>0");
	
	if ($REX['COM_USER']->checkLogin())
	{
		// ----- Login gelungen
		if ($login_name != "")
		{
			// ----- Login gelungen und gerade erst eingeloggt
			// -> last_xs
			$msg = 'Sie haben sich eingeloggt!';
			$COM_USER_SAVE->setValue('last_login',time());
			$jump_aid = $REX['START_ARTICLE_ID'];
		}

	}else
	{
		$ud = new rex_sql;
		// $ud->debugsql = 1;
		if ($user_id != 0 || $logout == 1) $ud->setQuery('update rex_com_user set online_status=0 where id="'.$user_id.'"');
		
		
		// ----- Login failed
		$msg = 'Login ist fehlgeschlagen.';
		if ($logout == 1) $msg = 'Sie haben sich ausgeloggt';
		
		unset($REX['COM_USER']);
		if ($logout == 1) $jump_aid = $REX['START_ARTICLE_ID'];
	}
}else
{
	// ----- nicht eingeloggt und kein login
	$msg = 'Sie sind nicht eingeloggt.';
	unset($REX['COM_USER']);
}
if (isset($REX['COM_USER']) AND is_object($REX['COM_USER'])AND $REX['COM_USER']->getValue('rex_com_user.id')!='')
{
	// ----- session speichern
	
	$COM_USER_SAVE->setValue('online_status','1');
	$COM_USER_SAVE->setValue('session_id',session_id());
	$COM_USER_SAVE->setValue('last_xs',time());
	$COM_USER_SAVE->setWhere('id='.$REX['COM_USER']->getValue('rex_com_user.id'));
	$COM_USER_SAVE->update();
}
unset($COM_USER_SAVE);

if (isset($jump_aid))
{
  header('Location:'.rex_getUrl($jump_aid));
  exit;
}

?>