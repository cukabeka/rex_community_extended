<?php
/**
 * Metafix - Metainfo Plugin
 *
 * @author http://rexdev.de
 * @see https://github.com/jdlx/metafix
 *
 * @package redaxo 4.3.x/4.4.x
 * @version 1.0.0
 */

$mypage = 'metafix';
$myroot = $REX['INCLUDE_PATH'].'/addons/metainfo/plugins/'.$mypage;

$REX['ADDON']['perm'][$mypage] = 'admin[]';
$REX['ADDON']['version'][$mypage] = "1.0.0";
$REX['ADDON']['author'][$mypage] = "jdlx / rexdev.de";
$REX['ADDON']['supportpage'][$mypage] = 'redaxo.org/de/forum/search.php?keywords=metafix';

// MAIN
////////////////////////////////////////////////////////////////////////////////
rex_register_extension('ADDONS_INCLUDED', 'metafix_init');
function metafix_init($params)
{
  global $REX;

  // SNEAK INTO METAINFO SUBPAGES
  //////////////////////////////////////////////////////////////////////////////
  $REX['ADDON']['pages']['metainfo'][] = array ('metafix' , 'Metafix');
  $REX['ADDON']['metainfo']['SUBPAGES'] = $REX['ADDON']['pages']['metainfo'];
  unset($REX['ADDON']['pages']['metainfo']);
  if (rex_request('page', 'string') == 'metainfo' && rex_request('subpage', 'string') == 'metafix')
  {
    $REX['ADDON']['navigation']['metainfo']['path'] = $REX['INCLUDE_PATH'].'/addons/metainfo/plugins/metafix/pages/index.inc.php';
  }

  // INJECT REASIGN JS
  //////////////////////////////////////////////////////////////////////////////
  $page    = rex_request('page'   , 'string');
  $func    = rex_request('func'   , 'string');
  $reasign = rex_request('reasign', 'string','none');
  if($page==='metainfo' && $func==='edit' && $reasign!=='none')
  {
    rex_register_extension('OUTPUT_FILTER','metafix_opf');
    function metafix_opf($params)
    {
      $js = '
<script>
  jQuery("#rex_62_params_Feld_bearbeiten_erstellen_name").val("'.rex_request('reasign', 'string').'");
  jQuery("#rex_62_params_Feld_bearbeiten_erstellen_name").attr("readonly", true);
  jQuery("#rex_62_params_Feld_bearbeiten_erstellen_name").css({
    borderColor:"silver",
    color:"gray"
    });
</script>
';
      return str_replace('</body>',$js.'</body>',$params['subject']);
    }
  }

}
