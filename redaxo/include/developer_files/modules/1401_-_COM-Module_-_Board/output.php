<div class="com-board"><?php
$board = new rex_com_board;
if (isset($REX["COM_USER"]) AND $REX["COM_USER"]->getValue("admin")==1) $board->setAdmin(true);
$board->setArticleId("REX_ARTICLE_ID");
$board->setBoardname("REX_VALUE[1]");
$board->setRealBoardname("REX_VALUE[2]");
if ("REX_VALUE[7]" != "user") $board->setAnonymous(true);
elseif (isset($REX["COM_USER"]) AND $REX["COM_USER"]->getValue("status")>0) $board->setUser($REX["COM_USER"]->getValue("login"));

$board->setFormPostAction("index.php");
echo $board->showBoard();
?></div>
