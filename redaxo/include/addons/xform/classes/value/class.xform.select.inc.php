<?php

class rex_xform_select extends rex_xform_abstract
{

  function enterObject()
  {
    $SEL = new rex_select();
    $SEL->setId($this->getFieldId());

    // OPTIONS
    $options = self::stringToArray($this->getElement(3));
    foreach($options as $value => $name)
    {
      $SEL->addOption(rex_translate($value, null, false), $name);
    }

    // MULTISELECT
    if($this->getElement(6)==1)
    {
      $size = (int) $this->getElement(7);
      if($size < 2)
        $size = count($fields);

      $SEL->setName($this->getFieldName()."[]");
      $SEL->setSize($size);
      $SEL->setMultiple(1);
    }else
    {
      $SEL->setName($this->getFieldName());
      $SEL->setSize(1);
    }


    // DEFAULT VALUE
    if (!$this->params["send"] && $this->getValue()=="" && $this->getElement(5) != ""){
      $this->setValue($this->getElement(5));
    }

    if(!is_array($this->getValue())) {
      $this->setValue(explode(",",$this->getValue()));
    }

    foreach($this->getValue() as $v) {
      $SEL->setSelected($v);
    }

    $this->setValue(implode(",",$this->getValue()));

    $wc = "";
    if (isset($this->params["warning"][$this->getId()])) {
      $wc = $this->params["warning"][$this->getId()];
    }

    $SEL->setStyle(' class="select '.$wc.'"');


    // TRANSFORM "optgroup" VALUES TO OPTGROUPS
    $SEL = self::parseOptgroups($SEL->get());


    $this->params["form_output"][$this->getId()] = '
      <p class="formselect '.$this->getHTMLClass().'" id="'.$this->getHTMLId().'">
      <label class="select '.$wc.'" for="'.$this->getFieldId().'" >'.rex_translate($this->getElement(2)).'</label>'.
    $SEL.
      '</p>';

    $this->params["value_pool"]["email"][$this->getElement(1)] = $this->getValue();
    if ($this->getElement(4) != "no_db") $this->params["value_pool"]["sql"][$this->getElement(1)] = $this->getValue();

  }

  function getDescription()
  {
    return "select -> Beispiel: select|gender|Geschlecht *|Obst=optgroup,Apfel=a,Gemüse=optgroup,Salat=s|[no_db]|defaultwert|multiple=1|selectsize";
  }

  function getDefinitions()
  {
    return array(
            'type' => 'value',
            'name' => 'select',
            'values' => array(
        array( 'type' => 'name',   'label' => 'Feld' ),
        array( 'type' => 'text',    'label' => 'Bezeichnung'),
        array( 'type' => 'text',    'label' => 'Selectdefinition, kommasepariert',   'example' => 'w=Frau,m=Herr'),
        array( 'type' => 'no_db',   'label' => 'Datenbank',          'default' => 0),
        array( 'type' => 'text',    'label' => 'Defaultwert'),
        array( 'type' => 'boolean', 'label' => 'Mehrere Felder möglich'),
        array( 'type' => 'text',    'label' => 'Höhe der Auswahlbox'),
        ),
            'description' => 'Ein Selectfeld mit festen Definitionen',
            'dbtype' => 'text'
            );

  }


  static function getListValue($params)
  {
    $return = array();

    $values = array();
    foreach (explode(',', $params['params']['field']['f3']) as $v)
    {
      $entry = explode('=', $v);
      if (isset($entry[1]))
        $values[$entry[1]] = rex_translate($entry[0]);
      else
        $values[$entry[0]] = rex_translate($entry[0]);
    }

    foreach(explode(",",$params['value']) as $k)
      if(isset($values[$k]))
        $return[] = $values[$k];

    return implode("<br />",$return);
  }


  static function parseOptgroups($select_html)
  {
    preg_match_all('@<option[^>]*value="optgroup"[^>]*>([^<]+)</option>@', $select_html, $matches);
    if(count($matches[0]) > 0 && count($matches[0][0]) > 0)
    {
      $i = 0;
      foreach($matches as $match)
      {
        if($i == 0){
          $select_html = str_replace($matches[0][$i],'<optgroup label="'.$matches[1][$i].'">',$select_html);
        }else{
          $select_html = str_replace($matches[0][$i],'</optgroup><optgroup label="'.$matches[1][$i].'">',$select_html);
        }
        $i++;
      }
      $select_html = str_replace('</select>','</optgroup></select>',$select_html);
    }
    return $select_html;
  }


  function stringToArray($str, $delimiter_1 = ',' , $delimiter_2 = '=' )
  {
    $return = array();

    $parts = explode($delimiter_1 , $str);
    foreach($parts as $p)
    {
      if($p != '')
      {
        $subparts = explode($delimiter_2, $p);
        $return[$subparts[0]] = isset($subparts[1]) ? $subparts[1] : $subparts[0];
      }
    }
    return $return; # ([^=,]*)=([^=,]*)
  }

}

?>
