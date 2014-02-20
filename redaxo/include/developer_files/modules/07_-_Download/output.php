<?php

	if (!function_exists('Dateigroesse')) {
		function Dateigroesse($URL) {
			$Groesse = @filesize($URL);
			if($Groesse<1000) {
				return number_format($Groesse, 0, ",", ".")." Bytes";
			}
			elseif($Groesse<1000000) {
				return number_format($Groesse/1024, 0, ",", ".")." kB";
			}
			else {
				return number_format($Groesse/1048576, 0, ",", ".")." MB";
			}
		}
	}
	
	if (!function_exists('parse_icon')) {
		function parse_icon($ext) {
echo "<!-- $ext -->";
			switch (strtolower($ext)) {
	
				case 'doc': return 'mime-doc.gif';
				case 'rtf': return 'mime-doc.gif';
				case 'txt': return 'mime-txt.gif';
				case 'xls': return 'mime-xls.gif';
				case 'eps': return 'mime-eps.gif';
				case 'csv': return 'mime-xls.gif';
				case 'ppt': return 'mime-ppt.gif';
				case 'html': return 'mime-html.gif';
				case 'htm': return 'mime-html.gif';
				case 'php': return 'mime-script.gif';
				case 'php3': return 'mime-script.gif';
				case 'cgi': return 'mime-script.gif';
				case 'pdf': return 'mime-pdf.gif';
				case 'rar': return 'mime-rar.gif';
				case 'zip': return 'mime-zip.gif';
				case 'gz': return 'mime-gz.gif';
				case 'jpg': return 'mime-jpg.gif';
				case 'gif': return 'mime-gif.gif';
				case 'png': return 'mime-png.gif';
				case 'bmp': return 'mime-image.gif';
				case 'tif': return 'mime-image.gif';
				case 'exe': return 'mime-binary.gif';
				case 'bin': return 'mime-binary.gif';
				case 'avi': return 'mime-mov.gif';
				case 'mpg': return 'mime-mov.gif';
				case 'moc': return 'mime-mov.gif';
				case 'asf': return 'mime-mov.gif';
				case 'mp3': return 'mime-sound.gif';
				case 'wav': return 'mime-sound.gif';
				case 'org': return 'mime-sound.gif';
			
				default:
					return 'icon_def.gif';
			}
		}
	}
	$out	= "";
	
	$extFile1	= "";
	$nameFile1	= "";
	$sizeFile1	= "";
	
	if ("REX_FILE[1]" != "") {
		$extFile1 	= substr(strrchr('REX_FILE[1]', '.'), 1);
		$iconFile1 	= $REX['HTDOCS_PATH'].'/redaxo/media/'.parse_icon($extFile1);
		$ooFile1 	= OOMedia::getMediaByName ('REX_FILE[1]');
		$nameFile1 	= $ooFile1->getTitle();
		$sizeFile1 	= Dateigroesse($REX['HTDOCS_PATH']."files/REX_FILE[1]");
	
		$out .= '
			<p class="link-download">
				<a href="'.$REX['HTDOCS_PATH'].'files/REX_FILE[1]" target="_blank"><img src="'.$iconFile1.'" alt="Datei zum herunterladen" title="'.$nameFile1.' ('.$sizeFile1.')" /></a>
				<span class="name">'.$nameFile1.'</span>
				<span class="size">('.$sizeFile1.')</span>
			</p>';
	}
	
	
	print '
	<div class="com-tab com-tab-no-navi download"><div class="com-tab-cntnt"><div class="com-tab-cntnt-2"><div class="com-tab-cntnt-3">'.$out.'</div></div></div></div>';
 
?>