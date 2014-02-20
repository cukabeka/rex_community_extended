<?php

/**
 * Addonlist
 * @package redaxo4
 * @version svn:$Id$
 */

// ----------------- addons
unset($REX['ADDON']);
$REX['ADDON'] = array();

// ----------------- DONT EDIT BELOW THIS
// --- DYN
$REX['ADDON']['install']['__firephp'] = '0';
$REX['ADDON']['status']['__firephp'] = '0';

$REX['ADDON']['install']['addcode'] = '0';
$REX['ADDON']['status']['addcode'] = '0';

$REX['ADDON']['install']['be_search'] = '1';
$REX['ADDON']['status']['be_search'] = '1';

$REX['ADDON']['install']['be_style'] = '1';
$REX['ADDON']['status']['be_style'] = '1';

$REX['ADDON']['install']['community'] = '1';
$REX['ADDON']['status']['community'] = '1';

$REX['ADDON']['install']['cronjob'] = '0';
$REX['ADDON']['status']['cronjob'] = '0';

$REX['ADDON']['install']['dev_panel'] = '0';
$REX['ADDON']['status']['dev_panel'] = '0';

$REX['ADDON']['install']['developer'] = '1';
$REX['ADDON']['status']['developer'] = '1';

$REX['ADDON']['install']['image_manager'] = '1';
$REX['ADDON']['status']['image_manager'] = '1';

$REX['ADDON']['install']['import_export'] = '1';
$REX['ADDON']['status']['import_export'] = '1';

$REX['ADDON']['install']['ko_debug'] = '1';
$REX['ADDON']['status']['ko_debug'] = '1';

$REX['ADDON']['install']['markitup'] = '1';
$REX['ADDON']['status']['markitup'] = '1';

$REX['ADDON']['install']['metainfo'] = '1';
$REX['ADDON']['status']['metainfo'] = '1';

$REX['ADDON']['install']['mform'] = '0';
$REX['ADDON']['status']['mform'] = '0';

$REX['ADDON']['install']['mysql_tools'] = '0';
$REX['ADDON']['status']['mysql_tools'] = '0';

$REX['ADDON']['install']['phpmailer'] = '1';
$REX['ADDON']['status']['phpmailer'] = '1';

$REX['ADDON']['install']['rex_multiupload'] = '0';
$REX['ADDON']['status']['rex_multiupload'] = '0';

$REX['ADDON']['install']['rexsearch'] = '0';
$REX['ADDON']['status']['rexsearch'] = '0';

$REX['ADDON']['install']['rexseo'] = '1';
$REX['ADDON']['status']['rexseo'] = '0';

$REX['ADDON']['install']['slice_status'] = '0';
$REX['ADDON']['status']['slice_status'] = '0';

$REX['ADDON']['install']['textile'] = '1';
$REX['ADDON']['status']['textile'] = '1';

$REX['ADDON']['install']['version'] = '0';
$REX['ADDON']['status']['version'] = '0';

$REX['ADDON']['install']['xform'] = '1';
$REX['ADDON']['status']['xform'] = '1';

$REX['ADDON']['install']['xoutputfilter'] = '0';
$REX['ADDON']['status']['xoutputfilter'] = '0';
// --- /DYN
// ----------------- /DONT EDIT BELOW THIS

require $REX['INCLUDE_PATH']. '/plugins.inc.php';

foreach(OOAddon::getAvailableAddons() as $addonName)
{
  $addonConfig = rex_addons_folder($addonName). 'config.inc.php';
  if(file_exists($addonConfig))
  {
    require $addonConfig;
  }

  foreach(OOPlugin::getAvailablePlugins($addonName) as $pluginName)
  {
    $pluginConfig = rex_plugins_folder($addonName, $pluginName). 'config.inc.php';
    if(file_exists($pluginConfig))
    {
      rex_pluginManager::addon2plugin($addonName, $pluginName, $pluginConfig);
    }
  }
}

// ----- all addons configs included
rex_register_extension_point('ADDONS_INCLUDED');