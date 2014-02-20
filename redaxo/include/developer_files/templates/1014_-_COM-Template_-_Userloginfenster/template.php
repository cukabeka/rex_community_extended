<?php
// ********************************************************* LOGIN
$login = '';
$status = '';
$now = time();
$gab = 60*60;
$ti = $now-$gab;
// User sind online
$gu = new rex_sql;
$gu->setQuery('select * from rex_com_user where last_xs>'.$ti.' and online_status=1');
$user_online = $gu->getRows();
if ($user_online == 0) $user_online_text = 'Kein Benutzer ist online'; 
elseif ($user_online < 2) $user_online_text = 'Ein Benutzer ist online';
else $user_online_text = $user_online.' Benutzer sind online';
$users_online = "";
$users_online = '<ul class="com-usr-list">';
for($i=0;$i<$gu->getRows();$i++)
{
  //if ($users_online != "") $users_online .= ' + ';
  $users_online .= '<li>'.rex_com_showUser($gu, "login", "", TRUE).'</li>';
  $gu->next();
}
if ($gu->getRows()==0) $users_online .= '<li>Kein User ist online</li>';
$users_online .= '</ul>';
if (isset($REX['COM_USER']) && is_object($REX['COM_USER']))
{
	$status = 'Login';

	$gu->setQuery('select count(id) from rex_com_contact where user_id='.$REX['COM_USER']->getValue('id').' and accepted=1');
	// $gu->debugsql = 1;
	$user_contacts = $gu->getValue("count(id)");
	$gu->setQuery('select count(id) from rex_com_contact where user_id='.$REX['COM_USER']->getValue('id').' and accepted=0 and requested=0');
	$user_contact_requests = $gu->getValue("count(id)");
	$login .= '<div id="com-user-box">';
	$login .= '<h4>User</h4>';
	//$login .= '<p>Sie sind eingeloggt als:<br /> <strong>'.$REX['COM_USER']->getValue('login').'</strong></p>';
	$login .= '<p><strong>'.$REX['COM_USER']->getValue('login').'</strong></p>';
	$login .= '<ul>
					<li><a class="icon icon-myprfl" href="'.rex_getUrl(REX_COM_PAGE_MYPROFIL_ID).'"><span>Mein Profil</span></a></li>
					<li><a class="icon icon-lgt" href="'.rex_getUrl($logout_aid,'',array('logout'=>1)).'"><span>Logout</span></a></li>
				</ul>
			';
	
	//$login .= '<p><br /><a href="'.rex_getUrl(REX_COM_PAGE_MYPROFIL_ID).'">&amp;raquo; Mein Profil</a></p>';
	//$login .= '<p class="logout"><a href="'.rex_getUrl($logout_aid,'',array('logout'=>1)).'">&amp;raquo; Logout</a></p>';
	
	$login .= '<div class="splt"></div>';
	$login .= '<ul>';
	$login .= '<li>'.$user_online_text.'</li>';
	if ($user_contacts == 1) $login .= '<li>Sie haben einen Kontakt</li>';
	elseif ($user_contacts == 0) $login .= '<li>Sie haben keinen Kontakt</li>';
	else $login .= '<li>Sie haben '.$user_contacts.' Kontakte</li>';
	if ($user_contact_requests == 1) $login .= '<li>Sie haben eine Kontaktanfrage</li>';
	elseif ($user_contact_requests == 0) $login .= '<li>Sie haben keine Kontaktanfrage</li>';
	else $login .= '<li>Sie haben '.$user_contact_requests.' Kontaktanfragen</li>';
	// $login .= '<li>Aktivit&#x2030;t: '.$REX['COM_USER']->getValue('activity').'%</li>';
	$login .= '</ul>';
	
	$login .= '<div class="splt"></div>';
	$login .= '<h4>Folgende User sind online:</h4>'.$users_online;
	$login .= '</div>';
}else
{
	$status = 'Logout';
	$login .= '<div id="com-user-box">';
	$login .= '<h4>Login</h4>';
	$login .= '<form action="index.php" method="post">
				<input type="hidden" name="article_id" value="'.REX_COM_PAGE_LOGIN_ID.'" />
					<fieldset>
					<p class="formtext">
						<label for="name" class="hidden">Benutzername:</label>
						<input type="text" id="name" name="login_name" value="Benutzername..." onblur="if(this.value == \'\') this.value=\'Benutzername...\'" onfocus="if(this.value == \'Benutzername...\') this.value=\'\'" />
					</p>
					<p class="formtext">
						<label for="password" class="hidden">Passwort:</label>
						<input type="password" id="password" name="login_psw" value="Passwort..." onblur="if(this.value == \'\') this.value=\'Passwort...\'" onfocus="if(this.value == \'Passwort...\') this.value=\'\'" />
					</p>
					<!-- <p class="formcheckbox">
						<input type="checkbox" id="loginsave" name="login_save" />
						<label for="loginsave">Login speichern</label>
					</p>-->
					<p class="formsubmit">
						<input class="submit" type="submit" value="Login" title="Anmeldung durchf&#x00b8;hren" />
					</p>
					</fieldset>
				</form>
				
				<ul>
					<li><a class="icon icon-rgstr" href="'.rex_getUrl(REX_COM_PAGE_REGISTER_ID).'"><span>Registrieren ?</span></a></li>
					<li><a class="icon icon-psswd-frgttn" href="'.rex_getUrl(REX_COM_PAGE_PSWFORGOTTEN_ID).'"><span>Passwort ?</span></a></li>
				</ul>
				
				<div class="splt"></div>
				
				<h4>Folgende User sind online:</h4>
				'.$users_online.'
			';
	$login .= '</div>';

} 
echo '<div class="bx-v1 bx-shdw"><div class="bx-v1-2 bx-shdw-2"><div class="bx-v1-cntnt"><h3><strong>Status</strong> / '.$status.'</h3>'.$login.'</div></div></div>';
?>