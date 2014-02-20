<?php
// *********************** USERSUCHE
$searchtext = rex_request("searchtext","string","");
$send = rex_request("send","string","");
$orderArr = array('firstname' => 'Vorname', 'name' => 'Name', 'email' => 'E-Mail');
$orderArr = array('login' => 'Login');


$ordersql = 'login';
$ordr = rex_request("ordr","string");
if (isset($_REQUEST['ordr']) AND (isset($orderArr[$ordr]))) {	
	$ordersql = ''.$_REQUEST['ordr'];
}
$ordersql = ' ORDER BY '.$ordersql;

// **** SQL AUFBAUEN
$felder = array("login","firstname","name","city");
$felder = array("login");

$addsql = "";
$urlArr = array();
if ($searchtext != "")
{
	foreach($felder as $feld)
	{
		if ($addsql != "") $addsql .= ' or ';
		$addsql .= $feld.' LIKE "%'.$searchtext.'%"';
	}
	$addsql = ' and ('.$addsql.')';
	
	$urlArr['searchtext'] = htmlspecialchars(stripslashes($searchtext));
}

$filter = $_REQUEST["filter"];
if ($filter != "")
{
	$addsql = 'and login LIKE "'.$filter.'%"';
}

$sql = "select * from rex_com_user where status > 0 ".$addsql.$ordersql;

$ms = new rex_sql;
//$ms->debugsql = true;
$ms->setQuery($sql);
$sortLinks = '';
foreach ($orderArr AS $key => $val) {
	
	$urlArr['ordr'] = $key;
	$sortLinks .= '<a href="'.rex_getUrl('', '', $urlArr).'">'.$val.'</a> ';
}

echo '
	<div class="com-usersearch">
		<form action="'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array("send"=>1),"&amp;").'" method="post" name="searchform" id="searchform">
			
			<p class="ftxt">
				<label for="usersearch">Mitgliedsuche:</label>
				<input type="text" name="searchtext" value="'.htmlspecialchars(stripslashes($searchtext)).'" id="usersearch" />
			</p>
			
			<p class="link-save">
				<a href="javascript:void(0);" onclick="document.getElementById(\'searchform\').submit();"><span>Suche starten</span></a>
			</p>
			
		</form>';
		

// if ($ms->getRows()>0)
//{
	echo '
	<div class="com-tab com-tab-no-navi">
	<div class="com-tab-cntnt">
	<div class="com-tab-cntnt-2">
	<div class="com-tab-cntnt-3">
				';
				

	// ***** Alle | A-Z | Blaettern
	
	$gn = 'select UPPER(SUBSTR(login,1,1)) as ch from rex_com_user where status > 0 group by ch';
	$ga = new rex_sql;
	// $ga->debugsql = 1;
	$ga->setQuery($gn);
	$ga_array = $ga->getArray();
	echo '
	<div class="com-navi">
			<ul class="navi com-navi-letters">
				<li><a href="'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID).'">Alle | </a></li>
				';
				foreach ($ga_array as $k => $v)
				{
					// echo "<br />** $k ** ".$v["ch"];
					echo '		<li><a href="'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array("filter"=>$v["ch"])).'">'.$v["ch"].'</a></li>';
				}
				/*
				for($i=65;$i<91;$i++)
				{
					echo '		<li><a href="'.rex_getUrl(REX_ARTICLE_ID,REX_CLANG_ID, array("filter"=>chr($i))).'">'.chr($i).'</a></li>';
				}
				*/
	echo '
			</ul>
			'.rex_com_blaettern($ms).'
			<div class="clearer"> </div>
	</div>
	';
				
				
	// ***** Sortieren
	/*
	echo '
				<div class="com-navi">
					<p class="flLeft">Sortieren nach: '.$sortLinks.'</p>
					'.rex_com_blaettern(&amp;$ms).'
					<div class="clearer"> </div>
				</div>';
	*/
				
				
	
	for($i=0;$i<$ms->getRows();$i++) 
	{			
	
		echo '	<div class="com-contact">
					<div class="com-image">
						<p class="image">'.rex_com_showUser(&$ms, "image", "", TRUE, FALSE).'</p>
					</div>
					
					<div class="com-content">
					<div class="com-content-2">
						<p><span class="color-1">';
		
		echo rex_com_showUser(&amp;$ms, "login", "", TRUE);
		if ($ms->getValue("show_basisinfo")==2)
		{
			echo ' [ ';
			echo rex_com_showUser(&amp;$ms, "name", "", TRUE);
			echo ' ]';
		}
		
		echo '</span></p>';
		if (rex_com_showUser(&amp;$ms,"motto","", FALSE)) echo '<p>Motto: '.rex_com_showUser(&amp;$ms,"motto","", FALSE).'</p>';
		echo '
					</div>
					</div>
					<div class="clearer"> </div>
				</div>';
		
		
		$ms->next();
				
	}
	echo '
				
				<div class="clearer"> </div>
			</div>
			</div>
	
		</div>
		</div>';
// }
echo '</div>';
?>