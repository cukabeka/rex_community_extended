<?php
/**
 * Codemirror2 be_style Plugin for Redaxo
 *
 * @version 1.3.0
 * @link https://github.com/marijnh/CodeMirror2
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.3.x/4.4.x/4.5.x
 */


// BACKEND ONLY
////////////////////////////////////////////////////////////////////////////////
if(!$REX['REDAXO'] || (rex_request('page','string')=='markitup' && rex_request('subpage','string')=='preview') ){
  return;
}


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$mypage = 'rex_codemirror';

$REX['ADDON']['version'][$mypage]     = '1.3.0';
$REX['ADDON']['author'][$mypage]      = 'jdlx';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';

$REX['ADDON']['page'][$mypage]        = $mypage;
$REX['ADDON']['title'][$mypage]       = 'RexCodemirror';

$REX['ADDON']['BE_STYLE_PAGE_CONTENT'][$mypage] = '
<h2 class="settings"><a href="index.php?page=be_style&amp;subpage='.$mypage.'">'.$REX['ADDON']['title'][$mypage].'</a></h2>
<p>CodeMirror (<a href="https://github.com/marijnh/CodeMirror" target="_blank">Github</a>) von <a href="http://marijnhaverbeke.nl/" target="_blank">Marijn Haverbeke</a> als Redaxo be_style Plugin.</p>
<hr />
';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
/* THEMES:
 * ambiance, blackboard, cobalt, eclipse, elegant, erlang-dark,
 * lesser-dark, monokai, neat, night, rubyblue, vibrant-ink, xq-dark,
 * custom: jdlx
 */
$REX[$mypage]['settings'] = array(
  'theme'          =>'jdlx',
  'keys' => array(
    'enter_fullscreen' => 'F11',
    'leave_fullscreen' => 'Esc',
    ),
  // AUTOENABLED BACKEND PAGES - ANY TEXTAREA WILL GET CODEMIRROR
  'autoenabled_pages' => array(
      array('page'=>'template'),
      array('page'=>'module'),
    ),
  // TRIGGER CLASS - WILL ENABLE CODEMIRROR OUTSIDE AUTOENABLED PAGES
  'trigger_class' => 'rex-codemirror',
  'foldmode'        =>'tagRangeFinder', // @html: tagRangeFinder, @php: braceRangeFinder
  'codemirror_options' => '',
  );


// CHECK IF ENABLED PAGE
////////////////////////////////////////////////////////////////////////////////
$enabled_page = false;
foreach($REX[$mypage]['settings']['autoenabled_pages'] as $def) {
  foreach ($def as $k => $v) {
    $enabled_page = rex_request($k,'string') === $v;
  }
  if($enabled_page){
    break;
  }
}

$REX[$mypage]['settings']['selector'] = $enabled_page
                                      ? 'textarea'
                                      : 'textarea.'.$REX[$mypage]['settings']['trigger_class'];


// INCLUDE JS/CSS ASSETS @ HEAD
////////////////////////////////////////////////////////////////////////////////
$theme = $REX[$mypage]['settings']['theme'];
$header = '

<!-- '.$mypage.' -->
  <link rel="stylesheet" href="../files/addons/be_style/plugins/'.$mypage.'/vendor/lib/codemirror.css">
  <link rel="stylesheet" href="../files/addons/be_style/plugins/'.$mypage.'/vendor/theme/'.$theme.'.css">
  <link rel="stylesheet" href="../files/addons/be_style/plugins/'.$mypage.'/rex_codemirror_backend.css">
<!-- end '.$mypage.' -->
';
rex_register_extension('PAGE_HEADER',
  function($params) use($header){
    return $params['subject'].$header;
  }
);


// CODEMIRROR ENABLER SCRIPT @ BODY END
////////////////////////////////////////////////////////////////////////////////
rex_register_extension('OUTPUT_FILTER',
  function($params) use($REX) {
    $script = '
<!-- rex_codemirror -->
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/lib/codemirror.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/custom/lib/util/foldcode.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/mode/xml/xml.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/mode/javascript/javascript.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/mode/css/css.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/mode/clike/clike.js"></script>
<script src="../files/addons/be_style/plugins/rex_codemirror/vendor/mode/php/php.js"></script>
<script type="text/javascript">
  var RCM_selector   = "'.$REX['rex_codemirror']['settings']['selector'].'";
  var RCM_theme      = "'.$REX['rex_codemirror']['settings']['theme'].'";
  var RCM_extra_keys = {"'.$REX['rex_codemirror']['settings']['keys']['enter_fullscreen'].'": function(cm){setFullScreen(cm, !isFullScreen(cm));}, "'.$REX['rex_codemirror']['settings']['keys']['leave_fullscreen'].'": function(cm){if (isFullScreen(cm)) setFullScreen(cm, false);}};
  var RCM_fold_func  = CodeMirror.newFoldFunction(CodeMirror.'.$REX['rex_codemirror']['settings']['foldmode'].');
</script>
<script src="../files/addons/be_style/plugins/rex_codemirror/rex_codemirror.js"></script>
<!-- end rex_codemirror -->
    ';

    return str_replace('</body>',$script.'</body>',$params['subject']);
  }
);



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

