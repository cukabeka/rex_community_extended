<?php
/**
 * extended_corepages - Redaxo be_style Plugin
 *
 * @version 1.2.1
 * @package redaxo 4.4.x/4.5.x
 */

$info    = '';
$warning = '';

if ($func == 'setup')
{
  // REACTIVATE SETUP

  $master_file = $REX['INCLUDE_PATH'].'/master.inc.php';
  $cont = rex_get_file_contents($master_file);
  $cont = preg_replace("@(REX\['SETUP'\].?\=.?)[^;]*@", '$1true', $cont);
  // echo nl2br(htmlspecialchars($cont));
  if (rex_put_file_contents($master_file, $cont) !== false)
  {
    $info = $I18N->msg('setup_error1', '<a href="index.php">', '</a>');
  }
  else
  {
    $warning = $I18N->msg('setup_error2');
  }
}elseif ($func == 'generate')
{
  // generate all articles,cats,templates,caches
  $info = rex_generateAll();
}
elseif ($func == 'updateinfos')
{
  $neu_startartikel       = rex_post('neu_startartikel', 'int');
  $neu_notfoundartikel    = rex_post('neu_notfoundartikel', 'int');
  $neu_defaulttemplateid  = rex_post('neu_defaulttemplateid', 'int');
  $neu_lang               = rex_post('neu_lang', 'string');
  // ' darf nichtg escaped werden, da in der Datei der Schlüssel nur zwischen " steht
  $neu_error_emailaddress = str_replace("\\'", "'", rex_post('neu_error_emailaddress', 'string'));
  $neu_SERVER             = str_replace("\\'", "'", rex_post('neu_SERVER', 'string'));
  $neu_SERVERNAME         = str_replace("\\'", "'", rex_post('neu_SERVERNAME', 'string'));
  $neu_modrewrite         = rex_post('neu_modrewrite', 'string');

  $neu_session_duration  = rex_post('neu_session_duration', 'int');
  $neu_session_duration  = $neu_session_duration < 300 ? 300 : $neu_session_duration;
  $neu_use_gzip          = rex_post('neu_use_gzip', 'string');
  $neu_use_etag          = rex_post('neu_use_etag', 'string');
  $neu_use_last_modified = rex_post('neu_use_last_modified', 'string');
  $neu_use_md5           = rex_post('neu_use_md5', 'string');

  $startArt = OOArticle::getArticleById($neu_startartikel);
  $notFoundArt = OOArticle::getArticleById($neu_notfoundartikel);

  $REX['LANG'] = $neu_lang;
  $master_file = $REX['INCLUDE_PATH'] .'/master.inc.php';
  $cont = rex_get_file_contents($master_file);

  if(!OOArticle::isValid($startArt))
  {
    $warning .= $I18N->msg('settings_invalid_sitestart_article')."<br />";
  }else
  {
    $cont = preg_replace("@(REX\['START_ARTICLE_ID'\].?\=.?)[^;]*@", '${1}'.strtolower($neu_startartikel), $cont);
    $REX['START_ARTICLE_ID'] = $neu_startartikel;
  }

  if(!OOArticle::isValid($notFoundArt))
  {
    $warning .= $I18N->msg('settings_invalid_notfound_article')."<br />";
  }else
  {
    $cont = preg_replace("@(REX\['NOTFOUND_ARTICLE_ID'\].?\=.?)[^;]*@", '${1}'.strtolower($neu_notfoundartikel), $cont);
    $REX['NOTFOUND_ARTICLE_ID'] = $neu_notfoundartikel;
  }

  $sql = rex_sql::factory();
  $sql->setQuery('SELECT * FROM '. $REX['TABLE_PREFIX'] .'template WHERE id='. $neu_defaulttemplateid .' AND active=1');
  if($sql->getRows() != 1 && $neu_defaulttemplateid != 0)
  {
    $warning .= $I18N->msg('settings_invalid_default_template')."<br />";
  }else
  {
    $cont = preg_replace("@(REX\['DEFAULT_TEMPLATE_ID'\].?\=.?)[^;]*@", '${1}'.strtolower($neu_defaulttemplateid), $cont);
    $REX['DEFAULT_TEMPLATE_ID'] = $neu_defaulttemplateid;
  }

  $search = array('\\"', "'", '$');
  $destroy = array('"', "\\'", '\\$');
  $replace = array(
    'search' => array(
      "@(REX\['ERROR_EMAIL'\].?\=.?).*$@m",
      "@(REX\['LANG'\].?\=.?).*$@m",
      "@(REX\['SERVER'\].?\=.?).*$@m",
      "@(REX\['SERVERNAME'\].?\=.?).*$@m",
      "@(REX\['MOD_REWRITE'\].?\=.?).*$@m",
      "@(REX\['SESSION_DURATION'\].?\=.?)[^;]*@",
      "@(REX\['USE_GZIP'\].?\=.?).*$@m",
      "@(REX\['USE_ETAG'\].?\=.?).*$@m",
      "@(REX\['USE_LAST_MODIFIED'\].?\=.?).*$@m",
      "@(REX\['USE_MD5'\].?\=.?).*$@m",
    ),
    'replace' => array(
      "$1'".str_replace($search, $destroy, strtolower($neu_error_emailaddress))."';",
      "$1'".str_replace($search, $destroy, $neu_lang)."';",
      "$1'".str_replace($search, $destroy, $neu_SERVER)."';",
      "$1'".str_replace($search, $destroy, $neu_SERVERNAME)."';",
      '$1'.strtolower(str_replace($search, $destroy, $neu_modrewrite)).';',
      '${1}'.$neu_session_duration,
      "$1'".str_replace($search, $destroy, $neu_use_gzip)."';",
      "$1'".str_replace($search, $destroy, $neu_use_etag)."';",
      "$1'".str_replace($search, $destroy, $neu_use_last_modified)."';",
      "$1'".str_replace($search, $destroy, $neu_use_md5)."';",
    )
  );

  $cont = preg_replace($replace['search'], $replace['replace'], $cont);

  if($warning == '')
  {
    if(rex_put_file_contents($master_file, $cont) > 0)
    {
      $info = $I18N->msg('info_updated');

      // Zuweisungen für Wiederanzeige
      $REX['MOD_REWRITE']       = $neu_modrewrite === 'TRUE';
      // FŸr die Wiederanzeige Slashes strippen
      $REX['ERROR_EMAIL']       = stripslashes($neu_error_emailaddress);
      $REX['SERVER']            = stripslashes($neu_SERVER);
      $REX['SERVERNAME']        = stripslashes($neu_SERVERNAME);
      $REX['SESSION_DURATION']  = $neu_session_duration;
      $REX['USE_GZIP']          = $neu_use_gzip;
      $REX['USE_ETAG']          = $neu_use_etag;
      $REX['USE_LAST_MODIFIED'] = $neu_use_last_modified;
      $REX['USE_MD5']           = $neu_use_md5;
    }
  }
}

$sel_template = new rex_select();
$sel_template->setStyle('class="rex-form-select"');
$sel_template->setName('neu_defaulttemplateid');
$sel_template->setId('rex-form-default-template-id');
$sel_template->setSize(1);
$sel_template->setSelected($REX['DEFAULT_TEMPLATE_ID']);

$templates = OOCategory::getTemplates(0);
if (empty($templates))
  $sel_template->addOption($I18N->msg('option_no_template'), 0);
else
  $sel_template->addArrayOptions($templates);

$sel_lang = new rex_select();
$sel_lang->setStyle('class="rex-form-select"');
$sel_lang->setName('neu_lang');
$sel_lang->setId('rex-form-lang');
$sel_lang->setSize(1);
$sel_lang->setSelected($REX['LANG']);

foreach ($REX['LOCALES'] as $l)
{
  $sel_lang->addOption($l, $l);
}

$sel_mod_rewrite = new rex_select();
$sel_mod_rewrite->setSize(1);
$sel_mod_rewrite->setStyle('class="rex-form-select"');
$sel_mod_rewrite->setName('neu_modrewrite');
$sel_mod_rewrite->setId('rex-form-mod-rewrite');
$sel_mod_rewrite->setSelected($REX['MOD_REWRITE'] === false ? 'FALSE' : 'TRUE');

$sel_mod_rewrite->addOption('TRUE', 'TRUE');
$sel_mod_rewrite->addOption('FALSE', 'FALSE');


$tmp = new rex_select();
$tmp->setSize(1);
$tmp->setMultiple(false);
$tmp->setStyle('class="rex-form-select"');
$tmp->addOption('false'   , 'false');
$tmp->addOption('true'    , 'true');
$tmp->addOption('frontend', 'frontend');
$tmp->addOption('backend' , 'backend');

$tmp->setName('neu_use_gzip');
$tmp->setId('rex-form-use-gzip');
$tmp->option_selected[0] = $REX['USE_GZIP'];
$sel_use_gzip = $tmp->get();

$tmp->setName('neu_use_etag');
$tmp->setId('rex-form-use-etag');
$tmp->option_selected[0] = $REX['USE_ETAG'];
$sel_use_etag = $tmp->get();

$tmp->setName('neu_use_last_modified');
$tmp->setId('rex-form-use-last_modified');
$tmp->option_selected[0] = $REX['USE_LAST_MODIFIED'];
$sel_use_last_modified = $tmp->get();

$tmp->setName('neu_use_md5');
$tmp->setId('rex-form-use-md5');
$tmp->option_selected[0] = $REX['USE_MD5'];
$sel_use_nd5 = $tmp->get();


// http://www.php.net/manual/en/errorfunc.constants.php#109430
function FriendlyErrorType($type)
{
    switch($type)
    {
        case E_ERROR: // 1 //
            return 'E_ERROR';
        case E_WARNING: // 2 //
            return 'E_WARNING';
        case E_PARSE: // 4 //
            return 'E_PARSE';
        case E_NOTICE: // 8 //
            return 'E_NOTICE';
        case E_CORE_ERROR: // 16 //
            return 'E_CORE_ERROR';
        case E_CORE_WARNING: // 32 //
            return 'E_CORE_WARNING';
        case E_CORE_ERROR: // 64 //
            return 'E_COMPILE_ERROR';
        case E_CORE_WARNING: // 128 //
            return 'E_COMPILE_WARNING';
        case E_USER_ERROR: // 256 //
            return 'E_USER_ERROR';
        case E_USER_WARNING: // 512 //
            return 'E_USER_WARNING';
        case E_USER_NOTICE: // 1024 //
            return 'E_USER_NOTICE';
        case E_STRICT: // 2048 //
            return 'E_STRICT';
        case E_RECOVERABLE_ERROR: // 4096 //
            return 'E_RECOVERABLE_ERROR';
        case E_DEPRECATED: // 8192 //
            return 'E_DEPRECATED';
        case E_USER_DEPRECATED: // 16384 //
            return 'E_USER_DEPRECATED';
    }
    return "";
}


if ($warning != '')
  echo rex_warning($warning);

if ($info != '')
  echo rex_info($info);

echo '
  <style>
    div#rex-form-system-setup div.rex-form-row label {font-weight: normal;padding-left: 0;width: 190px;}
    div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p.rex-form-label-right label, div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p.rex-form-read span, div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p.rex-form-text input, div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p select, div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p textarea {width: 40%;}
    div#rex-form-system-setup div.rex-form-row.form-row-compact, .rex-form-row.form-row-compact label, .rex-form-row.form-row-compact span {padding: 0 0 1px !important;}
    div#rex-form-system-setup .rex-form-row.form-row-compact label {width:140px;}
    div#rex-form-system-setup .rex-form-row.form-row-compact span {width:auto !important;}
    div#rex-form-system-setup div.rex-widget input { width: 90px; }
    div#rex-form-system-setup p span.rex-form-notice, div#rex-form-system-setup fieldset.rex-form-col-1 div.rex-form-row p input.rex-form-submit {margin-left: 195px;}
    #phpinfo { padding:0;margin:0;font-family:monospace;font-size:12px;height:400px;overflow-x:hidden;overflow-y:scroll;}
    #phpinfo img,#phpinfo hr { display:none }
    #phpinfo a { color:#32353A !important; }
  </style>

  <div class="rex-form" id="rex-form-system-setup">
    <form action="index.php" method="post">
      <input type="hidden" name="page" value="specials" />
      <input type="hidden" name="func" value="updateinfos" />

      <div class="rex-area-col-2">
        <div class="rex-area-col-a">

          <h3 class="rex-hl2">'.$I18N->msg("specials_features").'</h3>

          <div class="rex-area-content">
            <h4 class="rex-hl3">'.$I18N->msg("delete_cache").'</h4>
            <p class="rex-tx1">'.$I18N->msg("delete_cache_description").'</p>
            <p class="rex-button"><a class="rex-button" href="index.php?page=specials&amp;func=generate"><span><span>'.$I18N->msg("delete_cache").'</span></span></a></p>

            <h4 class="rex-hl3">'.$I18N->msg("setup").'</h4>
            <p class="rex-tx1">'.$I18N->msg("setup_text").'</p>
            <p class="rex-button"><a class="rex-button" href="index.php?page=specials&amp;func=setup" onclick="return confirm(\''.$I18N->msg("setup").'?\');"><span><span>'.$I18N->msg("setup").'</span></span></a></p>

            <h4 class="rex-hl3">'.$I18N->msg("version").'</h4>
            <p class="rex-tx1">
            REDAXO: '.$REX['VERSION'].'.'.$REX['SUBVERSION'].'.'.$REX['MINORVERSION'];

if(isset($REX['RELEASE'])){
  echo '
            <br />
            RELEASE: <a href="https://github.com/gn2netwerk/redaxo4/commit/'.$REX['RELEASE'].'" target="_blank">'.$REX['RELEASE'].'</a><br />
            ';
}

echo '
            </p>

            <h4 class="rex-hl3">'.$I18N->msg("database").'</h4>
            <p class="rex-tx1">MySQL: '.$REX['MYSQL_VERSION'].'<br />'.$I18N->msg("name").': '.htmlspecialchars($REX['DB']['1']['NAME']).'<br />'.$I18N->msg("host").': '.htmlspecialchars($REX['DB']['1']['HOST']).'</p>

          </div>
        </div>

        <div class="rex-area-col-b">

          <h3 class="rex-hl2">'.$I18N->msg("specials_settings").'</h3>

          <div class="rex-area-content">

            <fieldset class="rex-form-col-1">
              <legend>'.$I18N->msg("general_info_header").'</legend>

              <div class="rex-form-wrapper">

            <!--
              <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-read">
                    <label for="rex-form-version">Version</label>
                    <span class="rex-form-read" id="rex-form-version">'.$REX['VERSION'].'.'.$REX['SUBVERSION'].'.'.$REX['MINORVERSION'].'</span>
                  </p>
                </div>
            -->

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="rex-form-servername" title="'.$I18N->msg("specials_settings_servername").'">$REX[\'SERVERNAME\']</label>
                    <input class="rex-form-text" type="text" id="rex-form-servername" name="neu_SERVERNAME" value="'. htmlspecialchars($REX['SERVERNAME']).'" />
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="rex-form-server" title="'.$I18N->msg("specials_settings_server").'">$REX[\'SERVER\']</label>
                    <input class="rex-form-text" type="text" id="rex-form-server" name="neu_SERVER" value="'. htmlspecialchars($REX['SERVER']).'" />
                  </p>
                </div>
              </div>
            <!--
            </fieldset>
            -->

            <!--
            <fieldset class="rex-form-col-1">
              <legend>'.$I18N->msg("db1_can_only_be_changed_by_setup").'</legend>

              <div class="rex-form-wrapper">

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-read">
                    <label for="rex-form-db-host">$REX[\'DB\'][\'1\'][\'HOST\']</label>
                    <span class="rex-form-read" id="rex-form-db-host">&quot;'.htmlspecialchars($REX['DB']['1']['HOST']).'&quot;</span>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="rex-form-db-login">$REX[\'DB\'][\'1\'][\'LOGIN\']</label>
                    <span id="rex-form-db-login">&quot;'.htmlspecialchars($REX['DB']['1']['LOGIN']).'&quot;</span>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-read">
                    <label for="rex-form-db-psw">$REX[\'DB\'][\'1\'][\'PSW\']</label>
                    <span class="rex-form-read" id="rex-form-db-psw">&quot;****&quot;</span>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-read">
                    <label for="rex-form-db-name">$REX[\'DB\'][\'1\'][\'NAME\']</label>
                    <span class="rex-form-read" id="rex-form-db-name">&quot;'.htmlspecialchars($REX['DB']['1']['NAME']).'&quot;</span>
                  </p>
                </div>
              </div>
            </fieldset>
            -->

            <!--
            <fieldset class="rex-form-col-1">
              <legend>'.$I18N->msg("specials_others").'</legend>

              <div class="rex-form-wrapper">
            -->

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-read">
                    <label for="rex_include_path" title="'.$I18N->msg("specials_settings_include_path").'">$REX[\'INCLUDE_PATH\']</label>
                    <span class="rex-form-read" id="rex_include_path" title="'. htmlspecialchars($REX['INCLUDE_PATH']) .'">&quot;';

                    $tmp = $REX['INCLUDE_PATH'];
                    if (strlen($REX['INCLUDE_PATH'])>21)
                      $tmp = substr($tmp,0,8)."..".substr($tmp,strlen($tmp)-13);

                    echo $tmp;

           echo '&quot;</span>
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="rex-form-error-email" title="'.$I18N->msg("specials_settings_error_email").'">$REX[\'ERROR_EMAIL\']</label>
                    <input class="rex-form-text" type="text" id="rex-form-error-email" name="neu_error_emailaddress" value="'.htmlspecialchars($REX['ERROR_EMAIL']).'" />
                  </p>
                </div>

                <div class="rex-form-row">
                  <div class="rex-form-col-a rex-form-widget">
                    <label for="rex-form-startarticle-id" title="'.$I18N->msg("specials_settings_startarticle").'">$REX[\'START_ARTICLE_ID\']</label>
                    '. rex_var_link::_getLinkButton('neu_startartikel', 1, $REX['START_ARTICLE_ID']) .'
                  </div>
                </div>

                <div class="rex-form-row">
                  <div class="rex-form-col-a rex-form-widget">
                    <label for="rex-form-notfound-article-id" title="'.$I18N->msg("specials_settings_notfound_article").'">$REX[\'NOTFOUND_ARTICLE_ID\']</label>
                    '. rex_var_link::_getLinkButton('neu_notfoundartikel', 2, $REX['NOTFOUND_ARTICLE_ID']) .'
                  </div>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-default-template-id" title="'.$I18N->msg("specials_settings_default_template").'">$REX[\'DEFAULT_TEMPLATE_ID\']</label>
                    '. $sel_template->get() .'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-lang" title="'.$I18N->msg("specials_settings_backend_lang").'">$REX[\'LANG\']</label>
                    '.$sel_lang->get().'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-mod-rewrite" title="'.$I18N->msg("specials_settings_mod_rewrite").'">$REX[\'MOD_REWRITE\']</label>
                    '.$sel_mod_rewrite->get().'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-text">
                    <label for="rex-form-session-duration" title="">$REX[\'SESSION_DURATION\']</label>
                    <input class="rex-form-text" type="text" id="rex-form-session-duration" name="neu_session_duration" value="'. htmlspecialchars($REX['SESSION_DURATION']).'" />
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-use-gzip" title="">$REX[\'USE_GZIP\']</label>
                    '. $sel_use_gzip .'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-use-etag" title="">$REX[\'USE_ETAG\']</label>
                    '. $sel_use_etag .'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-use-last_modified" title="">$REX[\'USE_LAST_MODIFIED\']</label>
                    '. $sel_use_last_modified .'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-select">
                    <label for="rex-form-use-md5" title="">$REX[\'USE_MD5\']</label>
                    '. $sel_use_nd5 .'
                  </p>
                </div>

                <div class="rex-form-row">
                  <p class="rex-form-col-a rex-form-submit">
                    <input type="submit" class="rex-form-submit" name="sendit" value="'.$I18N->msg("specials_update").'"'. rex_accesskey($I18N->msg('specials_update'), $REX['ACKEY']['SAVE']) .' />
                  </p>
                </div>

            <!--
                </div>
            -->
            </fieldset>
          </div> <!-- Ende rex-area-content //-->

        </div> <!-- Ende rex-area-col-b //-->






      </div> <!-- Ende rex-area-col-2 //-->

<div class="rex-clearer"></div>

<div class="rex-area-col-2">

  <div class="rex-area-col-a">

    <h2 class="rex-hl2">PHP ('.phpversion().') Settings <span style="font-size:12px;font-weight:normal;"> – <a href="#phpinfo" id="php-info-show">phpinfo()</a></span></h2>

    <div class="rex-area-content">

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>max_execution_time:</label>
          <span class="rex-form-read">'.ini_get('max_execution_time').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>max_input_time:</label>
          <span class="rex-form-read">'.ini_get('max_input_time').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>memory_limit:</label>
          <span class="rex-form-read">'.ini_get('memory_limit').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>post_max_size:</label>
          <span class="rex-form-read">'.ini_get('post_max_size').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>upload_max_filesize:</label>
          <span class="rex-form-read">'.ini_get('upload_max_filesize').'</span>
        </p>
        <br />
      </div>

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>allow_url_fopen:</label>
          <span class="rex-form-read">'.ini_get('allow_url_fopen').'</span>
        </p>
      </div>

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>curl_exec():</label>
          <span class="rex-form-read">'.function_exists('curl_exec').'</span>
        </p>
        <br />
      </div>

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>exec():</label>
          <span class="rex-form-read">'.function_exists('exec').'</span>
        </p>
      </div>

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>system():</label>
          <span class="rex-form-read">'.function_exists('system').'</span>
        </p>
      </div>

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>passthru():</label>
          <span class="rex-form-read">'.function_exists('passthru').'</span>
        </p>
      </div>

      <div class="rex-clearer"></div>

    </div>
  </div>

  <div class="rex-area-col-b">

    <h2 class="rex-hl2">&nbsp;</h2>

    <div class="rex-area-content">

      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>register_globals:</label>
          <span class="rex-form-read">'.ini_get('register_globals').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>safe_mode:</label>
          <span class="rex-form-read">'.ini_get('safe_mode').'</span>
        </p>
        <br />
      </div>


      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>display_errors:</label>
          <span class="rex-form-read">'.ini_get('display_errors').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact">
        <p class="rex-form-col-a rex-form-read">
          <label>error_log:</label>
          <span class="rex-form-read">'.ini_get('error_log').'</span>
        </p>
      </div>
      <div class="rex-form-row form-row-compact" style="display:table">
        <p class="rex-form-col-a rex-form-read" style="display:table-row">
          <label style="display:table-cell">error_reporting:</label>
          <span class="rex-form-read" style="display:table-cell;float:none;">' . error_reporting() . ' ';

$error_reporting = error_reporting();
if((int)$error_reporting == $error_reporting) {
  $types = array();
  for ($i = 0; $i < 15;  $i++ ) {
      $type = FriendlyErrorType($error_reporting & pow(2, $i));
      if($type != ''){
        $types[] = $type;
      }
  }
  echo   '<code>('.implode(', ',$types) . ')</code>';
}

echo   '</span>
        </p>
      </div>

      <div class="rex-clearer"></div>

    </div>

  </div>

</div>




    </form>

    <div class="rex-clearer"></div>
    <div id="phpinfo-wrapper" style="display:none;">
      <h3 class="rex-hl2" style="font-size:12px;font-weight:normal;line-height:14px;" id="phpinfo-anchors"></h3>
      <div id="phpinfo">';
        ob_start();
        phpinfo();
        $info = ob_get_contents();
        ob_end_clean();
        $info = preg_replace('%^.*<body>(.*)</body>.*$%ms', '$1', $info);
        $info = str_replace('<h2>Environment</h2>', '<h2><a name="env">Environment</a></h2>', $info);
        $info = str_replace('<h2>PHP Variables</h2>', '<h2><a name="phpvar">PHP Variables</a></h2>', $info);
        $info = str_replace('<h2>PHP Core</h2>', '<h2><a name="phpcore">PHP Core</a></h2>', $info);
        echo $info.'
      </div>
    </div>



</div>
';
?>
<script>
  jQuery(function($){
    $('#phpinfo table').css({width:'100%'}).addClass('rex-table');
    $('#phpinfo :header:not(.p)').addClass('rex-hl2');
    $('#phpinfo a').each(function(){
      if(typeof $(this).attr("name") != 'undefined'){
        var link = '<a href="#' + $(this).attr("name") + '">' + $(this).text() + '</a> | '; console.log('link:',link);
        $('#phpinfo-anchors').html($('#phpinfo-anchors').html() + link);
      }
    });
  });
  (function($){
    $('#php-info-show').click(function(){
      $('#phpinfo-wrapper').toggle(500);
    })
  })(jQuery);
</script>
