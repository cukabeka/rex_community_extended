<?php
/**
 * rex_select2 - Select2 JS as Redaxo be_style Plugin
 *
 * @version 1.1.0
 * @link http://ivaynberg.github.com/select2/
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.4.x/4.5.x
 */

$mypage         = 'rex_select2';
$myparrent      = 'be_style';
$minimum_REX    = '4.4.0';
$minimum_PHP    = '4';


// CHECK INSTALL AS PLUGIN
////////////////////////////////////////////////////////////////////////////////
if(!isset($ADDONSsic) || !isset($ADDONSsic['plugins']['be_style']['install'][$mypage])) {
  $REX['ADDON']['installmsg'][$myself] .= $mypage.' is not an Addon - it\'s a '.$myparrent.' Plugin!';
  $REX['ADDON']['install'][$myself] = 0;
  return;
}


// CHECK REDAXO VERSION
////////////////////////////////////////////////////////////////////////////////
if(version_compare($REX['VERSION'].'.'.$REX['SUBVERSION'].'.'.$REX['MINORVERSION'], $minimum_REX, '<'))
{
  $REX['ADDON']['installmsg'][$mypage] = 'Requires Redaxo '.$minimum_REX.' or higher.';
  $REX['ADDON']['install'][$mypage] = 0;
  return;
}


// CHECK PHP VERSION
////////////////////////////////////////////////////////////////////////////////
if(version_compare(PHP_VERSION, $minimum_PHP, '<'))
{
  $REX['ADDON']['installmsg'][$mypage] = 'Requires PHP '.$minimum_PHP.' or higher.';
  $REX['ADDON']['install'][$mypage] = 0;
  return;
}

$REX['ADDON']['install'][$mypage] = 1;
