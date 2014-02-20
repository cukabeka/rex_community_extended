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

// ADDON IDENTIFIER AUS ORDNERNAMEN ABLEITEN
////////////////////////////////////////////////////////////////////////////////
$myself = 'dev_panel';
$myroot = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/';

// ADDON VERSION
////////////////////////////////////////////////////////////////////////////////
$Revision = '';
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 1,
'SUBVERSION'   => preg_replace('/[^0-9]/','',"$Revision$")
);

// ADDON REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['rxid'][$myself]        = '919';
$REX['ADDON']['page'][$myself]        = $myself;
$REX['ADDON']['name'][$myself]        = 'DevPanel';
$REX['ADDON']['version'][$myself]     = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';

// DYNAMISCHE SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["dev_panel"]["settings"]["activity"] = 3;
$REX["ADDON"]["dev_panel"]["settings"]["panel-list"] = array (
  0 => '10',
  1 => '1',
  2 => '2',
  3 => '3',
  4 => '4',
  5 => '5',
  6 => '6',
  7 => '7',
);
$REX["ADDON"]["dev_panel"]["settings"]["panel_accesskey"] = array (
  'default' => 'd',
  'maximized' => 'f',
  'itemscloser' => 'a',
);
$REX["ADDON"]["dev_panel"]["settings"]["panel_css"] = array (
  'default' => 'width:33%;max-height:97%;',
  'maximized' => 'width:auto;left:0;height:100%;',
);
$REX["ADDON"]["dev_panel"]["settings"]["jquery"] = 1;
// --- /DYN

// HIDDEN SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['settings']['rex_list_pagination'] = 20;

// FUNCTIONS & CLASSES
////////////////////////////////////////////////////////////////////////////////
require_once($myroot.'functions/function.rexdev_incparse.inc.php');
function a919_panel_cacher()
{
  global $REX;

  // GET ELEM STATES VAR
  //require_once($REX['INCLUDE_PATH']. '/addons/dev_panel/cache/elem-states.inc.php');

  // GET PANEL ITEMS FROM DB
  $frontend_file = $REX['INCLUDE_PATH'].'/addons/dev_panel/cache/dev_panel_frontend.inc.php';
  $backend_file  = $REX['INCLUDE_PATH'].'/addons/dev_panel/cache/dev_panel_backend.inc.php';
  $frontend = $backend = $tmp = '';

  $x = new rex_sql;
  $a = $x->getDBArray('SELECT * FROM `rex_919_panel_items` WHERE `checked`=\'1\' ORDER BY `prio` ASC');
  foreach($a as $k=>$v)
  {
    switch($v['type'])
    {
      case 1:
      $tmp = '
<div class="panel-wrapper-'.$v['id'].'">
  <h2><a class="toggler">'.$v['name'].'</a></h2>
  <div id="panel-'.$v['id'].'" class="toggle-block">
  '.$v['code'].'
  </div><!-- #panel-'.$v['id'].' -->
</div><!-- .panel-wrapper-'.$v['id'].' -->
';
      $tmp = str_replace('###ID###',$v['id'],$tmp);
      break;
      case 2:
      $tmp = '
<div class="panel-wrapper-'.$v['id'].'">
  <h2><span class="edit-var"></span><span class="save-var" style="display:none;"></span><input type="text" class="toggler" id="panel-var-'.$v['id'].'" size="'.(strlen($v['name'])+1).'" readonly="readonly" value="'.$v['name'].'" /></h2>
  <div id="panel-'.$v['id'].'" class="toggle-block">
  <?php
  if(isset('.$v['name'].')) {
  echo "<pre>".var_export('.$v['name'].', true)."</pre>";
  }else{
  echo "undefinded";
  }
  ?>
  </div><!-- #panel-'.$v['id'].' -->
</div><!-- .panel-wrapper-'.$v['id'].' -->
';
      $tmp = str_replace('###ID###',$v['id'],$tmp);
      break;
      default:
        $tmp = $v['code'];
    }

    if($v['rex_redaxo']=='3')
    {
      $frontend .= $tmp;
      $backend  .= $tmp;
    }
    elseif($v['rex_redaxo']=='1')
    {
      $frontend .= $tmp;
    }
    else
    {
      $backend  .= $tmp;
    }
  }
  rex_put_file_contents($frontend_file,$frontend);
  rex_put_file_contents($backend_file,$backend);
}

// SUBPAGES
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON'][$myself]['SUBPAGES'] = array (
  //     subpage    ,label                         ,perm   ,params               ,attributes
  array (''         ,'Einstellungen'               ,''     ,''                   ,''),
  array ('database' ,'Panel Items'                 ,''     ,''                   ,''),
  //array ('help'     ,'Hilfe'                       ,''     ,''                   ,''),
);


// OPF
////////////////////////////////////////////////////////////////////////////////
$activity = $REX['ADDON']['dev_panel']['settings']['activity'];
if(
   (!$REX['REDAXO'] && ($activity==1 || $activity==3)) ||
   ($REX['REDAXO']  && ($activity==2 || $activity==3))
  )
{
  if(!isset($_SESSION))
  {
    session_start();
  }
  if(isset($_SESSION[$REX['INSTNAME']]['UID']) && $_SESSION[$REX['INSTNAME']]['UID']==1)
  {
    rex_register_extension('OUTPUT_FILTER', 'dev_panel_opf');

    function dev_panel_opf($params)
    {
      global $REX;
      $panel = get_include_contents($REX['INCLUDE_PATH'].'/addons/dev_panel/pages/dev_panel.inc.php');
      $params['subject'] = str_replace('</body>','</body>'.$panel,$params['subject']);
      return $params['subject'];
  }
  }
}


// RUN CACHER ON DB CHANGES
////////////////////////////////////////////////////////////////////////////////
if ($REX['REDAXO'])
{
  rex_register_extension('REX_FORM_SAVED','a919_update_cache');
  function a919_update_cache($params)
  {
    //FB::log($params,'REX_FORM_SAVED:');
    a919_panel_cacher();
  }
}