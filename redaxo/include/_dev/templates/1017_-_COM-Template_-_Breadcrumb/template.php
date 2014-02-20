<?php
/*	Breadcrumb Navi	*************************************/
$aid = $this->getValue('article_id');
$navi_brdcrmb = '';
$article = OOArticle :: getArticleById($aid);
$article_tree = $article->getParentTree();
if (!$article->isStartpage()) {
	$article_tree[] = $article;
}
if (is_array($article_tree)) {
	$navi_brdcrmb .= '<div class="com-path"><p>Sie befinden sich hier: ';
	
	if ($aid != $REX['START_ARTICLE_ID']) {
		$navi_brdcrmb .= '<a href="'.rex_getUrl($REX['START_ARTICLE_ID']).'">Home</a> &raquo; ';
	}
	
	foreach ($article_tree as $article) {
				
		if ($article->hasTemplate() AND $article->isOnline()) {
			if ($article->getId() == $aid) {
				$navi_brdcrmb .= '<span><a href="'.$article->getUrl().'">'.$article->_name.'</a></span>';
			}
			else {
				$navi_brdcrmb .= '<a href="'.$article->getUrl().'">'.$article->_name.'</a> &raquo; ';
			}
		}
	}
	
	if (substr($navi_brdcrmb, -9, 9) == ' &raquo; ')
		$navi_brdcrmb = substr($navi_brdcrmb, 0, -9);
	
	$navi_brdcrmb .= '</p></div>';
	
	print $navi_brdcrmb;
}
?>