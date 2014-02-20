<?php
/**
* DevPanel Addon
*
* @author http://rexdev.de
* @link   http://www.redaxo.org/de/download/addons/?addon_id=919
*
* @version 0.1
* $Id$:
*/

// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$myself    = rex_request('page',    'string');
$subpage   = rex_request('subpage', 'string');
$func      = rex_request('func', 'string');
$json      = rex_request('json', 'string');
$addonroot = $REX['INCLUDE_PATH']. '/addons/'.$myself.'/';

// MAIN
////////////////////////////////////////////////////////////////////////////////
switch($func)
{
  case 'elem-state-save':
    require_once($addonroot.'cache/elem-states.inc.php');
    $new = get_object_vars(json_decode(stripslashes($json)));
    foreach($new as $k=>$v)
    {
      $REX['ADDON']['dev_panel']['settings']['elem_states'][$k] = $v;
    }
    $file = $addonroot.'cache/elem-states.inc.php';
    $content = '$REX["ADDON"]["dev_panel"]["settings"]["elem_states"] = '.var_export($REX['ADDON']['dev_panel']['settings']['elem_states'],true).';';
    rex_replace_dynamic_contents($file, $content);
    break;

  case 'collapse-all-panels':
    require_once($addonroot.'cache/elem-states.inc.php');
    foreach($REX['ADDON']['dev_panel']['settings']['elem_states'] as $k=>$v)
    {
      if(preg_match('|panel-[0-9]+|',$k))
      {
        $REX['ADDON']['dev_panel']['settings']['elem_states'][$k] = 'none';
      }
    }
    $file = $addonroot.'cache/elem-states.inc.php';
    $content = '$REX["ADDON"]["dev_panel"]["settings"]["elem_states"] = '.var_export($REX['ADDON']['dev_panel']['settings']['elem_states'],true).';';
    rex_replace_dynamic_contents($file, $content);
    break;

  case 'elem-prio-save':
    $json = json_decode(stripslashes($json));
    $x = new rex_sql;
    $prio = 1;
    foreach($json as $obj)
    {
      $id      = str_replace('panel_','',$obj->id);
      $checked = $obj->checked;
      $x->setQuery('UPDATE `rex_919_panel_items` SET `prio` = \''.$prio.'\', `checked` = \''.$checked.'\'  WHERE `id` =\''.$id.'\'');
      $prio++;
    }
    break;

  case 'new-var-save':
    $json = json_decode(stripslashes($json));
    $id   = str_replace('panel-var-','',$json->id);
    $var  = addslashes($json->new_var);
    $x = new rex_sql;
    $x->setQuery('UPDATE `rex_919_panel_items` SET `name`=\''.$var.'\' WHERE `id`=\''.$id.'\'');
    a919_panel_cacher();
    break;
}