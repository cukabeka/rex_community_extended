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

function rex_a79_textile($code, $restricted=false, $doctype='xhtml')
{
  // DO CACHING IF NO BACKEND SESSION AND CACHING ENABLED
  if(rex_a79_useCache())
  {
    $cachefile = rex_a79_cacheFilePath($code, $restricted=false, $doctype='xhtml');

    if(file_exists($cachefile))
    {
      return rex_get_file_contents($cachefile);
    }
  }

  $textile = rex_a79_textile_instance($doctype);

  $textile = $restricted==false
           ? $textile->TextileThis($code)
           : $textile->TextileRestricted($code);

  if(isset($cachefile))
  {
    rex_put_file_contents($cachefile, $textile);
  }

  return $textile;
}


function rex_a79_textile_instance($doctype='xhtml')
{
  static $instance = array();

  if(!isset($instance[$doctype]))
  {
    $instance[$doctype] = new Textile($doctype);
    $instance[$doctype]->unrestricted_url_schemes[] = 'redaxo';
  }

  return $instance[$doctype];
}


function rex_a79_cacheFilePath($code, $restricted=false, $doctype='xhtml')
{
  global $REX;
  $restricted = !$restricted ? 'false' : 'true';
  $basefolder = $REX['INCLUDE_PATH'].'/generated/textile/clang_'.$REX['CUR_CLANG'].'/';
  if(!file_exists($basefolder)){
    mkdir($basefolder, $REX['DIRPERM'], true);
  }
  return $basefolder.md5($code.$restricted.$doctype).'.html';
}


function rex_a79_flushCache()
{
  global $REX;
  rex_deleteDir($REX['INCLUDE_PATH'].'/generated/textile/', true);
}


function rex_a79_useCache()
{
  global $REX;
  return (!rex_a79_activeBackendUser() && $REX["ADDON"]["textile"]["settings"]["use_caching"]==1);
}


function rex_a79_activeBackendUser()
{
  global $REX;
  if($REX['REDAXO'])
  {
    return (isset($REX['USER']) && $REX['USER']);
  }
  else
  {
    return (isset($_SESSION[$REX['INSTNAME']]['UID']) && $_SESSION[$REX['INSTNAME']]['UID']>0);
  }
}


