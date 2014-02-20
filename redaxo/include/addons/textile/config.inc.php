<?php
/**
 * Textile XT Addon
 *
 * @author markus[dot]staab[at]redaxo[dot]de Markus Staab
 * @author jdlx - https://github.com/jdlx/
 *
 * @package redaxo 4.4.x/4.5.x
 * @version 1.6.2
 */

if($REX['SETUP']){
  return;
}

$mypage = 'textile';

$REX['ADDON']['rxid'][$mypage] = '79';
$REX['ADDON']['name'][$mypage] = 'Textile XT';
$REX['ADDON']['perm'][$mypage] = 'textile[]';
$REX['ADDON']['version'][$mypage] = '1.6.2';
$REX['ADDON']['author'][$mypage] = "Markus Staab, Dean Allen www.textism.com";
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';

$REX['PERM'][]    = 'textile[]';
$REX['EXTPERM'][] = 'textile[help]';
$REX['EXTPERM'][] = 'textile[settings]';

// --- DYN
$REX["ADDON"]["textile"]["settings"]["textile_version"] = '2.5.1_textplugs';
$REX["ADDON"]["textile"]["settings"]["use_caching"] = 1;
// --- /DYN

define('txt_has_unicode', rex_lang_is_utf8());
require_once $REX['INCLUDE_PATH']. '/addons/textile/classes/vendor/'.$REX["ADDON"]["textile"]["settings"]['textile_version'].'/classTextile.php';
require_once $REX['INCLUDE_PATH']. '/addons/textile/functions/function_textile.inc.php';

if ($REX['REDAXO'])
{
  require_once $REX['INCLUDE_PATH'].'/addons/textile/extensions/function_extensions.inc.php';
  require_once $REX['INCLUDE_PATH'].'/addons/textile/functions/function_help.inc.php';

  $I18N->appendFile($REX['INCLUDE_PATH'].'/addons/'.$mypage.'/lang/');

  rex_register_extension('PAGE_HEADER', 'rex_a79_css_add');


  // FLUSH CACHE ONCE USER LOGS IN
  //////////////////////////////////////////////////////////////////////////////
  if (isset($REX['USER']) && $REX['USER'])
  {
    if (!rex_session('textile_cache_flushed', 'bool'))
    {
      rex_a79_flushCache();
      rex_set_session('textile_cache_flushed', true);
    }
  }
  else
  {
    rex_unset_session('textile_cache_flushed');
  }

  // INJECT PAGE "rex_a79_help_overview"
  //////////////////////////////////////////////////////////////////////////////
  if (rex_request('page', 'string') == 'textile' && rex_request('subpage', 'string') == 'rex_a79_help_overview')
  {
    rex_register_extension('PAGE_BODY_ATTR', 'rex_a79_help_overview_body');
    function rex_a79_help_overview_body($params)
    {
      global $REX;
      $REX["PAGE_NO_NAVI"] = true;
      $params['subject']['id'][0] = 'rex-page-linkmap';
      return $params['subject'];
    }

    rex_register_extension('ADDONS_INCLUDED','rex_a79_help_overview_init');
    function rex_a79_help_overview_init()
    {
      global $REX;

      $help_overview = new rex_be_page('Textile Markup Hilfe', array('page'=>'textile', 'subpage'=>'rex_a79_help_overview'));
      $help_overview->setHref('index.php?page=textile&subpage=rex_a79_help_overview');
      $help_overview->setPath($REX['INCLUDE_PATH'].'/addons/textile/pages/rex_a79_help_overview.php');
      $help_overview->setHasNavigation(false);
      $help_overview->setHidden(true);

      $REX['PAGES']['textile'] = $help_overview;
      $REX['ADDON']['navigation']['textile']['path'] = $REX['INCLUDE_PATH'].'/addons/textile/pages/rex_a79_help_overview.php';
    }
  }

}
