<?php
/**
* DevPanel Addon
*
* @author http://rexdev.de
* @link   http://www.redaxo.org/de/download/addons/?addon_id=919
*
* @version 0.1
* $MID: settings.inc.php 30 2010-06-21 02:58:00Z jeffe $:
*/

// ADDON PARAMETER AUS URL HOLEN
////////////////////////////////////////////////////////////////////////////////
$myself    = rex_request('page'   , 'string');
$subpage   = rex_request('subpage', 'string');
$minorpage = rex_request('minorpage', 'string');
$func      = rex_request('func'   , 'string');

// ADDON RELEVANTES AUS $REX HOLEN
////////////////////////////////////////////////////////////////////////////////
$myREX = $REX['ADDON'][$myself];

// FORMULAR PARAMETER SPEICHERN
////////////////////////////////////////////////////////////////////////////////
if ($func == 'savesettings')
{
  $content = '';
  foreach($_POST as $key => $val)
  {
    if(!in_array($key,array('page','subpage','minorpage','func','submit','PHPSESSID')))
    {
      $myREX['settings'][$key] = $val;
      if(is_array($val))
      {
        $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = '.var_export($val,true).';'."\n";
      }
      else
      {
        if(is_numeric($val))
        {
          $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = '.$val.';'."\n";
        }
        else
        {
          $content .= '$REX["ADDON"]["'.$myself.'"]["settings"]["'.$key.'"] = \''.$val.'\';'."\n";
        }
      }
    }
  }

  $file = $REX['INCLUDE_PATH'].'/addons/'.$myself.'/config.inc.php';
  rex_replace_dynamic_contents($file, $content);
  a919_panel_cacher();
  echo rex_info('Einstellungen wurden gespeichert.');
}

// ON/OFF
////////////////////////////////////////////////////////////////////////////////
$id = 'activity';
$tmp = new rex_select();
$tmp->setSize(1);
$tmp->setName($id);
$tmp->addOption('inaktiv',0);
$tmp->addOption('Frontend',1);
$tmp->addOption('Backend',2);
$tmp->addOption('Frontend & Backend',3);
$tmp->setSelected($myREX['settings'][$id]);
$select = $tmp->get();


// SORT LIST
////////////////////////////////////////////////////////////////////////////////
if(isset($REX['ADDON'][$myself]['settings']['savestate']))
{
  while($REX['ADDON'][$myself]['settings']['savestate'] = 0)
  {
    usleep(20);
  }
}
$all_panels = array();
$sortlist = '';
$x = new rex_sql;
$x->setQuery('SELECT `id`,`name`,`checked` FROM rex_919_panel_items ORDER BY `prio` ASC');
while($x->hasNext())
{
  $id     = $x->getValue('id');
  $name   = $x->getValue('name');
  $check  = $x->getValue('checked')==1 ? 'checked="checked"':'';
  $class  = $x->getValue('checked')==1 ? 'checked':'';
  $sortlist .= '<li class="'.$class.'" id="panel_'.$id.'"><span class="sort-icon"></span><input type="checkbox" name="panel-list[]" value="'.$id.'" '.$check.' class="'.$class.'" />'.$name.'</li>';
  $x->next();
}
$sortlist = '<ul id="panel-list">'.$sortlist.'</ul>';

// ON/OFF
////////////////////////////////////////////////////////////////////////////////
$id = 'jquery';
$tmp = new rex_select();
$tmp->setSize(1);
$tmp->setName($id);
$tmp->addOption('Kein Include',0);
$tmp->addOption('Frontend',1);
$tmp->addOption('Backend',2);
$tmp->addOption('Frontend & Backend',3);
$tmp->setSelected($myREX['settings'][$id]);
$jquery = $tmp->get();


echo '
<div class="rex-addon-output">
  <div id="dev-panel">
    <div class="rex-form">

    <form action="index.php" method="post" id="settings">
      <input type="hidden" name="page"    value="'.$myself.'" />
      <input type="hidden" name="subpage" value="'.$subpage.'" />
      <input type="hidden" name="func"    value="savesettings" />

          <fieldset class="rex-form-col-1">
            <legend>Ausgabe</legend>
            <div class="rex-form-wrapper">

              <div class="rex-form-row">
                <p class="rex-form-col-a rex-form-select">
                  <label for="select">Front/Backend</label>
                  '.$select.'
                </p>
              </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

          <fieldset class="rex-form-col-1">
            <legend>Panel Items</legend>
            <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <div class="rex-form-col-a rex-form-list">
                <label for="multiselect">Reihenfolge/Aktivität</label>
                  '.$sortlist.'
              </div>
            </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

          <fieldset class="rex-form-col-1">
            <legend>Acceskeys</legend>
            <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="acceskey-default">Toggle Panel</label>
                <input id="acceskey-default" class="rex-form-text" type="text" name="panel_accesskey[default]" value="'.stripslashes($myREX['settings']['panel_accesskey']['default']).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="acceskey-fullscreen">Toggle Fullscreen</label>
                <input id="acceskey-fullscreen" class="rex-form-text" type="text" name="panel_accesskey[maximized]" value="'.stripslashes($myREX['settings']['panel_accesskey']['maximized']).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="acceskey-itemscloser">Close All Panelitems</label>
                <input id="acceskey-itemscloser" class="rex-form-text" type="text" name="panel_accesskey[itemscloser]" value="'.stripslashes($myREX['settings']['panel_accesskey']['itemscloser']).'" />
              </p>

            </div><!-- .rex-form-wrapper -->
          </fieldset>

          <fieldset class="rex-form-col-1">
            <legend>Panel CSS Overrides</legend>
            <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="panel-css-default">#dev-block</label>
                <input id="panel-css-default" class="rex-form-text" type="text" name="panel_css[default]" value="'.stripslashes($myREX['settings']['panel_css']['default']).'" />
              </p>
            </div><!-- .rex-form-row -->

            <div class="rex-form-row">
              <p class="rex-form-col-a rex-form-text">
                <label for="panel-css-fullscreen">#dev-block.maximized</label>
                <input id="panel-css-fullscreen" class="rex-form-text" type="text" name="panel_css[maximized]" value="'.stripslashes($myREX['settings']['panel_css']['maximized']).'" />
              </p>
            </div><!-- .rex-form-row -->

            </div><!-- .rex-form-wrapper -->
          </fieldset>

          <fieldset class="rex-form-col-1">
            <legend>jQuery Core</legend>
            <div class="rex-form-wrapper">

            <div class="rex-form-row">
              <div class="rex-form-col-a rex-form-list">
                <label for="multiselect">Include</label>
                  '.$jquery.'
              </div>
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
  </div><!-- #dev-panel -->
</div><!-- .rex-addon-output -->';
?>
<script type="text/javascript" src="../files/addons/dev_panel/jquery-ui-1.8.13.custom/js/jquery-ui-1.8.13.custom.min.js"></script>
<script type="text/javascript">
(function($){
// -->

  $(function(){
    $( "#panel-list" ).sortable();
    $( "#panel-list" ).disableSelection();
  });

  $("#panel-list input").change(function(){
      if($(this).attr('checked')==true){
        $(this).parent().addClass('checked');
      }else{
        $(this).parent().removeClass('checked');
      }
    });

  $("#settings").submit( function(){
    $("#panel-list li").css({opacity:0.2});
    $("#panel-list").css({background:'url(../files/addons/dev_panel/loading_32x32.gif) 50% 50% no-repeat'});

    var prio = [];
    $("#panel-list li" ).each(function(i){
      var tmp = {};
      tmp['id'] = $(this).attr('id');
      tmp['checked'] = $(this).children('input').attr('checked');
      prio.push(tmp);
      });//console.log(prio);

    var data = {};
    data['page'] = 'dev_panel';
    data['subpage'] = 'connector';
    data['faceless'] = '1';
    data['func'] = 'elem-prio-save';
    data['json'] = JSON.stringify(prio);
    $.ajax({
    type: 'POST',
    url: 'index.php',
    data: data
    });
    //return false;
  });

// <--
})(jQuery);
</script>
