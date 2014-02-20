<?php
/**
 * rex_select2 - Select2 JS as Redaxo be_style Plugin
 *
 * @version 1.1.0
 * @link http://ivaynberg.github.com/select2/
 * @author Redaxo be_style plugin: rexdev.de
 * @package redaxo 4.4.x/4.5.x
 */


// GET PARAMS
////////////////////////////////////////////////////////////////////////////////
$mypage     = 'rex_select2';
$myroot     = $REX['INCLUDE_PATH'].'/addons/be_style/plugins/'.$mypage.'/';
$subpage    = rex_request('subpage', 'string');
$func       = rex_request('func', 'string');


// PAGE HEAD
////////////////////////////////////////////////////////////////////////////////
require $REX['INCLUDE_PATH'] . '/layout/top.php';

rex_title('Backend Style <span style="color:silver;font-size:0.5em;">'.$REX['ADDON']['plugins']['be_style']['version'][$mypage].'</span>',$REX['ADDON']['be_style']['SUBPAGES']);


// SAVE SETTINGS
////////////////////////////////////////////////////////////////////////////////
if($func=='save_settings'){
  $settings = rex_request('settings', 'array');
  foreach($settings as $k => $v){
    $settings[$k] = str_replace('\'','"',stripslashes($v));
  }

  $content = '$REX["rex_select2"]["settings"] = '.var_export($settings,true).';';
  if(rex_replace_dynamic_contents($myroot.'config.inc.php', $content)){
    $REX["rex_select2"]["settings"] = $settings;
  }
  echo rex_info('Settings saved.');
}


// FORM
////////////////////////////////////////////////////////////////////////////////
echo '
<!--<div class="rex-addon-output im-plugins">
  <h2 class="rex-hl2" style="font-size:1em;border-bottom:0;">./*$subsubnavi*/.</h2>
</div>-->

<div class="rex-addon-output im-plugins">
  <div class="rex-form">

    <form action="index.php?page=be_style&subpage='.$mypage.'" method="post">
      <input type="hidden" name="page" value="be_style" />
      <input type="hidden" name="subpage" value="'.$mypage.'" />
      <input type="hidden" name="func" value="save_settings" />

      <fieldset class="rex-form-col-1">
        <legend style="font-size:1.2em">RexSpectrum Settings</legend>
          <div class="rex-form-wrapper">


            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="trigger_class">Trigger Class</label>
                <input id="trigger_class" class="rex-form-text" type="text" name="settings[trigger_class]" value="'.
                $REX[$mypage]['settings']['trigger_class'].
                '" />
              </p>
            </div><!-- /rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-textarea">
                <label for="js_options">Options (<a href="http://ivaynberg.github.io/select2/select2-latest.html#documentation">docs</a>)</label>
                <textarea id="js_options" style="width:97%;margin-left:6px;min-height:180px;font-family:monospace;font-size:1.3em" class="rex-form-textarea rex-codemirror" name="settings[js_options]">'.$REX[$mypage]['settings']['js_options'].'</textarea>
              </p>
            </div><!-- .rex-form-row -->


              <div class="rex-form-row rex-form-element-v2">
                <p class="rex-form-submit">
                  <input class="rex-form-submit" type="submit" id="sendit" name="sendit" value="Einstellungen speichern" />
                </p>
              </div><!-- /rex-form-row -->

            </div><!-- /rex-form-wrapper -->
        </fieldset>
      </form>
    </div><!-- /rex-form -->
  </div><!-- /rex-addon-output -->
  ';


require $REX['INCLUDE_PATH'] . '/layout/bottom.php';
