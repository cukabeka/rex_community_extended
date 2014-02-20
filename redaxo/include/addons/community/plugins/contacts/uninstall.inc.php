<?php

/**
 * COM - Plugin - Messages
 * @author jan.kristinus[at]redaxo[dot]de Jan Kristinus
 * @author <a href="http://www.yakamara.de">www.yakamara.de</a>
 */

$sql = new rex_sql();
$sql->setQuery("DROP TABLE `rex_com_contact`");
$sql->setQuery('SHOW TABLE STATUS LIKE "rex_com_contact"');

if ($sql->getRows() == 1)
{
	$REX['ADDON']['plugins']['community']['contacts']['install'] = 1;
	$REX['ADDON']['plugins']['community']['contacts']['installmsg'] = 'Tabelle "rex_com_contact" konnte nicht gel�scht werden';
}else
{
	$REX['ADDON']['plugins']['community']['contacts']['install'] = 0;
}

?>