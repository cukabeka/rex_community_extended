<?php

class rex_xform_validate_unique extends rex_xform_validate_abstract
{

  function postValueAction()
  {
    if($this->params["send"]=="1")
    {

      $table = $this->params["main_table"];
      if($this->getElement(4) != "") {
        $table = $this->getElement(4);
      }
        
      $fields = explode(",", $this->getElement(2));
      $qfields = array();
      foreach($this->obj as $o) {
        if(in_array($o->getName(), $fields)) {
          $value = $o->getValue();
          // select array ? (special case)
          if(is_array($value)) {
            $value = implode(",",$value);
          }
          $qfields[$o->getId()] = '`'.$o->getName().'`="'.mysql_real_escape_string($value).'"';
        }
      }

      // all fields available ?
      if(count($qfields) != count($fields)) {
        $this->params["warning"][] = $this->getElement(3);
        $this->params["warning_messages"][] = $this->getElement(3);
        return;
      }
      
      $sql = 'select * from '.$table.' WHERE '.implode(" AND ",$qfields).' LIMIT 1';
      if($this->params["main_where"] != "") {
        $sql = 'select * from '.$table.' WHERE '.implode(" AND ",$qfields).' AND !('.$this->params["main_where"].') LIMIT 1';
      }
      $cd = rex_sql::factory();
      // $cd->debugsql = 1;
      $cd->setQuery($sql);
      if ($cd->getRows() > 0) {
        foreach($qfields as $qfield_id => $qfield_name) {
          $this->params["warning"][$qfield_id] = $this->params["error_class"];
        }
        $this->params["warning_messages"][] = $this->getElement(3);
      }

      return;
    }
  }

  function getDescription()
  {
    return "unique -> prüft ob unique, beispiel: validate|unique|dbfeldname[,dbfeldname2]|Dieser Name existiert schon|[table]";
  }

  function getDefinitions()
  {
    return array(
            'type' => 'validate',
            'name' => 'unique',
            'values' => array(
                    array( 'type' => 'select_names', 'label' => 'Name' ),
                    array( 'type' => 'text',    	'label' => 'Fehlermeldung'),
                    array( 'type' => 'text',    	'label' => 'Tabelle [opt]'),
            ),
            'description' => 'Hiermit geprüft, ob ein Wert bereits vorhanden ist.',
      );

  }
}

?>