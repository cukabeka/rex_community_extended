<?php
/**
 * navigation_blocks - be_style Plugin for Redaxo
 *
 * @version 0.6.0
 * @package redaxo 4.3.x/4.4.x/4.5.x
 */

if(!$REX['REDAXO']){
  return;
}


$mypage  = 'navigation_blocks';

$REX['ADDON']['version'][$mypage]     = '0.6.0';
$REX['ADDON']['author'][$mypage]      = 'jdlx';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';

$REX['ADDON']['page'][$mypage]        = $mypage;
$REX['ADDON']['title'][$mypage]       = 'Navigation Blocks';

$REX['ADDON']['BE_STYLE_PAGE_CONTENT'][$mypage] = '
<h2 class="settings"><a href="index.php?page=be_style&amp;subpage='.$mypage.'">'.$REX['ADDON']['title'][$mypage].'</a></h2>
<p>Plugin um Addons in eigene Navigations-Blöcke zu gruppieren.</p>
<hr />
';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["navigation_blocks"]["settings"] = array (
  'addon_to_blocks' => 'developer,developer
mysql_tools,developer
dev_panel,developer
__firephp,developer
',
  'block_lang_strings' => 'developer,Developer,Developer',
);
// --- /DYN


// SUBPAGE
////////////////////////////////////////////////////////////////////////////////
rex_register_extension('ADDONS_INCLUDED',
  function($params) use($REX,$mypage){

    if(!isset($REX['ADDON']['page']['be_style'])){
      $REX['ADDON']['page']['be_style'] = 'be_style';
      $REX['ADDON']['name']['be_style'] = 'Backend Style';
    }

    $REX['ADDON']['pages']['be_style'][] = array ($mypage , $REX['ADDON']['plugins']['be_style']['title'][$mypage]);
    $REX['ADDON']['be_style']['SUBPAGES'] = $REX['ADDON']['pages']['be_style'];
    if(rex_request('page', 'string') == 'be_style' && rex_request('subpage', 'string') == $mypage){
      $REX['ADDON']['navigation']['be_style']['path'] = $REX['INCLUDE_PATH'].'/addons/be_style/plugins/'.$mypage.'/pages/index.php';
    }

    rex_register_extension('BE_STYLE_PAGE_CONTENT',
      function($params) use($REX,$mypage){
        return $params['subject'].$REX['ADDON']['plugins']['be_style']['BE_STYLE_PAGE_CONTENT'][$mypage];
      }
    );
  }
);


// MAIN
////////////////////////////////////////////////////////////////////////////////
$blocks = preg_split('@\r\n|\n\r|\n|\r@',$REX["navigation_blocks"]["settings"]['addon_to_blocks']);
foreach($blocks as $line){
  $data = explode(',',$line);
  if(is_array($data) && count($data) == 2){
    $REX['ADDON']['navigation'][trim($data[0])] = array('block' => trim($data[1]));
  }
}

$lang_string = preg_split('@\r\n|\n\r|\n|\r@',$REX["navigation_blocks"]["settings"]['block_lang_strings']);
foreach($lang_string as $line){
  $data = explode(',',$line);
  if(is_array($data) && count($data) > 1){
    $string = isset($data[$REX["CUR_CLANG"]+1]) ? trim($data[$REX["CUR_CLANG"]+1]) : trim($data[1]);
    $I18N->addMsg('navigation_'.$data[0], $string );
  }
}
