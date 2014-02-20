<?php
## Getting Facebook parameters
$fbstate = rex_get("state","string");
$fbcode = rex_get("code","string");

## Execute only if parameters given
if($fbstate != '' && $fbcode != '')
{
	if($REX['ADDON']['community']['plugin_auth_facebook']['facebook']->getUser())
	{
		if(rex_com_auth_facebook::checkRequiredPerms())
		{
			// -------------------------- Get User Array
			$fbuser = $REX['ADDON']['community']['plugin_auth_facebook']['facebook']->api('/me','GET');
			
			// -------------------------- Check if User Exists in Database
			$sql = new rex_sql();
			$sql->setQuery('SELECT facebookid FROM rex_com_user WHERE facebookid = '.$fbuser['id'].'');
			
			if($sql->getRows() == 0)
			{
			
				// -------------------------- Sync facebook user to database
				
				$login = $fbuser['username'].".fb.".$fbuser['id'];
				
				$iu = rex_sql::factory();
				$iu->setTable("rex_com_user");

				$iu->setValue("status",1);
        $iu->setValue("authsource","facebook");
        $iu->setValue("facebookid",$fbuser['id']);

        // -------------------------- Check if User Exists in Database
        $gu = rex_sql::factory();
        // $gu->debugsql = 1;
        if(array_key_exists("email", $REX['ADDON']['community']['plugin_auth_facebook']['synctranslation']))
        {
          $email = $fbuser["email"];
          $gu->setQuery('SELECT * FROM rex_com_user WHERE email="'.mysql_real_escape_string($email).'" LIMIT 1');

        }else 
        {
          $gu->setQuery('SELECT * FROM rex_com_user WHERE login="'.mysql_real_escape_string($login).'" LIMIT 1');

        }
        
        if($gu->getRows() == 0)
        {
          // -------------------------- User does not exist
          
          $iu->setValue("login",$fbuser['last_name'].".fb.".$fbuser['id']);
          $iu->setValue("password",rex_com_auth_facebook::generatePassword('16'));
          
          ## Adding defaultgroups
          if(isset($REX['ADDON']['community']['plugin_auth_facebook']['defaultgroups']))
          {
            $iu->setValue("rex_com_group",implode(',' , $REX['ADDON']['community']['plugin_auth_facebook']['defaultgroups']));
          }
          
          ## Translate datafields
          foreach($REX['ADDON']['community']['plugin_auth_facebook']['synctranslation'] as $key => $value)
          {
            $iu->setValue($key,$fbuser[$value]);
          }
        
          $iu->insert();

          rex_com_user::triggerUserCreated($iu->getLastId()); // TODO: params as array()
          
        }else {

          // -------------------------- User exists -> only update
          
          $iu->setWhere('id='.$gu->getValue("id"));
          $iu->update();
          
          rex_com_user::triggerUserUpdated($gu->getValue("id")); // TODO: params as array()
          
        }
			
			}
			
			// TODO: 
			// Bestimte Felder auf wunsch bei jedem Login erneut Syncronisieren.
	
	    $params = array("facebookid" => $fbuser['id'], "status" => 1);
	    rex_com_auth::loginWithParams($params);
			
			if(rex_com_auth::getUser() && $REX['ADDON']['community']['plugin_auth_facebook']['redirect'])		
			  rex_redirect($REX['ADDON']['community']['plugin_auth']['article_login_ok']);
		}
	}
	
	if(!$REX['ADDON']['community']['plugin_auth_facebook']['facebook']->getUser() || !(rex_com_auth::getUser()) && $REX['ADDON']['community']['plugin_auth_facebook']['redirect'])
		rex_redirect($REX['ADDON']['community']['plugin_auth']['article_login_failed'],'',array('rex_com_auth_info'=>'2'));

}

?>