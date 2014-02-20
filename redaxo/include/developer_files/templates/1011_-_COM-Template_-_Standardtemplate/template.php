<?php
error_reporting(E_ALL ^ E_NOTICE);

// Die IDs der Templates muessen angepasst werden
// Permission Funktion includen, passende ID einsetzen
?>REX_TEMPLATE[9]<?php

// Authentifizierung includen, passende ID einsetzen
?>REX_TEMPLATE[8]<?php

if (rex_com_checkUserPerm($this->getValue("art_com_perm")))
{
  // Zugriff erlaubt
  $CONTENT  = $this->getArticle(1);
  $CONTENT_LEFT  = $this->getArticle(2);
  $CONTENT_RIGHT  = $this->getArticle(3);
	$art = OOArticle::getArticleById(REX_ARTICLE_ID);
	$cat = OOCategory::getCategoryById($art->getCategoryId());
	if ($CONTENT_LEFT == '') {
		while ($CONTENT_LEFT == '') {
			if ($cat == null) break;
			$a = new rex_article($cat->getId());
			$CONTENT_LEFT = $a->getArticle(2);
			$cat = $cat->getParent();
		} 
	}
	if ($CONTENT_LEFT == '') {
		$a = new rex_article($REX['START_ARTICLE_ID']);
		$CONTENT_LEFT = $a->getArticle(2);
	}
	if ($CONTENT_RIGHT == '') {
		while ($CONTENT_RIGHT == '') {
			if ($cat == null) break;
			$a = new rex_article($cat->getId());
			$CONTENT_RIGHT = $a->getArticle(3);
			$cat = $cat->getParent();
		} 
	}
	if ($CONTENT_RIGHT == '') {
		$a = new rex_article($REX['START_ARTICLE_ID']);
		$CONTENT_RIGHT = $a->getArticle(3);
	}
}else
{
  // Zugriff verboten
  ob_end_clean();
  ob_end_clean();
  header('Location:'.rex_getUrl(REX_COM_PAGE_LOGIN_ID,'',array("errmsg"=>'Sie haben keine Rechte f&uuml;r diese Seite und wurden deswegen auf die Startseite geleitet.')));
  exit;
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="de" lang="de">
<head>
	<title>Community REDAXO</title>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<meta name="robots" content="index, follow" />
	<meta name="language" content="deutsch" />
	<meta name="distribution" content="global" />
	<meta name="revisit-after" content="30 days" />
	<link rel="stylesheet" type="text/css" href="files/css_website.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="files/css_community.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="files/css_form.css" media="screen" />
</head>
<body>
<!--
<div style="background-color:#f90; padding:10px; color:#fff; display:block;">Ich arbeite gerade an der Seite, es kann sein das diese hin und wieder ausf&#x2030;llt</div>
-->
<div id="wbst">
	
	<div id="logo"><p><a href="/">Community AddOn</a></p></div>
	
	<div id="hdr">
		<div id="com-usr-navi">
			REX_TEMPLATE[13]
		</div>
		REX_TEMPLATE[14]
	</div>
	
	
	<div id="wrppr">
		<div id="f-lft">
			<div class="bx-v1 bx-shdw">
			<div class="bx-v1-2 bx-shdw-2">
				<div class="bx-v1-cntnt">
					<h3><strong>Navigation</strong></h3>
					<div id="com-site-navi">
						REX_TEMPLATE[12]
					</div>
				</div>
			</div>
			</div>
			<?php echo $CONTENT_LEFT; ?>
		</div>
	
		<div id="f-cntnt">
			<div id="cntnt">
				<?php echo $CONTENT; ?>
			</div>
			
		</div>
		
		<div id="f-rght">
			REX_TEMPLATE[10]
			<?php echo $CONTENT_RIGHT; ?>
			REX_TEMPLATE[15]
		</div>
		
		<div class="clearer"> </div>
	</div>
</div>
<div id="ftr">
	<p><a href="<?php echo rex_getUrl(35); ?>">Impressum</a> | &copy; 2007 By Yakamara Media GmbH &amp; Co. KG</p>
</div>
</body>
</html>