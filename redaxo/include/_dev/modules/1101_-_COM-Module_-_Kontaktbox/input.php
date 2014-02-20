<?php
$g = new rex_select;
$g->setName("VALUE[1]");
$g->addOption("Best&#x2030;tigte Kontakte",0);
$g->addOption("Unbest&#x2030;tigte Kontakte",1);
$g->addOption("Zu best&#x2030;tigende Kontakte",2);
$g->setSelected("REX_VALUE[1]");
$g->setSize(1);
echo $g->show();
?><br />
