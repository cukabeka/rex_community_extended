Boardbezeichnung/ Allgemeiner Titel:
<br /><input type=text size=50 name="VALUE[2]" value="REX_VALUE[2]" />
<br /><br />Datenbankbezeichnung (nur kleine Buchstaben verwenden):
<br /><input type=text size=50 name="VALUE[1]" value="REX_VALUE[1]" />
<br /><br /><?
$se = new rex_select;
$se->setName("VALUE[7]");
$se->setSize(1);
$se->addOption("Anonym","anonym");
$se->addOption("Nur eingeloggte User","user");
$se->setSelected("REX_VALUE[7]");
echo $se->show();
?><br /><br />