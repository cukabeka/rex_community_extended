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

require $REX['INCLUDE_PATH'] . '/layout/top.php';

rex_title('Textile Markup Hilfe');

echo '
<style>
div#rex-navi-main {display:none;}
div.a79_help_overview {margin-top:4px;}
div.a79_help_overview>h3 {display:none;}
</style>

<div class="rex-addon-output" id="rex-linkmap">
  <h2 class="rex-hl2" style="font-size:1em">Übersicht</h2>
  <div class="rex-addon-content">
    <div class="">
    ';

rex_a79_help_overview();

echo '
    </div>
  </div>
</div>';

require $REX['INCLUDE_PATH'] . '/layout/bottom.php';
