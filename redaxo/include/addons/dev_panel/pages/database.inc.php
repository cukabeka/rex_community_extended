<?php
/**
* DevPanel Addon
*
* @author http://rexdev.de
* @link   http://www.redaxo.org/de/download/addons/?addon_id=919
*
* @version 0.1
* $Id$:
*/

// ADDON PARAMETER AUS URL HOLEN
////////////////////////////////////////////////////////////////////////////////
$myself    = rex_request('page'   , 'string');
$subpage   = rex_request('subpage', 'string');
$minorpage = rex_request('minorpage', 'string');
$func      = rex_request('func'   , 'string');
$id        = rex_request('id', 'int');


// TABELLE IDENTIFIER
/////////////////////////////////////////////////////////////////////////////////
$AddonDBTable = $REX['TABLE_PREFIX'].'919_panel_items';


// AUSGABE DER SEITE JE NACH $func
/////////////////////////////////////////////////////////////////////////////////
$pagination = $REX['ADDON'][$myself]['settings']['rex_list_pagination'];

if($func == "")
{
  /* LISTE ------------------------------------------------------------------ */
   echo '<div class="rex-addon-output">
   <h2 class="rex-hl2">Übersicht <span style="color:silver;font-size:12px;">(DB Tabelle: '.$AddonDBTable.')</span></h2>';

  // alle Felder abfragen und anzeigen
  $query = 'SELECT * FROM '.$AddonDBTable.' ORDER BY prio ASC';
  $list = new rex_list($query,$pagination,'data');

  // DEBUG SWITCH
  $list->debug = false;

  $imgHeader = '<a href="'. $list->getUrl(array('func' => 'add')) .'"><img src="media/metainfo_plus.gif" alt="add" title="add" /></a>';

  $list->removeColumn('id'   );
  $list->removeColumn('prio' );
  $list->removeColumn('checked' );


  $list->setColumnSortable('rex_redaxo' );
  $list->setColumnSortable('type' );
  $list->setColumnSortable('name' );
  $list->setColumnSortable('code' );


  $list->addColumn($imgHeader,'<img src="media/metainfo.gif" alt="field" title="field" />',0,array('<th class="rex-icon">###VALUE###</th>','<td class="rex-icon">###VALUE###</td>'));
  $list->setColumnParams($imgHeader,array('func' => 'edit', 'id' => '###id###'));


  $list->setColumnLabel('rex_redaxo'  ,'Front/Backend');
  $list->setColumnLabel('type'  ,'Typ');
  $list->setColumnLabel('name'  ,'Title/Var');
  $list->setColumnLabel('code'  ,'Code');

  function type_plain()
  {
    global $list;
    $matrix = array(0=>'Code',1=>'Toggled Code',2=>'Editable Var');
    return $matrix[$list->getValue('type')];
  }
  $list->setColumnFormat('type' ,'custom', 'type_plain');

  function rex_redaxo_plain()
  {
    global $list;
    $matrix = array(3=>'Frontend & Backend',1=>'Frontend',2=>'Backend');
    return $matrix[$list->getValue('rex_redaxo')];
  }
  $list->setColumnFormat('rex_redaxo' ,'custom', 'rex_redaxo_plain');


  $list->setColumnParams('type'       ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('name'       ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('code'       ,array('func' => 'edit', 'id' => '###id###'));
  $list->setColumnParams('rex_redaxo' ,array('func' => 'edit', 'id' => '###id###'));


  $list->show();

  echo '</div>';
}

elseif ($func == 'edit' || $func == 'add')
{

  echo '<div class="rex-addon-output">';

  if($func == 'edit')
  {
    echo '<h2 class="rex-hl2">Datensatz bearbeiten <span style="color:silver;font-size:12px;">(ID: '.$id.')</span></h2>';
  }
  else
  {
    echo '<h2 class="rex-hl2">Neuen Datensatz anlegen</h2>';
  }


  $form = new rex_form($AddonDBTable,'Panel Item','id='.$id,'post',false);


  // FRONTEND/BACKEND
  $field =& $form->addSelectField('rex_redaxo');
  $field->setLabel('Ausgabe');
  $select =& $field->getSelect();
  $select->setSize(1);
  $select->addOption('Frontend',1);
  $select->addOption('Backend',2);
  $select->addOption('Frontend & Backend',3);

  // FONTEND/BACKEND
  $field =& $form->addSelectField('type');
  $field->setLabel(' PanelTyp');
  $select =& $field->getSelect();
  $select->setSize(1);
  $select->addOption('editierbare Variable',2);
  $select->addOption('togglebarer Code',1);
  $select->addOption('Code',0);

  // NAME
  $field = &$form->addTextField('name');
  $field->setLabel("Titel/Variable");

  // CODE
  $field = &$form->addTextAreaField('code');
  $field->setLabel("Code");

  // Wenn editiert wird, braucht man die id des Datensatzes
  if($func == 'edit')
  {
    $form->addParam('id', $id);
  }

  $form->show();

  echo '</div>';

}