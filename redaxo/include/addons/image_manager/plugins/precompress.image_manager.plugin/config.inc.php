<?php
/**
* ImageMagick Precompress Plugin for "Image Manager EP" Addon
*
* @author http://rexdev.de
* @link https://github.com/jdlx/precompress.image_manager.plugin
* @link https://github.com/jdlx/image_manager_ep
*
* @package redaxo 4.3.x/4.4.x
* @version 1.5.1
*/


// ADDON IDENTIFIER & ROOT DIR
////////////////////////////////////////////////////////////////////////////////
$myself = 'precompress.image_manager.plugin';
$myroot = $REX['INCLUDE_PATH'].'/addons/image_manager/plugins/'.$myself;


// REX COMMONS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['version'][$myself]     = '1.5.1';
$REX['ADDON']['title'][$myself]       = 'Precompressor';
$REX['ADDON']['author'][$myself]      = 'rexdev.de';
$REX['ADDON']['supportpage'][$myself] = 'forum.redaxo.de';
$REX['ADDON']['perm'][$myself]        = $myself.'[]';
$REX['PERM'][]                        = $myself.'[]';

// SETTINGS
////////////////////////////////////////////////////////////////////////////////
$REX['ADDON']['image_manager']['PLUGIN']['precompress.image_manager.plugin']['cachefile'] = $REX['INCLUDE_PATH'].'/generated/image_manager/precompress.image_manager.plugin_cache.php';
// --- DYN
$REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["trigger_width"]   = 1000;
$REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["trigger_height"]  = 1000;
$REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["path_to_convert"] = '';
$REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["service_url"] = '';
$REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["service_token"] = '';
// --- /DYN


// CHECK PATH TO CONVERT
////////////////////////////////////////////////////////////////////////////////
if($REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["path_to_convert"]=='')
{
  $cmd = 'which convert';
  exec($cmd, $out ,$ret);
  switch($ret)
  {
    case 0:
      $REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["path_to_convert"] = $out[0];
    break;
    case 1:
      $REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]['rex_warning'][] = 'Could not determine path to <code>convert</code> using <code>which convert</code> ..<br />Check if your server does have <code>Imagemagick</code> available and provide path to convert manually.';
      if($REX["ADDON"]["image_manager"]["PLUGIN"]["precompress.image_manager.plugin"]["service_url"]==''){
        return; // NOTHING TO DO .. EXIT
      }
    break;
    default:
  }
}


// INCLUDES
////////////////////////////////////////////////////////////////////////////////
if(!class_exists('rex_socket')){
  require_once($myroot.'/classes/class.rex_socket.inc.php');
}

// MAIN
////////////////////////////////////////////////////////////////////////////////
if(!file_exists($REX['ADDON']['image_manager']['PLUGIN']['precompress.image_manager.plugin']['cachefile']))
{
  refresh_precompress_img_list();
}

rex_register_extension('IMAGE_MANAGER_INIT','precompress_init');
rex_register_extension('MEDIA_ADDED'       ,'refresh_precompress_img_list');
rex_register_extension('MEDIA_UPDATED'     ,'refresh_precompress_img_list');

function precompress_init($params)
{
  if($params['subject']['rex_img_file']!='')
  {
    global $REX;
    $myREX           = $REX['ADDON']['image_manager']['PLUGIN']['precompress.image_manager.plugin'];
    require_once($myREX['cachefile']);

    $trigger_width   = $myREX['trigger_width'];
    $trigger_height  = $myREX['trigger_height'];
    $path_to_convert = $myREX['path_to_convert'];
    $service_url     = $myREX['service_url'];
    $service_token   = $myREX['service_token'];

    $img             = $params['subject']['rex_img_file'];
    $imagepath       = $params['subject']['imagepath'];
    $cachepath       = $params['subject']['cachepath'];

    if(in_array($img,$precompress_img_list))
    {
      $compfile = $cachepath.'image_manager__PRECOMPRESS_'.$img;
      if(!file_exists($compfile))
      {

        // USING IMAGEMAGICK
        ////////////////////////////////////////////////////////////////////////
        if($path_to_convert!='')
        {
          $cmd = $path_to_convert.' -resize "'.$trigger_width.'x'.$trigger_height.'" '.realpath($imagepath).' '.$compfile;
          exec($cmd, $out = array(),$ret);
          if($ret!=0) {
            trigger_error('PRECOMPRESS.IMAGEMANAGER.PLUGIN: exec() returns error "'.$ret.'"', E_USER_WARNING);
          }

        // USING EXTERNAL SERVICE
        ////////////////////////////////////////////////////////////////////////
        }
        elseif($service_url!='')
        {
          try
          {
            $data['name'] = "resize";
            $data['token'] = $service_token;
            $files = array(
                       'file' => array(
                         'path' => realpath($imagepath),
                         'type' => 'application/octet-stream'
                         )
                       );
            $socket = rex_socket::createByUrl($service_url);
            $socket->doPost($data,$files);
            if($socket->getStatus() == 200)
            {
              $socket->writeBodyTo($compfile);
            }
            else
            {
              trigger_error('PRECOMPRESS.IMAGEMANAGER.PLUGIN: rex_socket failed with status: '.$socket->getStatus(), E_USER_WARNING);
            }
          }
          catch(rex_socket_exception $e)
          {
            trigger_error('PRECOMPRESS.IMAGEMANAGER.PLUGIN: rex_socket exception: '.$e->getMessage(), E_USER_WARNING);
          }
        }
      }

      if(file_exists($compfile))
      {
        $params['subject']['imagepath'] = $compfile;
      }
      else
      {
        trigger_error('PRECOMPRESS.IMAGEMANAGER.PLUGIN: could not create precompressed file', E_USER_WARNING);
      }
    }

  }

  return $params['subject'];
}

function refresh_precompress_img_list()
{
  global $REX;

  $myREX           = $REX['ADDON']['image_manager']['PLUGIN']['precompress.image_manager.plugin'];
  $trigger_width   = $myREX['trigger_width'];
  $trigger_height  = $myREX['trigger_height'];
  $cachefile       = $myREX['cachefile'];
  $img_list        = array();

  $db = new rex_sql();
  $db->setQuery('SELECT `filename`
                 FROM `rex_file`
                 WHERE (`width` >='.$trigger_width.'
                     OR `height` >='.$trigger_height.')
                 AND (`filetype`="image/gif"
                   OR `filetype`="image/png"
                   OR `filetype`="image/x-png"
                   OR `filetype`="image/pjpeg"
                   OR `filetype`="image/jpeg"
                   OR `filetype`="image/jpg"
                   OR `filetype`="image/bmp");');
  while($db->hasNext())
  {
    $img_list[] = $db->getValue('filename');
    $db->next();
  }

  rex_put_file_contents($cachefile,'<?php'.PHP_EOL.'$precompress_img_list = '.var_export($img_list,true).PHP_EOL.'?>');
}
