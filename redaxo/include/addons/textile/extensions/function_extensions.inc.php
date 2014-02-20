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


/**
 * Fügt die benötigen Stylesheets ein
 *
 * @param $params Extension-Point Parameter
 */
function rex_a79_css_add($params)
{
  $addon = 'textile';

  $params['subject'] .= "\n  ".
    '<link rel="stylesheet" type="text/css" href="../files/addons/'.$addon.'/textile.css" />';

  return $params['subject'];
}
