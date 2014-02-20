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
$myself   = rex_request('page', 'string');
$subpage  = rex_request('subpage', 'string');
$faceless = rex_request('faceless', 'string');

if($faceless != 1)
{

  // BACKEND CSS
  ////////////////////////////////////////////////////////////////////////////////
  if ($REX['REDAXO']) {
    rex_register_extension('PAGE_HEADER', 'a919_backend_header');

    function a919_backend_header($params)
    {
      $params['subject'] .=
        PHP_EOL.'  <!-- DevPanel -->'.
        PHP_EOL.'  <link rel="stylesheet" type="text/css" href="../files/addons/dev_panel/backend.css" media="screen, projection, print" />'.
        PHP_EOL.'  <!-- /DevPanel -->'.PHP_EOL;

      return $params['subject'];
    }
  }

  // REX BACKEND LAYOUT TOP
  //////////////////////////////////////////////////////////////////////////////
  require $REX['INCLUDE_PATH'] . '/layout/top.php';

  // TITLE & SUBPAGE NAVIGATION
  //////////////////////////////////////////////////////////////////////////////
  rex_title($REX['ADDON']['name'][$myself].' <span class="addonversion">'.$REX['ADDON']['version'][$myself].'</span>', $REX['ADDON'][$myself]['SUBPAGES']);

  // INCLUDE REQUESTED SUBPAGE
  //////////////////////////////////////////////////////////////////////////////
  if(!$subpage)
  {
    $subpage = 'settings';  /* DEFAULT SUBPAGE */
  }

  require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';

  // JS SCRIPT FÜR LINKS IN NEUEN FENSTERN (per <a class="jsopenwin">)
  ////////////////////////////////////////////////////////////////////////////////
  echo '
  <script type="text/javascript">
  // onload
  window.onload = externalLinks;

  // http://www.sitepoint.com/article/standards-compliant-world
  function externalLinks()
  {
   if (!document.getElementsByTagName) return;
   var anchors = document.getElementsByTagName("a");
   for (var i=0; i<anchors.length; i++)
   {
     var anchor = anchors[i];
     if (anchor.getAttribute("href"))
     {
       if (anchor.getAttribute("class") == "jsopenwin")
       {
       anchor.target = "_blank";
       }
     }
   }
  }
  </script>
  ';

  // REX BACKEND LAYOUT BOTTOM
  //////////////////////////////////////////////////////////////////////////////
  require $REX['INCLUDE_PATH'] . '/layout/bottom.php';
}
else
{
  require $REX['INCLUDE_PATH'] . '/addons/'.$myself.'/pages/'.$subpage.'.inc.php';
}
