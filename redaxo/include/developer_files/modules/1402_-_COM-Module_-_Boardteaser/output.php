<?php
if(OOAddon::isAvailable('textile'))
{
	$text = '';
	if(REX_IS_VALUE[1])
	{
	
$input =<<< EOT123451827235
REX_HTML_VALUE[1]
EOT123451827235;
	
		$board_id = 'REX_VALUE[2]';
		$gt = new rex_sql();
		$gt->debugsql = 0;
		$gt->setQuery('select count(message_id) as c from rex_com_board where board_id="REX_VALUE[2]" and status=1');
		$input = str_replace("###board-eintraege###",$gt->getValue("c"),$input);
		$gt->setQuery('select count(message_id) as c from rex_com_board where board_id="REX_VALUE[2]" and status=1 and re_message_id=0');
		$input = str_replace("###board-themen###",$gt->getValue("c"),$input);
		// $text = str_replace("###","&amp;#x20;",$text);
		$textile = new Textile(); 
		$input = $textile->TextileThis($input);
	} 
	
	print '<div class="txt-img rex-com-boardteaser">'. $input. '</div>';
}else
{
	echo rex_warning('Dieses Modul ben&#x02c6;tigt das "textile" Addon!');
}
?>