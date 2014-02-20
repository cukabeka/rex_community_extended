<?php
/**
 * harvesthq_chosen - Chosen JS as Redaxo be_style Plugin
 *
 * @version 1.0.4
 * @link https://github.com/harvesthq/chosen/
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.3.x/4.4.x
 */

// BACKEND ONLY
////////////////////////////////////////////////////////////////////////////////
if(!$REX['REDAXO']){
  return;
}

$mypage = 'harvesthq_chosen';

$REX['ADDON']['version'][$mypage]     = '1.0.4';
$REX['ADDON']['author'][$mypage]      = 'jdlx';
$REX['ADDON']['supportpage'][$mypage] = 'forum.redaxo.de';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX[$mypage]['settings'] = array(
  'auto_enabler_class' =>'rex-chosen',
  );


// INCLUDE HEAD ASSETS
$head = '
<!-- '.$mypage.' -->
  <link rel="stylesheet" type="text/css" href="../files/addons/be_style/plugins/'.$mypage.'/vendor/harvesthq/chosen/chosen.css" media="screen, projection, print" />
<!-- /'.$mypage.' -->
';
$head_include = 'return $params["subject"].\''.$head.'\';';
rex_register_extension('PAGE_HEADER', create_function('$params',$head_include));


// INCLUDE BODY ASSETS
$body = '
<!-- '.$mypage.' -->
  <script src="../files/addons/be_style/plugins/'.$mypage.'/vendor/harvesthq/chosen/chosen.jquery.min.js" type="text/javascript"></script>
  <script>
    jQuery(function($){
      $("select.'.$REX[$mypage]['settings']['auto_enabler_class'].'").each(function(){
        $(this).chosen();
      })
    });
  </script>
<!-- /'.$mypage.' -->
';
$body_include = 'return str_replace("</body", \''.$body.'</body\', $params["subject"]);';
rex_register_extension('OUTPUT_FILTER', create_function('$params',$body_include));
