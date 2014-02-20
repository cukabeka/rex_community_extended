<?php
/**
 * extended_corepages - Redaxo be_style Plugin
 *
 * @version 1.2.1
 * @package redaxo 4.4.x/4.5.x
 */

$error = '';

if ($error != '') {
  $REX['ADDON']['installmsg']['extended_corepages'] = $error;
} else {
  $REX['ADDON']['install']['extended_corepages'] = true;
}
