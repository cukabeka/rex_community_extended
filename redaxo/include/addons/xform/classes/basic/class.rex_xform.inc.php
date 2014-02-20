<?php

/**
 * XForm
 * @author jan.kristinus[at]redaxo[dot]de Jan Kristinus
 * @author <a href="http://www.yakamara.de">www.yakamara.de</a>
 */

class rex_xform
{

  var $ValueObjectsparams;

  function rex_xform()
  {
    global $REX;

    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/'.'class.xform.value.abstract.inc.php');
    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/'.'class.xform.action.abstract.inc.php');
    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/'.'class.xform.validate.abstract.inc.php');

    $this->objparams = array();

    // --------------------------- editable via objparams|key|newvalue

    $this->objparams["answertext"] = "";
    $this->objparams["submit_btn_label"] = "Abschicken";
    $this->objparams["submit_btn_show"] = TRUE;

    $this->objparams["actions"] = array();

    $this->objparams["error_class"] = 'form_warning';
    $this->objparams["unique_error"] = "";
    $this->objparams["unique_field_warning"] = "not unique";

    $this->objparams["article_id"] = 0;
    $this->objparams["clang"] = 0;

    $this->objparams["real_field_names"] = FALSE;

    $this->objparams["form_method"] = "post";
    $this->objparams["form_action"] = "index.php";
    $this->objparams["form_anchor"] = "";
    $this->objparams["form_showformafterupdate"] = 0;
    $this->objparams["form_show"] = TRUE;
    $this->objparams["form_name"] = "formular";
    $this->objparams["form_id"] = "form_formular";
    $this->objparams["form_wrap"] = array('<div id="rex-xform" class="xform">','</div>'); // or: <div id="rex-xform" class="xform">#</div>

    $this->objparams["actions_executed"] = FALSE;
    $this->objparams["postactions_executed"] = FALSE;

    $this->objparams["Error-occured"] = "";
    $this->objparams["Error-Code-EntryNotFound"] = "ErrorCode - EntryNotFound";
    $this->objparams["Error-Code-InsertQueryError"] = "ErrorCode - InsertQueryError";

    $this->objparams["getdata"] = FALSE;


    // --------------------------- do not edit

    $this->objparams['object_path'] = $REX["INCLUDE_PATH"]."/addons/xform/classes/";
    $this->objparams['debug'] = FALSE;

    $this->objparams['form_data'] = "";
    $this->objparams["output"] = "";

    $this->objparams["main_where"] = ""; // z.B. id=12
    $this->objparams["main_id"] = -1; // unique ID
    $this->objparams["main_table"] = ""; // for db and unique

    $this->objparams["form_hiddenfields"] = array();

    $this->objparams["warning"] = array ();
    $this->objparams["warning_messages"] = array ();

    $this->objparams["fieldsets_opened"] = 0; //

    $this->objparams["form_elements"] = array();
    $this->objparams["form_output"] = array();

    $this->objparams["value_pool"] = array();
    $this->objparams["value_pool"]["email"] = array();
    $this->objparams["value_pool"]["sql"] = array();

    $this->objparams["value"] = array(); // reserver for classes - $this->objparams["value"]["text"] ...
    $this->objparams["validate"] = array(); // reserver for classes
    $this->objparams["action"] = array(); // reserver for classes

    $this->objparams["this"] = $this;

  }

  function setDebug($s = TRUE) {
    $this->objparams['debug'] = $s;
  }

  function setFormData($form_definitions,$refresh = TRUE) {
    $this->setObjectparams("form_data",$form_definitions,$refresh);

    $this->objparams["form_data"] = str_replace("\n\r", "\n" ,$this->objparams["form_data"]); // Die Definitionen
    $this->objparams["form_data"] = str_replace("\r", "\n" ,$this->objparams["form_data"]); // Die Definitionen

    if(!is_array($this->objparams["form_elements"])) {
      $this->objparams["form_elements"] = array();
    }

    $form_elements_tmp = array ();
    $form_elements_tmp = explode("\n", $this->objparams['form_data']);

    // CLEAR EMPTY AND COMMENT LINES
    foreach($form_elements_tmp as $form_element) {
      $form_element = trim($form_element);
      if($form_element != "" && $form_element[0] != '#' && $form_element[0] != '/') {
        $this->objparams["form_elements"][] = explode("|", trim($form_element));
      }
    }
  }

  function setValueField($type = "",$values = array()) {
    $values = array_merge(array($type),$values);
    $this->objparams["form_elements"][] = $values;
  }

  function setValidateField($type = "",$values = array()) {
    $values = array_merge(array("validate",$type),$values);
    $this->objparams["form_elements"][] = $values;
  }

  function setActionField($type = "",$values = array()) {
    $values = array_merge(array("action",$type),$values);
    $this->objparams["form_elements"][] = $values;
  }

  function setRedaxoVars($aid = "",$clang = "",$params = array()) {
    global $REX;

    if ($clang == "") {
      $clang = $REX["CUR_CLANG"];
    }
    if ($aid == "") {
      $aid = $REX["ARTICLE_ID"];
    }

    $this->setHiddenField("article_id",$aid);
    $this->setHiddenField("clang",$clang);

    $this->setObjectparams("form_action", rex_getUrl($aid, $clang, $params));
  }

  function setHiddenField($k,$v) {
    $this->objparams["form_hiddenfields"][$k] = $v;
  }

  function setObjectparams($k, $v, $refresh = TRUE) {
    if (!$refresh && isset($this->objparams[$k])) {
      $this->objparams[$k] .= $v;
    }else {
      $this->objparams[$k] = $v;
    }
    return $this->objparams[$k];
  }

  function getObjectparams($k) {
    if(!isset($this->objparams[$k])) {
      return FALSE;
    }
    return $this->objparams[$k];
  }

  function getForm() {

    global $REX;

    $preg_user_vorhanden = "~\*|:|\(.*\)~Usim"; // Preg der Bestimmte Zeichen/Zeichenketten aus der Bezeichnung entfernt

    $ValueObjects = array();
    $ValidateObjects = array();

    // *************************************************** ABGESCHICKT PARAMENTER
    $this->objparams["send"] = 0;

    if ($this->getFieldValue("send",'',"send") == "1")
    {
      $this->objparams["send"] = 1;
    }


    // *************************************************** VALUE OBJEKTE
    $rows = count($this->objparams["form_elements"]);
    for ($i = 0; $i < $rows; $i++)
    {
      $element = $this->objparams["form_elements"][$i];
      if($element[0]=='submit'){
        $this->objparams["submit_btn_show"] = false;
      }
      $ValueObjects = $this->_setValueElement($ValueObjects, $element, $i);
      $rows = count($this->objparams["form_elements"]); // if elements have changed -> new rowcount
    }

    // *************************************************** VALUE OBJEKTE
    if ($this->objparams["submit_btn_show"])
    {
      $i++;
      $element = array("submit","rex_xform_submit", $this->objparams["submit_btn_label"],"no_db");
      $ValueObjects = $this->_setValueElement($ValueObjects, $element, $i);
    }


    // *************************************************** PRE VALUES
    // Felder aus Datenbank auslesen - Sofern Aktualisierung
    if ($this->objparams['getdata'])
    {
      $this->objparams["sql_object"] = rex_sql::factory();
      $this->objparams["sql_object"]->debugsql = $this->objparams['debug'];
      $this->objparams["sql_object"]->setQuery("SELECT * from ".$this->objparams["main_table"]. " WHERE ".$this->objparams["main_where"]);
      if ($this->objparams["sql_object"]->getRows() > 1 || $this->objparams["sql_object"]->getRows() == 0) {
        $this->objparams["warning"][] = $this->objparams["Error-Code-EntryNotFound"];
        $this->objparams["warning_messages"][] = $this->objparams["Error-Code-EntryNotFound"];
        $this->objparams["form_show"] = TRUE;
        unset($this->objparams["sql_object"]);
      }
    }


    // ----- Felder mit Werten fuellen, fuer wiederanzeige
    // Die Value Objekte werden mit den Werten befuellt die
    // aus dem Formular nach dem Abschicken kommen
    if (!($this->objparams["send"] == 1) && $this->objparams["main_where"] != "")
    {
      //  && $this->objparams['form_type'] != "3"
      for ($i = 0; $i < count($this->objparams["form_elements"]); $i++)
      {
        $element = $this->objparams["form_elements"][$i];
        if (($element[0]!="validate" && $element[0]!="action") and $element[1] != "")
        {
          if(isset($this->objparams["sql_object"]))
          {
            $this->setFieldValue($i,@addslashes($this->objparams["sql_object"]->getValue($element[1])),'',$element[1]);
          }
        }
        if($element[0]!="validate" && $element[0]!="action")
        {
          $ValueObjects[$i]->setValue($this->getFieldValue($i,'',$ValueObjects[$i]->getName()));
        }
      }
    }


    // *************************************************** VALIDATE OBJEKTE

    // ***** PreValidateActions
    foreach($ValueObjects as $value_object) {
      $value_object->preValidateAction();
    }

    for ($i = 0; $i < count($this->objparams["form_elements"]); $i++)
    {
      $element = $this->objparams["form_elements"][$i];
      if($element[0] == "validate")
      {
        foreach($REX['ADDON']['xform']['classpaths']['validate'] as $validate_path)
        {
          $classname = "rex_xform_validate_".trim($element[1]);
          if (@include_once ($validate_path.'class.xform.validate_'.trim($element[1]).'.inc.php'))
          {
            $count = 0;
            if (isset($ValidateObjects[$element[1]])) $count = count($ValidateObjects[$element[1]]);
            $ValidateObjects[$element[1]][$count] = new $classname;
            $ValidateObjects[$element[1]][$count]->loadParams($this->objparams, $element);
            $ValidateObjects[$element[1]][$count]->setObjects($ValueObjects);
            break;
          }
        }
      }
    }


    // ***** Validieren
    if ($this->objparams["send"] == 1) {
      if (isset($ValidateObjects) && count($ValidateObjects)>0) {
        foreach($ValidateObjects as $vObj) {
          foreach($vObj as $xoObject) {
            $xoObject->enterObject();
          }
        }
      }
    }


    // ***** PostValidateActions
    foreach($ValueObjects as $value_object) {
      $value_object->postValidateAction();
    }

    // *************************************************** FORMULAR ERSTELLEN

    foreach($ValueObjects as $value_object) {
      $value_object->enterObject();
    }

    if ($this->objparams["send"] == 1) {
      foreach($ValidateObjects as $vObj) {
        foreach($vObj as $xoObject) {
          $xoObject->postValueAction();
        }
      }
    }

    // ***** PostFormActions
    foreach($ValueObjects as $value_object) {
      $value_object->postFormAction();
    }


    // *************************************************** ACTION OBJEKTE

    // ID setzen, falls vorhanden
    if($this->objparams["main_id"]>0) {
      $this->objparams["value_pool"]["email"]["ID"] = $this->objparams["main_id"];
    }

    for ($i = 0; $i < count($this->objparams["form_elements"]); $i++)
    {
      $element = $this->objparams["form_elements"][$i];
      if($element[0]=="action")
      {
        $this->objparams["actions"][] = array(
          "type" => trim($element[1]),
          "elements" => $element,
        );
      }
    }

    $hasWarnings = count($this->objparams["warning"]) != 0;
    $hasWarningMessages = count($this->objparams["warning_messages"]) != 0;

    // ----- Actions
    if ($this->objparams["send"] == 1 && !$hasWarnings && !$hasWarningMessages)
    {
      $this->objparams["form_show"] = FALSE;

      $i=-1;
      if (count($this->objparams["actions"]))
      {
        foreach($this->objparams["actions"] as $action)
        {
          $i++;
          foreach($REX['ADDON']['xform']['classpaths']['action'] as $action_path)
          {
            $type = 'action_'.$action["type"];
            if (@include_once ($action_path.'class.xform.'.$type.'.inc.php'))
            {
              $classname = 'rex_xform_'.$type;
              $actions[$i] = new $classname;
              $actions[$i]->loadParams($this->objparams,$action["elements"]);
              $actions[$i]->setObjects($ValueObjects);
            }
          }
        }
        foreach($actions as $action) {
          $action->execute();
        }
      }

      $this->objparams["actions_executed"] = TRUE;

      // PostActions
      foreach($ValueObjects as $value_object) {
        $value_object->postAction($this->objparams["value_pool"]["email"], $this->objparams["value_pool"]["sql"]);
      }

      $this->objparams["postactions_executed"] = TRUE;

    }

    $hasWarnings = count($this->objparams["warning"]) != 0;
    $hasWarningMessages = count($this->objparams["warning_messages"]) != 0;

    if($this->objparams["form_showformafterupdate"])
    {
      $this->objparams["form_show"] = TRUE;
    }

    if($this->objparams["form_show"])
    {

      // -------------------- send definition
      $this->setHiddenField($this->getFieldName("send","","send"),1);

      // -------------------- form start
      if($this->objparams["form_anchor"] != ""){ $this->objparams["form_action"] .= '#'.$this->objparams["form_anchor"]; }

      // -------------------- warnings output
      $warningOut = '';
      $hasWarningMessages = count($this->objparams["warning_messages"]) != 0;
      if ($this->objparams["unique_error"] != '' || $hasWarnings || $hasWarningMessages)
      {
        $warningListOut = '';
        if($hasWarningMessages)
        {
          foreach($this->objparams["warning_messages"] as $k => $v) {
            $warningListOut .= '<li>'. rex_translate($v, null, false) .'</li>';
          }
        }
        if($this->objparams["unique_error"] != '')
        {
          $warningListOut .= '<li>'. rex_translate( preg_replace($preg_user_vorhanden, "", $this->objparams["unique_error"]) ) .'</li>';
        }

        if ($warningListOut != '')
        {
          if ($this->objparams["Error-occured"] != "")
          {
            $warningOut .= '<dl class="' . $this->objparams["error_class"] . '">';
            $warningOut .= '<dt>'. $this->objparams["Error-occured"] .'</dt>';
            $warningOut .= '<dd><ul>'. $warningListOut .'</ul></dd>';
            $warningOut .= '</dl>';
          }else
          {
            $warningOut .= '<ul class="' . $this->objparams["error_class"] . '">'. $warningListOut .'</ul>';
          }
        }
      }

      // -------------------- formFieldsOut output
      $formFieldsOut = '';
      foreach ($this->objparams["form_output"] as $v)
      {
        $formFieldsOut .= $v;
      }

      // -------------------- hidden fields
      $hiddenOut = '';
      foreach($this->objparams["form_hiddenfields"] as $k => $v) {
        $hiddenOut .= '<input type="hidden" name="'.$k.'" value="'.htmlspecialchars($v).'" />';
      }

      // -------------------- formOut
      $formOut = $warningOut;
      $formOut .= '<form action="'.$this->objparams["form_action"].'" method="'.$this->objparams["form_method"].'" id="' . $this->objparams["form_id"] . '" enctype="multipart/form-data">';
      $formOut .= $formFieldsOut;
      $formOut .= $hiddenOut;
      for($i=0;$i<$this->objparams["fieldsets_opened"];$i++) { $formOut .= '</fieldset>'; }
      $formOut .= '</form>';

      if(!is_array($this->objparams["form_wrap"]))
          $this->objparams["form_wrap"] = explode("#",$this->objparams["form_wrap"]);

      $this->objparams["output"] .= $this->objparams["form_wrap"][0].$formOut.$this->objparams["form_wrap"][1];

    }

    return $this->objparams["output"];

  }



  private function _setValueElement(&$ValueObjects, $element, $i)
  {
    global $REX;
    if($element[0] == "validate")
    {

    }elseif($element[0] == "action")
    {

    }else
    {
      foreach($REX['ADDON']['xform']['classpaths']['value'] as $value_path)
      {
        $classname = "rex_xform_".trim($element[0]);
        if (@include_once ($value_path.'class.xform.'.trim($element[0]).'.inc.php'))
        {
          $ValueObjects[$i] = new $classname;
          $ValueObjects[$i]->loadParams($this->objparams,$element);
          $ValueObjects[$i]->setId($i);
          $ValueObjects[$i]->init();
          $ValueObjects[$i]->setValue($this->getFieldValue($i,'',$ValueObjects[$i]->getName()));
          $ValueObjects[$i]->setValueObjects($ValueObjects);
          break;

        }
      }
    }

    return $ValueObjects;
  }

  static function includeClass($type_id, $class)
  {
    global $REX;

    $classname = 'rex_xform_'.$type_id.'_'.$class;
    $filename  = 'class.xform.'.$type_id.'.'.$class.'.inc.php';
    switch($type_id)
    {
      case('value'):
        if (!class_exists('rex_xform_abstract'))
        {
          require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.value.abstract.inc.php');
        }
        $filename  = 'class.xform.'.$class.'.inc.php';
        $classname = 'rex_xform_'.$class;
        break;
      case('validate'):
        if (!class_exists('rex_xform_validate_abstract'))
        {
          require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.validate.abstract.inc.php');
        }
        break;
      case('action'):
        if (!class_exists('rex_xform_action_abstract'))
        {
          require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.action.abstract.inc.php');
        }
        break;
      default:
        return FALSE;
    }

    if (class_exists($classname))
    return $classname;

    foreach($REX['ADDON']['xform']['classpaths'][$type_id] as $path)
    {
      @include_once($path.$filename);

      if (class_exists($classname))
      {
        return $classname;
      }
    }
    return FALSE;

  }

  function getTypes()
  {
    return array('value','validate','action');
  }

  function getFieldName($id = "", $k = "", $label = "")
  {
    $label = $this->prepareLabel($label);
    $k = $this->prepareLabel($k);
    if($this->objparams["real_field_names"] && $label != "")
    {
      if($k == "")
      {
        return $label;
      }else {
        return $label.'['.$k.']';
      }
    }else
    {
      if($k == "")
      {
        return 'FORM['.$this->objparams["form_name"].']['.$id.']';
      }else
      {
        return 'FORM['.$this->objparams["form_name"].']['.$id.']['.$k.']';
      }
    }
  }

  function getFieldValue($id = "", $k = "", $label = "")
  {
    $label = $this->prepareLabel($label);
    $k = $this->prepareLabel($k);
    if($this->objparams["real_field_names"] && $label != "")
    {
      if($k == "" && isset($_REQUEST[$label]))
      {
        return $_REQUEST[$label];
      }elseif(isset($_REQUEST[$label][$k]))
      {
        return $_REQUEST[$label][$k];
      }
    }else
    {
      if($k == "" && isset($_REQUEST["FORM"][$this->objparams["form_name"]][$id]))
      {
        return $_REQUEST["FORM"][$this->objparams["form_name"]][$id];
      }elseif(isset($_REQUEST["FORM"][$this->objparams["form_name"]][$id][$k]))
      {
        return $_REQUEST["FORM"][$this->objparams["form_name"]][$id][$k];
      }
    }
  return "";
  }

  function setFieldValue($id = "", $value = "", $k = "", $label = "")
  {
    $label = $this->prepareLabel($label);
    $k = $this->prepareLabel($k);
    if($this->objparams["real_field_names"] && $label != "") {
      if($k == "") {
        $_REQUEST[$label] = $value;
      }else {
        $_REQUEST[$label][$k] = $value;
      }
      return;
    }else
    {
      if($k == "") {
        $_REQUEST["FORM"][$this->objparams["form_name"]][$id] = $value;
      }else {
        $_REQUEST["FORM"][$this->objparams["form_name"]][$id][$k] = $value;
      }
    }
  }

  function prepareLabel($label)
  {
    return preg_replace('/[^a-zA-Z\-\_0-9]/', '-', $label);;
  }

  // ----- Hilfsfunktionen -----

  static function unhtmlentities($text)
  {
    if (!function_exists('unhtmlentities'))
    {
      function unhtmlentities($string)
      {
        // Ersetzen numerischer Darstellungen
        $string = preg_replace('~&#x([0-9a-f]+);~ei', 'chr(hexdec("\\1"))', $string);
        $string = preg_replace('~&#([0-9]+);~e', 'chr("\\1")', $string);
        // Ersetzen benannter Zeichen
        $trans_tbl = get_html_translation_table(HTML_ENTITIES);
        $trans_tbl = array_flip($trans_tbl);
        return strtr($string, $trans_tbl);
      }
    }
    return unhtmlentities($text);
  }


  static function getTypeClasses($type)
  {                                                                                                                     #FB::group(__CLASS__.'::'.__FUNCTION__, array("Collapsed"=>false));
    global $REX;

    switch($type){
      case'value':
        require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.value.abstract.inc.php');
        $glob = 'class.xform.*.inc.php';
        break;
      case'validate':
        require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.validate.abstract.inc.php');
        $glob = 'class.xform.validate_*.inc.php';
        break;
      case'action':
        require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.action.abstract.inc.php');
        $glob = 'class.xform.action_*.inc.php';
        break;
      default:                                                                                                          #FB::groupEnd();
        return false;
    }

    $cwd          = getcwd();
    $type_classes = array();
    foreach($REX['ADDON']['xform']['classpaths'][$type] as $dir)
    {
      if(file_exists($dir) && is_dir($dir)){
        chdir($dir);
        foreach(glob($glob) as $class)
        {
          $type_classes[$class] = $dir;
        }
      }
    }
    chdir($cwd);
    ksort($type_classes);                                                                                               #FB::log($type_classes,' $type_classes'); FB::groupEnd();
    return($type_classes);
  }


  static function getJSClassArray()
  {                                                                                                                     #FB::group(__CLASS__.'::'.__FUNCTION__, array("Collapsed"=>false));
    $js_array_string = '';

    foreach(array('value','validate','action') as $type) {
      $type_classes = self::getTypeClasses($type);                                                                      #FB::log($stack[$type],' $stack[$type]');
      foreach($type_classes as $file => $path) {
        $description = self::getClassDescription($path, $file, false);                                                  #FB::log($description,' $description');
        $examples    = self::getClassExampleInput($description);                                                        #FB::log($example,' $example');
        foreach($examples as $example){
          $js_array_string .= '{ type: \''.$type.'\', value: \''.htmlspecialchars($example).'\' },'.PHP_EOL;
        }
      }
      unset($type_classes);
    }                                                                                                                   #FB::log($js_array_string,' $js_array_string'); FB::groupEnd();
    return rtrim($js_array_string,',');
  }


  static function getClassDescription($path, $file, $format=true)
  {
    if(file_exists($path.$file) && !is_dir($path.$file))
    {
      $classname = str_replace(array('class.xform.','.inc.php'),array('rex_xform_',''),$file);
      include_once($path.$file);
      $class = new $classname;

      return $format
             ? self::formatClassDescription($class->getDescription())
             : $class->getDescription();
    }
  }


  static function getClassExampleInput($description)
  {
    $description = str_replace('<br />',"\n",$description);
    if(preg_match_all('@\w+(?:\|[^\n\r]+)+@',$description,$match) != false) {                                           #FB::log($match,' $match');
      return $match[0];
    }else{
      return array();
    }
  }

  static function formatClassDescription($html)
  {                                                                                                                     #FB::group(__CLASS__.'::'.__FUNCTION__, array("Collapsed"=>false)); FB::log($html,' $html');
    // NO FORMATING IF HTML TAGS FOUND
    if(preg_match('@</[^>]+>@',$html,$m) != false){                                                                     #fb('no mods..');FB::groupEnd();
      # return preg_replace('@\s+@',' ',$html);
      return $html;
    }

    $html = (strpos($html,'<br />') !== false)
          ? explode('<br />',$html)
          : (array) $html;                                                                                              #FB::log($html,count($html));

    foreach($html as $k => $block)
    {
      // FIX LEADING WHITESPACE
      $block = preg_replace('@^\s+@','',$block);                                                                        #FB::log($block,' $block');

      // STRIP REDUNDANT WORDING
      $block = str_replace(array('-> Beispiel:',', beispiel:',',beispiel:',', example:','<br />',"\n","\r"),array(' <i style="color:silver;">(no description)</i>',':',':',':',' <br /> ','',''),$block);

      // WRAP EXAMPLE CODE IN <CODE>
      $block = preg_replace('@\w+(?:\|[^\n\r]+)+@','<code class="xform-form-code">$0</code>',$block);

      // WRAP SHORTNAMES IN <STRONG>
      $block = preg_replace('@^\w+@m','<strong style="font-weight:bold;">$0</strong>',$block);

      // BREAK IN BETWEEN DESC AND CODE
      $block = str_replace(array(': <code','description)</i> <code'),array(':<br /><code','description)</i><br /><code'),$block);

      $html[$k] = $block;
    }
    $html = implode('<br />',$html);                                                                                    #FB::log($html,' $html'); FB::groupEnd();

    return $html;
  }

  static function getShortnameFromClassFile($classfile)
  {
    preg_match('@class.xform.(action_|validate_)*([\w-]+).inc.php@',$classfile,$m);
    return isset($m[2]) && $m[2]!='' ? $m[2] : false;
  }

  static function showHelp($return=false,$script=false)
  {
    $tmpl = '
<ul class="xform root">
  <li class="type value"><strong class="toggler">Value</strong>
    <ul class="xform type value">
      ###VALUE_LIS###
    </ul>
  </li>
  <li class="type validate"><strong class="toggler">Validate</strong>
    <ul class="xform type validate">
      ###VALIDATE_LIS###
    </ul>
  </li>
  <li class="type action"><strong class="toggler">Action</strong>
    <ul class="xform type action">
      ###ACTION_LIS###
    </ul>
  </li>
  ';

    $data = array('value'=>array(),'validate'=>array(),'action'=>array());
    foreach($data as $type => $classes)
    {
      $data[$type] = self::getTypeClasses($type);
      foreach($data[$type] as $file => $path)
      {
        $desc = self::getClassDescription($path,$file);
        if($desc!=''){
          $data[$type][self::getShortnameFromClassFile($file)] = $desc;
        }
        unset($data[$type][$file]);
      }
      $data[$type] = PHP_EOL.'      <li>'.implode('</li>'.PHP_EOL.'      <li>',array_values($data[$type])).'</li>'.PHP_EOL;
    }

    $html = str_replace(
                        array('###VALUE_LIS###','###VALIDATE_LIS###','###ACTION_LIS###'),
                        array($data['value']   ,$data['validate']   ,$data['action']),
                        $tmpl);

    if($script)
    {
      $html .= '
<script type="text/javascript">
(function($){

  $("ul.xform strong.toggler").click(function(){
    var me = $(this);
    var target = $(this).next("ul.xform");
    target.toggle(0, function(){
      if(target.css("display") == "block"){
        me.addClass("opened");
      }else{
        me.removeClass("opened");
      }
    });

  });

})(jQuery)
</script>
';
    }

    if($return) {
      return $html;
    } else {
      echo $html;
    }

  }







  static function getTypeArray()
  {

    global $REX;

    $return = array();

    // Value

    if (!class_exists('rex_xform_abstract'))
    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.value.abstract.inc.php');

    foreach($REX['ADDON']['xform']['classpaths']['value'] as $pos => $value_path)
    {
      if($Verzeichniszeiger = @opendir($value_path))
      {
        while($Datei = readdir($Verzeichniszeiger))
        {
          if (preg_match("/^(class.xform)/", $Datei) && !preg_match("/^(class.xform.validate|class.xform.abstract)/", $Datei))
          {
            if(!is_dir($Datei))
            {
              $classname = (explode(".", substr($Datei, 12)));
              $name = $classname[0];
              $classname = "rex_xform_".$name;
              if (file_exists($value_path.$Datei))
              {
                include_once($value_path.$Datei);
                $class = new $classname;
                $d = $class->getDefinitions();
                if(count($d)>0)
                $return['value'][$d['name']] = $d;
              }
            }
          }
        }
        closedir($Verzeichniszeiger);
      }
    }


    // Validate

    if (!class_exists('rex_xform_validate_abstract'))
    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.validate.abstract.inc.php');

    foreach($REX['ADDON']['xform']['classpaths']['validate'] as $pos => $validate_path)
    {
      if($Verzeichniszeiger = @opendir($validate_path))
      {
        while($Datei = readdir($Verzeichniszeiger))
        {
          if (preg_match("/^(class.xform.validate)/", $Datei) && !preg_match("/^(class.xform.validate.abstract)/", $Datei))
          {
            if(!is_dir($Datei))
            {
              $classname = (explode(".", substr($Datei, 12)));
              $name = $classname[0];
              $classname = "rex_xform_".$name;
              if (file_exists($validate_path.$Datei))
              {
                include_once($validate_path.$Datei);
                $class = new $classname;
                $d = $class->getDefinitions();
                if(count($d)>0)
                $return['validate'][$d['name']] = $d;
              }
            }
          }
        }
        closedir($Verzeichniszeiger);
      }
    }


    // Action

    if (!class_exists('rex_xform_action_abstract'))
    require_once($REX['INCLUDE_PATH'].'/addons/xform/classes/basic/class.xform.action.abstract.inc.php');

    foreach($REX['ADDON']['xform']['classpaths']['action'] as $pos => $action_path)
    {
      if($Verzeichniszeiger = @opendir($action_path))
      {
        while($Datei = readdir($Verzeichniszeiger))
        {
          if (preg_match("/^(class.xform.action)/", $Datei) && !preg_match("/^(class.xform.action.abstract)/", $Datei))
          {
            if(!is_dir($Datei))
            {
              $classname = (explode(".", substr($Datei, 12)));
              $name = $classname[0];
              $classname = "rex_xform_".$name;
              if (file_exists($action_path.$Datei))
              {
                include_once($action_path.$Datei);
                $class = new $classname;
                $d = $class->getDefinitions();
                if(count($d)>0)
                $return['action'][$d['name']] = $d;
              }
            }
          }
        }
        closedir($Verzeichniszeiger);
      }
    }

    return $return;

  }



}
