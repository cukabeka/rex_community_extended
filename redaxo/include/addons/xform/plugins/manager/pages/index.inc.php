<?php

$page = rex_request('page', 'string');
$subpage = rex_request('subpage', 'string');
$tripage = rex_request('tripage', 'string');
$table_name = rex_request('table_name', 'string');

switch($tripage)
{
  case 'table_field':
    rex_title("XForm", $REX['ADDON']['xform']['SUBPAGES']);
    require $REX['INCLUDE_PATH'] . '/addons/xform/plugins/manager/pages/table_field.inc.php';
    break;

  case 'table_import':
    // TODO:
    rex_title("XForm", $REX['ADDON']['xform']['SUBPAGES']);
    echo "TODO:";
    require $REX['INCLUDE_PATH'] . '/addons/xform/plugins/manager/pages/table_import.inc.php';
    break;

  case 'data_edit':
    require $REX['INCLUDE_PATH'] . '/addons/xform/plugins/manager/pages/data_edit.inc.php';
    break;

  default:
    rex_title("XForm", $REX['ADDON']['xform']['SUBPAGES']);
    require $REX['INCLUDE_PATH'] . '/addons/xform/plugins/manager/pages/table_edit.inc.php';
}

echo '

<script type="text/javascript">
  jQuery("#infotoggler").click(function(){jQuery("#infoblock").slideToggle("fast");});
  jQuery("#searchtoggler").click(function(){jQuery("#searchblock").slideToggle("fast");});
  jQuery("#xform_help_empty_toggler").click(function(){jQuery("#xform_help_empty").slideToggle("fast");});
  jQuery("#xform_search_reset").click(function(){window.location.href = "index.php?page=xform&subpage=manager&tripage=data_edit&table_name='.rex_request('table_name','string').'&rex_xform_search=1";});
  jQuery("a#dataset-delete").click(function(){if(confirm("'.$I18N->msg("confirm_delete").'")){return true;} else {return false;}});
  jQuery("a#truncate-table").click(function(){if(confirm("'.$I18N->msg("truncate_table_confirm").'")){return true;} else {return false;}});
  jQuery("a.delete-data").click(function(){if(confirm("'.$I18N->msg("confirm_delete").'")){return true;} else {return false;}});
  jQuery("a.updatetable").click(function(){if(confirm("\"'.rex_request('table_name','string').'\" '.$I18N->msg("updatetable").'?")){return true;} else {return false;}});
  jQuery("a.updatetable_with_delete").click(function(){if(confirm("\"'.rex_request('table_name','string').'\" '.$I18N->msg("updatetable").' '.$I18N->msg("updatetable_with_delete").'?")){return true;} else {return false;}});
</script>';
