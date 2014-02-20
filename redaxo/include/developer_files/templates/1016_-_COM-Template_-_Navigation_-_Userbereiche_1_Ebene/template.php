<?php
// Navigation f&#x00b8;r Usercategorien
// BItte die Kategorie eintragen, die die Kategorien wie "Mein Profil", "Meine Kontakte" etc enth&#x2030;llt.
$cat_id = REX_COM_USERCAT_ID;
// EXPLODE PATH
$PATH = explode("|",$this->getValue("path").$this->getValue("article_id")."|");
$cats = OOCategory::getChildrenById($cat_id, true);
$catsArr = array();
foreach ($cats as $lev1) {
	if (rex_com_checkUserPerm($lev1->getValue("art_com_perm")))		
		$catsArr[$lev1->getId()]['name'] = $lev1->getName();
}
$c1 = 0;
$nav = '<ul>';
if (is_array($catsArr) AND sizeof($catsArr) != 0) 
{
	foreach ($catsArr AS $lev1Id => $value) 
	{
		$c1++;
		$cl1 = '';
		
		if ($c1 == 1)
			$cl1 = ' class="li-frst"';
		elseif ($c1 == count($catsArr))
			$cl1 = ' class="li-lst"';
		
		if (count($catsArr) == 1)
			$cl1 = ' class="li-aln"';
			
		if ($lev1Id == $PATH[2])
			$nav .= '<li'.$cl1.'><a class="active" href="'.rex_getUrl($lev1Id).'"><span>'.strtoupper($value['name']).'</span></a></li>';
		else
			$nav .= '<li'.$cl1.'><a href="'.rex_getUrl($lev1Id).'"><span>'.strtoupper($value['name']).'</span></a></li>';
		
	}
}
if (isset($REX['COM_USER']) AND is_object($REX['COM_USER'])) 
{
	$nav .= '<li class="li-aln"><a href="'.rex_getUrl('', '', array('logout'=>1)).'"><span>LOGOUT</span></a></li>';
}else 
{
	$cl1_a ='';
	if ($this->getValue('article_id') == REX_COM_PAGE_LOGIN_ID)
		$cl1_a = ' class="active"';
	$nav .= '<li class="li-aln"><a'.$cl1_a.' href="'.rex_getUrl(REX_COM_PAGE_LOGIN_ID).'"><span>LOGIN</span></a></li>';
}
$nav .= '</ul>';
print $nav;
?>