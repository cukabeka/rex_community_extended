<?php
/*
   	 0  Standard   	Zugriff f&#x00b8;r alle 
  	-1 	Zugriff f&#x00b8;r nicht eingeloggte User  
  	 1 	Zugriff f&#x00b8;r eingeloggte User  
  	 2 	Zugriff f&#x00b8;r eingeloggte Moderatoren und Admins
  	 3 	Zugriff f&#x00b8;r eingeloggte Admins
*/
function rex_com_checkUserPerm($type,$group = "")
{
	global $REX;
	if ($type == "") return true; // Zugriff f&#x00b8;r alle 
	if ($type == "0") return true; // Zugriff f&#x00b8;r alle 
  
	if (isset($REX['COM_USER']) AND is_object($REX['COM_USER']))
	{
		if ($type == "1") return true; // Zugriff f&#x00b8;r eingeloggte User
		if ($type == "2" AND ($REX['COM_USER']->getValue("admin")==1 || $REX['COM_USER']->getValue("moderator")==1)) return true;
		if ($type == "3" AND $REX['COM_USER']->getValue("admin")==1) return true;
	}
	if(!isset($REX['COM_USER']) || !is_object($REX['COM_USER']))
	{
		if ($type == "-1") return true; // Zugriff f&#x00b8;r nicht eingeloggte User 
	} 
	return false;
}
	
?>