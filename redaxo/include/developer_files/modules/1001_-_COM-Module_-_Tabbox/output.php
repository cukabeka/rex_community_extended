<?php
$tab_arr = array(
	'REX_LINK_ID[1]', 
	'REX_LINK_ID[2]', 
	'REX_LINK_ID[3]', 
	'REX_LINK_ID[4]', 
	'REX_LINK_ID[5]', 
	'REX_LINK_ID[6]', 
	);

$tab_arr_in = array();
foreach($tab_arr as $v)
{
	if ($a = OOArticle::getArticleById($v))
	{
		$tab_arr_in[$a->getName()] = $v;
	}
}	

$tab_arr = array();
foreach($tab_arr_in as $k => $v)
{
	if ($k != "" AND $v != "")
	{
		$tab_arr[$k] = $v;
	}
}
	
$tab_g = rex_request('tab','int','');	
if ($tab_g < 0 || $tab_g >= count($tab_arr)) $tab_g = 0;
			
$tab_cnt = '';
$tab_list = '';
$tab_c = 0; // Counter
// $tab_g -> active tab
foreach ($tab_arr as $key => $val)
{
	$link = rex_getUrl('', '', array('tab' => $tab_c));
	$tab_class = '';
	
	if ($tab_g == $tab_c) {
		$tab_cnt = $val;
		$tab_class = 'active ';
	}
	
	if ($tab_c == 0)
		$tab_class = 'tab-frst ';
		
	if ($tab_c == 0 AND $tab_g == $tab_c)
		$tab_class = 'tab-frst-active ';
		
	if (($tab_c+1) == count($tab_arr))
		$tab_class = 'tab-lst ';
		
	if (($tab_c+1) == count($tab_arr) AND $tab_g == $tab_c)
		$tab_class = 'tab-lst-active ';
		
	if (count($tab_arr) == 1)
		$tab_class = 'tab-aln';
	
	$tab_c_active_nxt = $tab_g - 1;
	if ($tab_c == $tab_c_active_nxt)
		$tab_class .= 'active-nxt ';
	
	trim($tab_class);
	if ($tab_class != '') {
		$tab_class = ' class="'.$tab_class.'"';
	}
		
	$tab_list .= '<li'.$tab_class.'><a href="'.rex_getUrl('', '', array('tab' => $tab_c)).'"><span>'.$key.'</span></a></li>';
	$tab_c++;
}
			
print '
	<div class="com-tab">
		<div class="com-tab-navi">
			<ul>
				'.$tab_list.'
			</ul>
		</div>
		
		<div class="com-tab-cntnt">
		<div class="com-tab-cntnt-2">
		<div class="com-tab-cntnt-3">';
if (!isset($REX['TMP']['TAB_CID']) || "REX_ARTICLE_ID" != $REX['TMP']['TAB_CID'])
{
  $REX['TMP']['TAB_CID'] = (int) $tab_cnt;
  $ma = new rex_article;
  $ma->setClang(REX_CLANG_ID);
  if ($ma->setArticleId($tab_cnt)) echo $ma->getArticle();
}else
{
  echo "ERROR: ArticleinArticle";
}
print '
			<div class="clearer"> </div>
		</div>
		</div>
		</div>
	</div>';
?>