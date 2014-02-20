<?php
// EXPLODE PATH
$PATH = explode("|",$this->getValue("path").$this->getValue("article_id")."|");
// GET CURRENTS
$path1 = $PATH[1];
$path2 = $PATH[2];
$path3 = $PATH[3];
$catsArr = array();
$nav = '';
$c1 = 0;
$lev1Cats = OOCategory::getRootCategories(true);
foreach ($lev1Cats as $lev1) {
	
	if (rex_com_checkUserPerm($lev1->getValue("art_com_perm"))) {
				
		if ($lev1->getId() == $path1)
			$nav .= '<li><a class="active" href="'.rex_getUrl($lev1->getId()).'"><span>'.strtoupper($lev1->getName()).'</span></a>';
		else
			$nav .= '<li><a href="'.rex_getUrl($lev1->getId()).'"><span>'.strtoupper($lev1->getName()).'</span></a>';
		
		
		$lev2Cats = $lev1->getChildren(true);
		
		$nav2 = '';
		if ($lev1->getId() == $path1 AND sizeof($lev2Cats) != 0) {
			foreach ($lev2Cats as $lev2) {
				if (rex_com_checkUserPerm($lev2->getValue("art_com_perm"))) {
					if ($lev2->getId() == $path2)
						$nav2 .= '<li><a class="active" href="'.rex_getUrl($lev2->getId()).'"><span>'.strtoupper($lev2->getName()).'</span></a>';
					else
						$nav2 .= '<li><a href="'.rex_getUrl($lev2->getId()).'"><span>'.strtoupper($lev2->getName()).'</span></a>';
					
					
					$lev3Cats = $lev2->getChildren(true);
			
					$nav3 = '';
					if ($lev2->getId() == $path2 AND sizeof($lev3Cats) != 0) {
						foreach ($lev3Cats as $lev3) {
							if (rex_com_checkUserPerm($lev3->getValue("art_com_perm"))) {
							
								if ($lev3->getId() == $path3)
									$nav3 .= '<li><a class="active" href="'.rex_getUrl($lev3->getId()).'"><span>'.strtoupper($lev3->getName()).'</span></a></li>';
								else
									$nav3 .= '<li><a href="'.rex_getUrl($lev3->getId()).'"><span>'.strtoupper($lev3->getName()).'</span></a></li>';
							}
						}
					}
					if ($nav3 != '')
						$nav2 .= '<ul>'.$nav3.'</ul>';
					$nav2 .= '</li>';
				}
			}
		}
		if ($nav2 != '')
			$nav .= '<ul>'.$nav2.'</ul>';
		$nav .= '</li>';
	}
}
print '<ul>'.$nav.'</ul>';
?>