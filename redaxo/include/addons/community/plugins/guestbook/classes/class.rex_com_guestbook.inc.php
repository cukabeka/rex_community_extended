<?php

if (!class_exists("rex_formatter")) {
  include_once $REX['INCLUDE_PATH'].'/classes/class.rex_formatter.inc.php';
}

class rex_com_guestbook
{

	var $exist = FALSE;
	var $sql;
	var $contacts = -1;
	var $user_id = -1;

	function rex_com_user ($user_id)
	{
		global $REX;
		
		$user_id = (int) $user_id;
		
		if ($user_id == 0) return FALSE;
		
		$this->sql = new rex_sql;
		$this->sql->setQuery('select * from rex_com_user where id='.$user_id.' LIMIT 2');

		if ($this->sql->getRows() != 1) return FALSE;
		
		$this->exist = TRUE;
		$this->user_id = $this->getValue("id");
		
		return TRUE;
	}

	function getValue($val)
	{
		if (is_object($this->sql))
		{
			return $this->sql->getValue($val);
		}
	}

	function exists()
	{
		return $this->exist;
	}

	function getContactsAsArray()
	{
		if (is_array($this->contacts)) return $this->contacts;
		$this->contacts = array();
		$gc = new rex_sql;
		// $gc->debugsql = 1;
		$gc->setQuery('select * from rex_com_contact where user_id='.$this->user_id.' and accepted=1');
		$res = $gc->getArray();
		foreach($res as $con)
		{
			$this->contacts[] = $con["to_user_id"];
		}
		return $this->contacts;
	}

	// *********************************** STATIC

	// Aktion werden hier ausgef¸hrt.
	// Bisher sind es Aktionen zur E-Mail Benachirhctung
	// * sendemail_contactrequest
	// * sendemail_newmessage
	// * sendemail_guestbook

	function exeAction($user_id = 0,$action = "", $searchandreplace = array())
	{
		$gt = new rex_sql;
		// $gt->debugsql = true;
		$gt->setQuery('select * from rex_xform_email_template where name="'.$action.'"');
		if ($gt->getRows()==1)
		{
			$gu = new rex_sql;
			// $gu->debugsql = true;
			$gu->setQuery('select * from rex_com_user where id="'.$user_id.'" and '.$action.'=1');
			if ($gu->getRows()==1)
			{
				// echo "<p>Aktion ausgef¸hrt: ID:$user_id Aktion:$action</p>";
				$mail_from = $gt->getValue("mail_from");
				$mail_from_name = $gt->getValue("mail_from_name");
				$mail_to = $gu->getValue("email");
				$mail_subject = $gt->getValue("subject");
				$mail_body = $gt->getValue("body");
				foreach ($searchandreplace as $search => $replace)
				{
					$mail_from = str_replace('###'. $search .'###', $replace, $mail_from);
					$mail_from_name = str_replace('###'. $search .'###', $replace, $mail_from_name);
					$mail_to = str_replace('###'. $search .'###', $replace, $mail_to);
					$mail_subject = str_replace('###'. $search .'###', $replace, $mail_subject);
					$mail_body = str_replace('###'. $search .'###', $replace, $mail_body);
				}

				$mail = new PHPMailer();
				$mail->AddAddress($mail_to, $mail_to);
				$mail->WordWrap = 80;
				$mail->FromName = $mail_from_name;
				$mail->From = $mail_from;
				$mail->Subject = $mail_subject;
				$mail->Body = nl2br($mail_body);
				$mail->AltBody = strip_tags($mail_body);
				// $mail->IsHTML(true);
				if ($mail->Send()) echo ""; // ok
				else echo ""; // nicht ok
			}
			return FALSE;
		}
		return FALSE;
	}

	
	function createObject($user_id)
	{
		global $REX;

		if (!isset($REX["COM_CACHE"]["USER"][$user_id]) || !is_object($REX["COM_CACHE"]["USER"][$user_id]))
		{
			$REX["COM_CACHE"]["USER"][$user_id] = new rex_com_user($user_id);
			if (!$REX["COM_CACHE"]["USER"][$user_id]->exists()) return FALSE;
		}
		return TRUE;
	}
	
	
	public function getGuestbook($user_id, $aid, $params = array())
	{
	
		global $REX;
	
		$MY = FALSE;
		if (is_object($REX['COM_USER']) && $REX['COM_USER']->getValue("rex_com_user.id") == $user_id) $MY = TRUE;

		$u = new rex_sql;
		$u->setQuery("select * from rex_com_user where id=".$user_id);
		if ($u->getRows()!=1) return "";

	
		// ***** ADD MESSAGE
		if(is_object($REX['COM_USER']) && $_REQUEST["add_message"] != "")
		{
			$text = $_REQUEST["text"];
			if($text == ""){
				$errormessage = '<p class="warning" colspan="2">Es wurde keine Nachricht eingetragen !</p>';
			}else
			{ 
				$addmsgsql = new rex_sql();
				$addmsgsql->setTable("rex_com_guestbook");
				$addmsgsql->setValue("user_id", $user_id);
				$addmsgsql->setValue("from_user_id", $REX['COM_USER']->getValue("id"));
				$addmsgsql->setValue("text", $text);
				$addmsgsql->setValue("create_datetime", time());
				$addmsgsql->insert();
				
				if ($user_id != $REX['COM_USER']->getValue('rex_com_user.id'))
				{
					rex_com_user_xt::exeAction($user_id,"sendemail_guestbook", 
						array(
							"user_id" => $REX['COM_USER']->getValue('rex_com_user.id'),
							"firstname" => $REX['COM_USER']->getValue('rex_com_user.firstname'),
							"name" => $REX['COM_USER']->getValue('rex_com_user.name'),
							"login" => $REX['COM_USER']->getValue('rex_com_user.login'),
							"to_user_id" => $u->getValue('rex_com_user.id'),
							"to_firstname" => $u->getValue('rex_com_user.firstname'),
							"to_name" => $u->getValue('rex_com_user.name'),
							"to_login" => $u->getValue('rex_com_user.login'),
						)
					);
				}
				
			}
		}elseif($MY && $_REQUEST["delete_message"] != "")
		{
			$msg_id = (int) $_REQUEST["msg_id"];
			if($msg_id == 0){
				$errormessage = '<p class="warning">Es wurde keine Nachricht ausgewählt!</p>';
			}else
			{ 
				$addmsgsql = new rex_sql();
				//$addmsgsql->debugsql = 1;
				$addmsgsql->setQuery('delete from rex_com_guestbook where id='.$msg_id.' and user_id="'.$REX['COM_USER']->getValue("id").'"');
				$addmsgsql->delete();
			}
		}
		
		
		
		// ***** SHOW MESSAGES
		$guestsql = new rex_sql();
		$guestsql->debugsql = 0;
		$guestsql->setQuery("SELECT * 
			FROM  rex_com_guestbook 
			LEFT JOIN rex_com_user ON rex_com_guestbook.from_user_id=rex_com_user.id 
			WHERE rex_com_guestbook.user_id='".$user_id."' 
			ORDER BY rex_com_guestbook.create_datetime desc");

		if($guestsql->getRows()<=0)
		{
			$echo .= '<p class="com-whitebox">Kein Gästebucheintrag vorhanden!</p>';
		}else
		{
			$cl = "";
			for($i=0;$i<$guestsql->getRows();$i++)
			{
			
				// $cl
				$echo .= '
				<div class="com-guestbook">
					<div class="com-image">
						<p class="image">'.rex_com_showUser(&$guestsql,"name").'</p>
					</div>

					<div class="com-content">
					<div class="com-content-2">
					
						<div class="com-content-name">
							<p><span class="color-1">'.rex_com_showUser(&$guestsql,"name").', '.rex_com_showUser(&$guestsql,"city","",FALSE).'</span>
								<br />'.rex_formatter::format($guestsql->getValue("rex_com_guestbook.create_datetime"),'date',"Y-m-d").'
							</p>
						</div>
						<p><b>'.nl2br(htmlspecialchars($guestsql->getValue("rex_com_guestbook.text"))).'</b></p>';

				if ($guestsql->getValue("rex_com_user.motto") != '')
					$echo .= '<p>Motto: '.$guestsql->getValue("rex_com_user.motto").'</p>';
			
				if ($MY)
				{
					$link_params = array_merge($params,array("user_id"=>$user_id,"delete_message"=>1,"msg_id"=>$guestsql->getValue("rex_com_guestbook.id")));
					$echo .= '<br /><p class="link-button"><a href="'.rex_getUrl($aid,'',$link_params).'"><span>Löschen</span></a></p>';
				}

				$echo .= '</div></div>
					<div class="clearer"> </div>
				</div>';
				
				if ($cl == "") $cl = ' class="alternative"';
				else $cl = "";
				$guestsql->next();
			}
		}
//		$echo .= '</tr></table>';
		
		if(is_object($REX['COM_USER']))
		{
		
			$echo .= '<div id="rex-form" class="com-guestbook-form spcl-bgcolor">
			
			<form action="index.php" method="post" id="guestbookform">
			
			<h2>Einen neuen Eintrag schreiben</h2>

			'.$errormessage.'
			
			<input type="hidden" name="add_message" value="1" />
			<input type="hidden" name="user_id" value="'.$user_id.'" />
			<input type="hidden" name="article_id" value="'.$aid.'" />
			';
			
			foreach($params as $k => $v)
			{
				$echo .= '<input type="hidden" name="'.$k.'" value="'.htmlspecialchars($v).'" />';
			}
			
			$echo .= '
				<p class="formtextarea">
					<label for="f-message">Nachricht:</label>
					<textarea id="f-message" name="text" cols="40" rows="4" /></textarea>
				</p>
				<p class="link-save">
					<a href="javascript:void(0);"  onclick="document.getElementById(\'guestbookform\').submit()"><span>Speichern</span></a></p>
				</p>
			<div class="clearer"> </div>
			
			</form>
			</div>';

		}
	
		return $echo;
	
	
	}
	
	

}


?>