<?php
/**
 * Metafix - Metainfo Plugin
 *
 * @author http://rexdev.de
 * @see https://github.com/jdlx/metafix
 *
 * @package redaxo 4.3.x/4.4.x
 * @version 1.0.0
 */

/**
 * Handle mismatched Metainfo fields
 **/
class metafix
{
  public $missing_fields;
  public $orphaned_fields;
  public $table_fields;
  public $metainfo_fields;
  public $metainfo_ids;
  public $types;
  public $missing_types;
  public $default_types = array(
    'text'                 => array('text',    0),
    'textarea'             => array('text',    0),
    'select'               => array('varchar', 255),
    'radio'                => array('varchar', 255),
    'checkbox'             => array('varchar', 255),
    'date'                 => array('text',    0),
    'time'                 => array('text',    0),
    'datetime'             => array('text',    0),
    'legend'               => array('text',    0),
    'REX_MEDIA_BUTTON'     => array('varchar', 255),
    'REX_MEDIALIST_BUTTON' => array('text',    0),
    'REX_LINK_BUTTON'      => array('varchar', 255),
    'REX_LINKLIST_BUTTON'  => array('text',    0),
    );

  public $missing_metainfo_core_fields;
  public $metainfo_core_fields = array(
    '62_params' => array(
      'field_id'     => 'int(10) unsigned NOT NULL auto_increment',
      'title'        => 'varchar(255) default NULL',
      'name'         => 'varchar(255) default NULL',
      'prior'        => 'int(10) unsigned NOT NULL',
      'attributes'   => 'text NOT NULL',
      'type'         => 'int(10) unsigned default NULL',
      'default'      => 'varchar(255) NOT NULL',
      'params'       => 'text default NULL',
      'validate'     => 'text NULL',
      'restrictions' => 'text NOT NULL',
      'createuser'   => 'varchar(255) NOT NULL',
      'createdate'   => 'int(11) NOT NULL',
      'updateuser'   => 'varchar(255) NOT NULL',
      'updatedate'   => 'int(11) NOT NULL',
      ),
    '62_type' => array(
      'id'       => 'int(10) unsigned NOT NULL auto_increment',
      'label'    => 'varchar(255) default NULL',
      'dbtype'   => 'varchar(255) NOT NULL',
      'dblength' => 'int(11) NOT NULL',
      )
  );



  function __construct()
  {
    global $REX;

    $this->types = array(
      'art_' =>$REX['TABLE_PREFIX'].'article',
      'cat_' =>$REX['TABLE_PREFIX'].'article',
      'med_' =>$REX['TABLE_PREFIX'].'file'
      );

    $this->metainfo_ids                 = self::get_metainfo_ids();
    $this->table_fields                 = self::get_fields('tables');
    $this->metainfo_fields              = self::get_fields('metainfo');
    $this->missing_fields               = self::get_mismatched('missing');
    $this->orphaned_fields              = self::get_mismatched('orphaned');
    $this->missing_types                = self::get_missing_types();
    $this->missing_metainfo_core_fields = self::get_missing_metainfo_core_fields();
  }

  /**
   * Get fields registered in Metainfo or present in tables
   *
   * @param string [$source] (tables|metainfo)
   * @return array containing all fields in $source
   **/
  private function get_fields($source=null)
  {
    global $REX;
    $metas = array();
    $db = rex_sql::factory();

    switch($source)
    {
      case 'tables':
        foreach ($this->types as $prefix => $table)
        {
          foreach($db->getDbArray('SHOW COLUMNS FROM `'.$table.'` LIKE \''.str_replace('_','\_',$prefix).'%\';') as $column)
          {
            $metas[$prefix][] = $column['Field'];
          }
        }
        break;

      case 'metainfo':
        foreach ($this->types as $prefix => $table)
        {
          foreach($db->getDbArray('SELECT `field_id`,`name` FROM `'.$REX['TABLE_PREFIX'].'62_params` WHERE `name` LIKE \''.str_replace('_','\_',$prefix).'%\';') as $column)
          {
            $metas[$prefix][] = $column['name'];
          }
        }
        break;

      default:
        return false;
        break;
    }

    foreach ($this->types as $prefix => $table)
    {
      $metas[$prefix] = !isset($metas[$prefix]) ? array() : $metas[$prefix];
      sort($metas[$prefix]);
    }
    ksort($metas);

    return $metas;
  }

  /**
   * Return all Metainfo fields with their DB id
   *
   * @return array (name=>field_id,...)
   **/
  function get_metainfo_ids()
  {
    global $REX;
    $metas = array();
    $db = rex_sql::factory();
    foreach($db->getDBArray('SELECT `field_id`,`name` FROM `'.$REX['TABLE_PREFIX'].'62_params`;') as $column)
    {
      $metas[$column['name']] = $column['field_id'];
    }
    return $metas;
  }

  /**
   * Get mismatched Metainfo fields
   *
   * @param string [$type] (missing|orphaned)
   * @return array containing mismatched fields sorted by prefix
   **/
  private function get_mismatched($type=null)
  {
    $missmatched = array();
    foreach ($this->types as $prefix => $table)
    {
      switch ($type)
      {
        case 'missing':
          $missmatched[$prefix] = array_diff($this->metainfo_fields[$prefix],$this->table_fields[$prefix]);
          break;

        case 'orphaned':
          $missmatched[$prefix] = array_diff($this->table_fields[$prefix],$this->metainfo_fields[$prefix]);
          break;

        default:
          return false;
          break;
      }
    }
    return $missmatched;
  }

  /**
   * Insert missing fields into their tables
   *
   * @param string [$prefix] (art_|cat_|med_)
   * @param string [$name] field name
   * @return bool
   **/
  public function insert_field($prefix=null,$name=null)
  {
    if(!$prefix && !$name)
      return false;

    if(in_array($name,$this->missing_fields[$prefix]))
    {
      $db = rex_sql::factory();
      if($db->setQuery('ALTER TABLE `'.$this->types[$prefix].'` ADD `'.$name.'` TEXT NOT NULL;'))
      {
        echo rex_info('Metainfo Field '.$name.' re-inserted.');
        return true;
      }
    }

    return false;
  }

  /**
   * Delete mismatched field from table or Metainfo
   *
   * @param string [$prefix] (art_|cat_|med_)
   * @param string [$name] field name
   * @param int [$field_id] field id in metainfo
   * @param string [$type] (missing|orphaned)
   * @return bool
   **/
  public function delete_field($prefix=null,$name=null,$field_id=null,$type=null)
  {
    if(!$prefix || !$name || !$type) {
      return false;
    }

    global $REX;
    $db = rex_sql::factory();

    switch ($type)
    {
      case 'missing':
        if(in_array($name,$this->missing_fields[$prefix]))
        {
          if($db->setQuery('DELETE FROM `'.$REX['TABLE_PREFIX'].'62_params` WHERE `field_id`='.$field_id.' AND `name`=\''.$name.'\';'))
          {
            echo rex_info('Missing Field ['.$field_id.'] '.$name.' deleted.');
            return true;
          }
        }
        break;

      case 'orphaned':
        if(in_array($name,$this->orphaned_fields[$prefix]))
        {
          if($db->setQuery('ALTER TABLE `'.$this->types[$prefix].'` DROP `'.$name.'`;'))
          {
            echo rex_info('Orphaned Field '.$name.' deleted.');
            return true;
          }
        }
        break;

      default:
        return false;
    }

    return false;
  }

  /**
   * Inser field into Metainfo with generic params
   *
   * @param string [$prefix] (art_|cat_|med_)
   * @param string [$name] field name
   * @return mixed (false|last insert id)
   **/
  function reasign_field($prefix=null,$name=null)
  {
    if(!$prefix || !$name) {
      return false;
    }

    if(in_array($name,$this->orphaned_fields[$prefix]))
    {
      global $REX;
      $db = rex_sql::factory();
      $db->setQuery('INSERT INTO `'.$REX['TABLE_PREFIX'].'62_params` VALUES(\'\', \'\', \''.$name.'\', 1, \'\', 1, \'\', \'\', NULL, \'\', \'metafix\', \'\', \'metafix\', \'\');');
      return $db->getLastId();
    }

    return false;
  }

  /**
   * Return all missing Metinfo Types
   *
   * @return array (label=>field_type,length...)
   **/
  function get_missing_types()
  {
    global $REX;
    $stack = $this->default_types;

    $db = rex_sql::factory();
    foreach($db->getDBArray('SELECT `label` FROM `'.$REX['TABLE_PREFIX'].'62_type`;') as $column)
    {
      unset($stack[$column['label']]);
    }
    return $stack;
  }

  /**
   * Re-Insert missing type
   *
   * @param  $label  string  rex_a62_types.label
   * @return         mixed   (false|last insert id)
   **/
  function rebuild_type($label=null)
  {
    if(!$label) {
      return false;
    }

    if(isset($this->missing_types[$label]))
    {
      global $REX;
      $db = rex_sql::factory();
      if($db->setQuery('INSERT INTO `'.$REX['TABLE_PREFIX'].'62_type` VALUES(\'\', \''.$label.'\', \''.$this->missing_types[$label][0].'\', '.$this->missing_types[$label][1].');')){
        return $db->getLastId();
      }
    }

    return false;
  }


  /**
   * Check for missing fields in metainfo core tables
   *
   * @return         array
   **/
  function get_missing_metainfo_core_fields()
  {

    global $REX;
    $stack = $this->metainfo_core_fields;

    foreach($stack as $table =>$def) {
      $db = rex_sql::factory();
      foreach($db->getDBArray('SHOW COLUMNS FROM `'.$REX['TABLE_PREFIX'].$table.'`;') as $column) {
        unset($stack[$table][$column['Field']]);
      }
    }
    return $stack;
  }


  /**
   * Rebulid missing field in metainfo core tables
   *
   * @param  $table  string  metainfo core table
   * @param  $field  string  metainfo core table.field
   * @return         bool
   **/
  function rebuild_core_field($table=null,$field=null)
  {
    if(!$table || !$field) {
      return false;
    }

    if(isset($this->missing_metainfo_core_fields[$table][$field]))
    {
      global $REX;
      $field_def = $this->missing_metainfo_core_fields[$table][$field];
      $qry = 'ALTER TABLE `'.$REX['TABLE_PREFIX'].$table.'` ADD `'.$field.'` '.$field_def.';';
      $db = rex_sql::factory();
      return $db->setQuery($qry);
    }

    return false;
  }


} // END class metafix
