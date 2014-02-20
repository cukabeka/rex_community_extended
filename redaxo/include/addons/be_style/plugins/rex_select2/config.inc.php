<?php
/**
 * rex_select2 - Select2 JS as Redaxo be_style Plugin
 *
 * @version 1.1.0
 * @link http://ivaynberg.github.com/select2/
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.4.x/4.5.x
 */

// BACKEND ONLY
////////////////////////////////////////////////////////////////////////////////
if(!$REX['REDAXO']){
  return;
}


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$mypage = 'rex_select2';

$REX['ADDON']['version'][$mypage]     = '1.1.0';
$REX['ADDON']['author'][$mypage]      = 'jdlx';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';

$REX['ADDON']['page'][$mypage]        = $mypage;
$REX['ADDON']['title'][$mypage]       = 'RexSelect2';

$REX['ADDON']['BE_STYLE_PAGE_CONTENT'][$mypage] = '
<h2 class="settings"><a href="index.php?page=be_style&amp;subpage='.$mypage.'">'.$REX['ADDON']['title'][$mypage].'</a></h2>
<p>Select2 (<a href="https://github.com/ivaynberg/select2" target="_blank">Github</a>) von <a href="https://github.com/ivaynberg" target="_blank">Igor Vaynberg</a> als Redaxo be_style Plugin.</p>
<hr />
';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["rex_select2"]["settings"] = array (
  'trigger_class' => 'rex-select2',
  'js_options' => 'width:                   "copy",
loadMorePadding:         0,
closeOnSelect:           true,
openOnEnter:             true,
containerCss:            {},
dropdownCss:             {},
containerCssClass:       "",
dropdownCssClass:        "",
minimumResultsForSearch: 0,
minimumInputLength:      0,
maximumInputLength:      null,
maximumSelectionSize:    0,
separator:               ",",
tokenSeparators:         [],
tokenizer:               defaultTokenizer,
blurOnChange:            false,
selectOnBlur:            false',
);
// --- /DYN



// INCLUDE HEAD ASSETS
$head = '
<!-- '.$mypage.' -->
  <link rel="stylesheet" type="text/css" href="../files/addons/be_style/plugins/'.$mypage.'/vendor/ivaynberg/select2.css" media="screen, projection, print" />
<!-- /'.$mypage.' -->
';
$head_include = 'return $params["subject"].\''.$head.'\';';
rex_register_extension('PAGE_HEADER', create_function('$params',$head_include));


// INCLUDE BODY ASSETS
$body = '
<!-- '.$mypage.' -->
  <script src="../files/addons/be_style/plugins/'.$mypage.'/vendor/ivaynberg/select2.js" type="text/javascript"></script>
  <script>
    jQuery(function($){
      $("select.'.$REX[$mypage]['settings']['trigger_class'].'").each(function(){
        $(this).select2({'.$REX[$mypage]['settings']['js_options'].'});
      })
    });
  </script>
<!-- /'.$mypage.' -->
';
$body_include = 'return str_replace("</body", \''.$body.'</body\', $params["subject"]);';
rex_register_extension('OUTPUT_FILTER', create_function('$params',$body_include));


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

