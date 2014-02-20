<?php
/**
 * navigation_blocks - be_style Plugin for Redaxo
 *
 * @version 0.6.0
 * @package redaxo 4.3.x/4.4.x/4.5.x
 */

$error = '';

if ($error != '') {
  $REX['ADDON']['installmsg']['navigation_blocks'] = $error;
} else {
  $REX['ADDON']['install']['navigation_blocks'] = true;
}
