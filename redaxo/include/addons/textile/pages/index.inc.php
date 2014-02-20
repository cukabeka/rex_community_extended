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


$mypage    = rex_request('page'   , 'string');
$subpage   = rex_request('subpage', 'string');
$minorpage = rex_request('minorpage', 'string');
$func      = rex_request('func'   , 'string');


require $REX['INCLUDE_PATH'].'/layout/top.php';

rex_title('Textile XT <span>'.$REX['ADDON']['version'][$mypage].'</span>');

// SAVE SETTINGS
////////////////////////////////////////////////////////////////////////////////
if($func=='savesettings')
{
  $textile_version = rex_request('textile_version','string','2.4.1');
  $use_caching     = rex_request('use_caching','int',1);
  $config = $REX['INCLUDE_PATH'].'/addons/textile/config.inc.php';
  $DYN = '$REX["ADDON"]["textile"]["settings"]["textile_version"] = \''.$textile_version.'\';'.PHP_EOL.
         '$REX["ADDON"]["textile"]["settings"]["use_caching"] = '.$use_caching.';';

  if(rex_replace_dynamic_contents($config, $DYN)) {
    $REX["ADDON"]["textile"]["settings"]["textile_version"] = $textile_version;
    $REX["ADDON"]["textile"]["settings"]["use_caching"]     = $use_caching;
    echo rex_info('Einstellungen wurden gespeichert.');
  } else {
    echo rex_warning('Beim speichern der Einstellungen ist ein Problem aufgetreten.');
  }
}


$mdl_help = '<?php rex_a79_help_overview(); ?>';


$mdl_ex ='<?php
if(OOAddon::isAvailable("textile"))
{
  if(REX_IS_VALUE[1])
  {
    $textile = htmlspecialchars_decode(\'REX_VALUE[1]\',ENT_QUOTES);
    $textile = str_replace(\'<br />\',\'\',$textile);
    echo rex_a79_textile($textile);

    // OPTIONEN:
    // rex_a79_textile($textile,true)          -> restricted - kein HTML im markup, etc..
    // rex_a79_textile($textile,false,\'html5\') -> doctype html5 statt xhtml
  }
}
else
{
  echo rex_warning(\'Dieses Modul benoetigt das "textile" Addon!\');
}
?>';

$popup_code = '<a href="#" onclick="newWindow(\'textile_help\',\'index.php?page=textile&subpage=rex_a79_help_overview\',\'640\',\'700\'); return false;">Textile Help Popup</a>';


// SETTINGS
////////////////////////////////////////////////////////////////////////////////
if($REX['USER']->isAdmin() || $REX['USER']->hasPerm('textile[settings]'))
{
  // CACHING SELECT
  $tmp = new rex_select();
  $tmp->setSize(1);
  $tmp->setName('use_caching');
  $tmp->addOption('true',1);
  $tmp->addOption('false',0);
  $tmp->setSelected($REX["ADDON"]["textile"]["settings"]['use_caching']);
  $caching_sel = $tmp->get();

  // TEXTILE LIB VERSION SELECT
  //////////////////////////////////////////////////////////////////////////////
  $version_sel = '
  <select class="resize-widget-mode-select" name="textile_version">
    <optgroup label="Redaxo Standard Versionen">
    <option value="2.4.1" '.(($REX["ADDON"]["textile"]["settings"]['textile_version'] == '2.4.1') ? 'selected' : '').'>Textile 2.4.1 | Redaxo 4.4.1 | netcarver/2.4.1</option>
    <option value="gharlan/redaxo4" '.(($REX["ADDON"]["textile"]["settings"]['textile_version'] == 'gharlan/redaxo4') ? 'selected' : '').'>Textile 2.5.1 | Redaxo 4.5 | gharlan/redaxo4</option>
    </optgroup>
    <optgroup label="Dev/Patch/Feature Versionen">
    <option value="2.5.1_textplugs" '.(($REX["ADDON"]["textile"]["settings"]['textile_version'] == '2.5.1_textplugs') ? 'selected' : '').'>Textile 2.5.1 + textplug support | jdlx/2.5.1_textplug</option>
    </optgroup>
  </select>';

    echo '
  <div class="rex-addon-output">
    <div class="rex-form">

    <form action="index.php?page=textile" method="POST" id="settings">
      <input type="hidden" name="page" value="textile" />
      <input type="hidden" name="subpage" value="" />
      <input type="hidden" name="func" value="savesettings" />

          <fieldset class="rex-form-col-1">
            <legend style="font-size: 1.333em;">Settings</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row">
                <p class="rex-form-col-a rex-form-select">
                  <label for="textile_version">Textile Version</label>
                  '.$version_sel.'
                </p>
              </div><!-- .rex-form-row -->

              <div class="rex-form-row">
                <p class="rex-form-col-a rex-form-select">
                  <label for="use_caching">Caching</label>
                  '.$caching_sel.'
                </p>
              </div><!-- .rex-form-row -->


              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="submit" name="submit" value="Einstellungen speichern" />
                </p>
              </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

    </form>

    </div><!-- .rex-form -->
  </div><!-- .rex-addon-output -->
  ';
}

?>

<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('textile_code_for_module_input'); ?></h2>

  <div class="rex-addon-content">
    <p class="rex-tx1"><?php echo $I18N->msg('textile_module_intro_help'); ?></p>
    <?php rex_highlight_string($mdl_help); ?>
    <p class="rex-tx1"><?php echo $I18N->msg('textile_module_rights'); ?></p>

  </div><!-- /.rex-addon-content -->
</div><!-- /.rex-addon-output -->


<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('textile_code_for_module_input'); ?></h2>

  <div class="rex-addon-content">
    <h2>Popup Page Code:</h2>
    <?php rex_highlight_string($popup_code); ?>
    <h2>Demo: <a href="#" onclick="newWindow('textile_help','index.php?page=textile&subpage=rex_a79_help_overview','640','700'); return false;">Textile Help Popup</a></h2>

  </div><!-- /.rex-addon-content -->
</div><!-- /.rex-addon-output -->

<div class="rex-addon-output">

  <h2 class="rex-hl2"><?php echo $I18N->msg('textile_code_for_module_output'); ?></h2>

  <div class="rex-addon-content">
    <p class="rex-tx1"><?php echo $I18N->msg('textile_module_intro_moduleoutput'); ?></p>
    <h3><?php echo $I18N->msg('textile_example_for'); ?> REX_VALUE[1]</h3>
    <?php rex_highlight_string($mdl_ex); ?>

  </div><!-- /.rex-addon-content -->
</div><!-- /.rex-addon-output -->

<?php

require $REX['INCLUDE_PATH'].'/layout/bottom.php';
