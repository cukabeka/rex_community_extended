<?php
/**
 * Codemirror2 be_style Plugin for Redaxo
 *
 * @version 1.3.0
 * @link https://github.com/marijnh/CodeMirror2
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.3.x/4.4.x/4.5.x
 */

$error = '';

if ($error != '') {
  $REX['ADDON']['installmsg']['rex_codemirror'] = $error;
} else {
  $REX['ADDON']['install']['rex_codemirror'] = true;
}
