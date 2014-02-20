<?php
/**
* DevPanel Addon
*
* @author http://rexdev.de
* @link   http://www.redaxo.org/de/download/addons/?addon_id=919
*
* @version 0.1
* $MID: settings.inc.php 30 2010-06-21 02:58:00Z jeffe $:
*/

global $REX,$elem_states;

// PANEL ITEMS DISPLAY STATES
////////////////////////////////////////////////////////////////////////////////
require_once($REX['INCLUDE_PATH']. '/addons/dev_panel/cache/elem-states.inc.php');
$elem_states = $REX['ADDON']['dev_panel']['settings']['elem_states'];

echo '<style type="text/css">'.PHP_EOL;
if(is_array($elem_states) && count($elem_states)>0)
{
  foreach($elem_states as $k=>$v)
  {
    echo '#'.$k.' {display:'.$v.';}'.PHP_EOL;
  }
  echo '</style>'.PHP_EOL;
}

// PANEL HEAD
////////////////////////////////////////////////////////////////////////////////
$toggler_class = $elem_states['dev-block']=='block' ? 'opened' : '';

$accesskey_default     = $REX['ADDON']['dev_panel']['settings']['panel_accesskey']['default'];
$accesskey_maximized   = $REX['ADDON']['dev_panel']['settings']['panel_accesskey']['maximized'];
$accesskey_itemscloser = $REX['ADDON']['dev_panel']['settings']['panel_accesskey']['itemscloser'];
$accesskey_default     = $accesskey_default!='' ? 'accesskey="'.$accesskey_default.'"' : '';
$accesskey_maximized   = $accesskey_maximized!='' ? 'accesskey="'.$accesskey_maximized.'"' : '';
$accesskey_itemscloser = $accesskey_itemscloser!='' ? 'accesskey="'.$accesskey_itemscloser.'"' : '';

echo '

<!-- DEV_PANEL -->
<a id="dev-block-toggler" '.$accesskey_default.' class="'.$toggler_class.'">
</a><!-- #dev-block-toggler -->

<div id="dev-block">
  <a id="dev-block-maximizer" '.$accesskey_maximized.'></a>
  <a id="panel-items-closer" '.$accesskey_itemscloser.'></a>
';

// PANEL ITEMS
////////////////////////////////////////////////////////////////////////////////
if($REX['REDAXO']){
  $cache_file = $REX['INCLUDE_PATH'].'/addons/dev_panel/cache/dev_panel_backend.inc.php';
}
else{
  $cache_file = $REX['INCLUDE_PATH'].'/addons/dev_panel/cache/dev_panel_frontend.inc.php';
}
if(!file_exists($cache_file)){
  a919_panel_cacher();
}
include_once($cache_file);


// PANEL BOTTOM
////////////////////////////////////////////////////////////////////////////////
$jquery_core = '<script src="'.$REX['HTDOCS_PATH'].'files/addons/dev_panel/jquery-1.6.1.min.js"></script>';
switch($REX['ADDON']['dev_panel']['settings']['jquery'])
{
  case 0:
    $jquery_core = '';
    break;
  case 1:
    if($REX['REDAXO']) $jquery_core = '';
    break;
  case 2:
    if(!$REX['REDAXO']) $jquery_core = '';
    break;
}

$ajax_url = $REX['REDAXO'] ? 'index.php' : 'redaxo/index.php';

echo '
</div><!-- #dev-block -->

'.$jquery_core.'
<script src="'.$REX['HTDOCS_PATH'].'files/addons/dev_panel/jquery.cookie.js"></script>
<script type="text/javascript">
  var ajax_url = "'.$ajax_url.'";
</script>
<script src="'.$REX['HTDOCS_PATH'].'files/addons/dev_panel/dev_panel.js"></script>
<link rel="stylesheet" type="text/css" href="'.$REX['HTDOCS_PATH'].'files/addons/dev_panel/dev_panel.css" media="screen" />
<style type="text/css">
#dev-block {'.$REX['ADDON']['dev_panel']['settings']['panel_css']['default'].'}
#dev-block.maximized {'.$REX['ADDON']['dev_panel']['settings']['panel_css']['maximized'].'}
</style>
<!-- /DEV_PANEL -->
';
?>
