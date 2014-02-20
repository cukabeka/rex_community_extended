<?php

$param = array();
$text = '';
$file = '';
//	Ausrichtung des Bildes 
if ("REX_VALUE[9]" == "l") {
	$param['class'] = ' class="img fl-lft"';
}
if ("REX_VALUE[9]" == "r") {
	$param['class'] = ' class="img fl-rght"';
}
if ("REX_VALUE[9]" == "b") {
	$param['class'] = ' class="img img-bttm"';
}
if ("REX_VALUE[9]" == "t") {
	$param['class'] = ' class="img img-top"';
}

//	Wenn Bild eingefuegt wurde, Code schreiben 
$get_desc = false;
if ("REX_FILE[1]" != "") {
	
	
	if ('REX_VALUE[8]' == '1' AND (REX_CTYPE_ID == '2' OR REX_CTYPE_ID == '3')) {
		if ("REX_VALUE[9]" == "r" OR "REX_VALUE[9]" == "l")
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=50w__REX_FILE[1]" /></p>';
		else
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=170w__REX_FILE[1]" /></p>';
	}
	elseif ('REX_VALUE[8]' == '1') {
		if ("REX_VALUE[9]" == "r" OR "REX_VALUE[9]" == "l")
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=200w__REX_FILE[1]" /></p>';
		else
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=462w__REX_FILE[1]" /></p>';
	}
	else {
		if ("REX_VALUE[9]" == "r" OR "REX_VALUE[9]" == "l")
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=240w__REX_FILE[1]" /></p>';
		else
			$file = '<p'.$param['class'].'><img src="index.php?rex_resize=500w__REX_FILE[1]" /></p>';
	}
}

if ("REX_VALUE[1]" != "") {

//	Fliesstext 
$input =<<< EOT
REX_HTML_VALUE[1]
EOT;


	$textile = new Textile(); 
	$text = $textile->TextileThis($input);
}

$text = str_replace('href="http://', 'onclick="window.open(this.href); return false" class="link-extern" href="http://', $text);

if ('REX_VALUE[8]' == '1') {
	print '<div class="bx-v1 bx-shdw">
			<div class="bx-v1-2 bx-shdw-2">
			<div class="bx-v1-cntnt">';
			
				
	if ('REX_VALUE[2]' != '')
		print '<h3><strong>REX_VALUE[2]</strong> REX_VALUE[3]</h3>';
}

if ("REX_VALUE[9]" == "b") {
	print '<div class="slc">'.$text.$file.'<div class="clearer"> </div></div>';
}
else {
	print '<div class="slc">'.$file.$text.'<div class="clearer"> </div></div>';
}


if ('REX_VALUE[8]' == '1')
	print '</div></div></div>';

?>