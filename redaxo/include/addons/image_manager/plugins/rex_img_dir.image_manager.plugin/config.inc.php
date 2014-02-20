<?php
/**
* Custom Folder Plugin for image_manager Addon
*
* @package redaxo 4.3.x/4.4.x
* @version 0.2.15
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'rex_img_dir.image_manager.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/image_manager/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$Revision = '';
$REX['ADDON'][$myself]['VERSION'] = array
(
'VERSION'      => 0,
'MINORVERSION' => 2,
'SUBVERSION'   => 15
);
$REX['ADDON']['version'][$myself]     = implode('.', $REX['ADDON'][$myself]['VERSION']);
$REX['ADDON']['title'][$myself]       = 'Image Directory';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';


// DYN SETTINGS
////////////////////////////////////////////////////////////////////////////////
// --- DYN
$REX["ADDON"]["image_manager"]["PLUGIN"]["rex_img_dir.image_manager.plugin"]["img_dirs"] = array (
  1 => 'files/addons/image_manager/plugins/rex_img_dir.image_manager.plugin',
);
// --- /DYN


// MAIN
////////////////////////////////////////////////////////////////////////////////
if(isset($_GET['rex_img_dir']))
{
  rex_register_extension('IMAGE_MANAGER_INIT','rex_img_dir_init');

  function rex_img_dir_init($params)
  {
    global $REX;

    $img_dir_id  = rex_get('rex_img_dir','int');
    $img_dirs    = $REX['ADDON']['image_manager']['PLUGIN']['rex_img_dir.image_manager.plugin']['img_dirs'];

    if(isset($img_dirs[$img_dir_id]))
    {
      $newpath   = $img_dirs[$img_dir_id];
      $oldpath   = $params['subject']['imagepath'];
      $params['subject']['imagepath'] = str_replace('files',$newpath,$oldpath);
    }

    return $params['subject'];
  }

}
