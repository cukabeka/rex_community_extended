Outbox = 1
Welche Box soll angezeigt werden:
<br /><?php
$sel = new rex_select;
$sel->setName("VALUE[1]");
$sel->setSize(1);
$sel->addOption("Inbox","0");
$sel->addOption("Outbox","1");
$sel->setSelected("REX_VALUE[1]");
echo $sel->show();
?><br />
