<?php

class rex_xform_action_manage_db extends rex_xform_action_abstract
{

  function execute()
  {

    // START - Spezialfall "be_em_relation"
    /*
    $be_em_table_field = "";
    if($this->params["value_pool"]["sql"]["type_name"] == "be_em_relation")
    {
      $be_em_table_field = $this->params["value_pool"]["sql"]["f1"];
      $this->params["value_pool"]["sql"]["f1"] = $this->params["value_pool"]["sql"]["f3"]."_".$this->params["value_pool"]["sql"]["f1"];
    }
    */
    // ENDE - Spezialfall


    // ********************************* TABLE A

    // $this->params["debug"]= TRUE;
    $sql = rex_sql::factory();
    if ($this->params["debug"]) $sql->debugsql = TRUE;

    $main_table = "";
    if ($this->getElement(2) != "")
    {
      $main_table = $this->getElement(2);
    }else{
      $main_table = $this->params["main_table"];
    }

    if ($main_table == "")
    {
      $this->params["form_show"] = TRUE;
      $this->params["hasWarnings"] = TRUE;
      $this->params["warning_messages"][] = $this->params["Error-Code-InsertQueryError"];
      return FALSE;
    }

    // CHECK PRIO CHANGES AND RUN PRIO MANAGER IF NEEDED
    if(isset($this->params['sql_object'])){
      $old_prio = $this->params['sql_object']->getValue('prio');
      $new_prio = $this->params['value_pool']['sql']['prio'];
      if($old_prio != $new_prio){
        $table_name = $this->params['value_pool']['sql']['table_name'];
        $SPM = new sql_prio_manager('rex_xform_field','prio','`table_name`="'.$table_name.'"');
        $SPM->changeRowPrio($old_prio,$new_prio);
        unset($SPM,$old_prio,$new_prio,$table_name);
      }
    }

    $sql->setTable($main_table);

    $where = "";
    if (trim($this->getElement(3)) != "")
    {
      $where = trim($this->getElement(3));
    }

    // SQL Objekt mit Werten f�llen
    foreach($this->params["value_pool"]["sql"] as $key => $value)
    {
      $sql->setValue($key, $value);
      if ($where != "")
      {
        $where = str_replace('###'.$key.'###',addslashes($value),$where);
      }
    }

    if ($where != "")
    {
      $sql->setWhere($where);
      $sql->update();
      $flag = "update";
    }else
    {
      $sql->insert();
      $flag = "insert";
      $id = $sql->getLastId();

      $this->params["value_pool"]["email"]["ID"] = $id;
      // $this->params["value_pool"]["sql"]["ID"] = $id;
      if ($id == 0)
      {
        $this->params["form_show"] = TRUE;
        $this->params["hasWarnings"] = TRUE;
        $this->params["warning_messages"][] = $this->params["Error-Code-InsertQueryError"];
      }
    }

    return;

  }

  function getDescription()
  {
    return "action|manage_db|tblname|[where]";
  }

}

?>