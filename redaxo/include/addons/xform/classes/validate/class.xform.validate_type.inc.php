<?php

class rex_xform_validate_type extends rex_xform_validate_abstract
{

  function enterObject()
  {
    if($this->params["send"]=="1")
    {
      $Object=$this->obj_array[0];

      // Wenn Feld leer ist - auch ok
      if($this->getElement(5) == 1 && $Object->getValue() == "")
        return;

      $w = FALSE;

      switch(trim($this->getElement(3)))
      {
        case "int":
          $xsRegEx_int = "/^[0-9]+$/i";
          if(preg_match($xsRegEx_int, $Object->getValue())==0)
            $w = TRUE;
          break;
        case "float":
          $xsRegEx_float = "/^([0-9]+|([0-9]+\.[0-9]+))$/i";
          if(preg_match($xsRegEx_float, $Object->getValue())==0)
            $w = TRUE;
          break;
        case "numeric":
          if(!is_numeric($Object->getValue()))
            $w = TRUE;
          break;
        case "string":
            break;
        case "email":
          $xsRegEx_email = "/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,6}$/i";
          if(preg_match($xsRegEx_email, $Object->getValue())==0)
            $w = TRUE;
          break;
        case "url":
          $xsRegEx_url = '/^(?:http:\/\/)[a-zA-Z0-9][a-zA-Z0-9._-]*\.(?:[a-zA-Z0-9][a-zA-Z0-9._-]*\.)*[a-zA-Z]{2,5}(?:\/[^\\/\:\*\?\"<>\|]*)*(?:\/[a-zA-Z0-9_%,\.\=\?\-#&]*)*$'."/'";
          if(preg_match($xsRegEx_url, $Object->getValue())==0)
            $w = TRUE;
          break;
        case "time":
          $w = true;
          $ex = explode(":",$Object->getValue());
          if(count($ex) == 3 && $ex[0]>-839 && $ex[0]<839 && $ex[1]>=0 && $ex[1]<60  && $ex[2]>=0 && $ex[2]<60)
              $w = false;
          break;
        case "date":
          $w = true;
          if (preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $Object->getValue(), $matches))
            if (checkdate($matches[2], $matches[3], $matches[1]))
              $w = false;
          break;
        case "datetime":
          $w = true;
          if (preg_match("/^(\d{4})-(\d{2})-(\d{2}) ([01][0-9]|2[0-3]):([0-5][0-9]):([0-5][0-9])$/", $Object->getValue(), $matches))
            if (checkdate($matches[2], $matches[3], $matches[1]))
              $w = false;
          break;
        case "":
          break;
        default:
          echo "Type ".$this->getElement(3)." nicht definiert";
          $w = TRUE;
          break;
      }

      if ($w)
      {
          $this->params["warning"][$Object->getId()]=$this->params["error_class"];
          $this->params["warning_messages"][$Object->getId()] = $this->getElement(4);

      }

    }
  }


  function getDescription()
  {
    return "type -> prüft auf typ,beispiel: validate|type|label|int(oder float/numeric/string/email/url/date/datetime)|Fehlermeldung|[1= Feld darf auch leer sein]";
  }

  function getLongDescription()
  {
    return "Hiermit lassen sich verschiedenste Typen prüfen. von int/float/numeric/string/email/url/date. mit dem letzen optionalen Parameter kann man definieren ob ein leerer Wert akzeptiert wird.";
  }

  function getDefinitions()
  {

      return array(
        'type' => 'validate',
        'name' => 'type',
        'values' => array(
          array( 'type' => 'select_name', 'label' => 'Name' ),
          array( 'type' => 'select',		'label' => 'Prüfung nach:', 'default' => '', 'definition' => 'int,float,numeric,string,email,url,date,datetime' ),
          array( 'type' => 'text',		'label' => 'Fehlermeldung'),
          array( 'type' => 'boolean',		'label' => 'Feld muss nicht ausgefüllt werden', 'default' => 0 ),
        ),
        'description' => 'Es kann nach verschiedenen Typen geprüft werden (int/float/numeric/string/email/url/date)',
      );

  }






}