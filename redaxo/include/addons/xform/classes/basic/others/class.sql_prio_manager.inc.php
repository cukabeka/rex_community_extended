<?php

/**
 * SQL Prio Manager - autosorting shift of table rows by a priority field
 *
 * @package Redaxo 4.3.x/4.4.x
 * @author jdlx / rexdev.de
 **/

class sql_prio_manager
{
  private static $table;
  private static $field;
  private static $where;

  function __construct($table=false,$field='prio',$where='',$sanitize=false)
  {
    self::$table = $table;
    self::$field = $field;
    self::$where = $where;

    if($sanitize)
    {
      self::sanitize();
    }
  }


  /**
   * Make sure prios are set, unique and consecutive
   **/
  public function sanitize()
  {
    $table = self::$table;
    $field = self::$field;
    $where = self::$where!='' ? ' WHERE '.self::$where : '';

    $db = rex_sql::factory();
    $db->setQuery('SET @count=0;');
    return $db->setQuery('UPDATE `'.$table.'`
                          SET `'.$field.'`=(SELECT @count:=@count+1)
                          '.$where.'
                          ORDER BY `'.$field.'` ASC;');
  }


  /**
   * Change a row's prio and shift others accordingly
   *
   * @param  $from (int)   the old prio
   * @param  $to   (int)   the new prio
   * @return       (bool)  false on error, true on success
   **/
  public function changeRowPrio($from=false,$to=false)
  {
    if($from===false || $to===false || $from==$to)
    {
      return false;
    }

    $table = self::$table;
    $field = self::$field;
    $where = self::$where!='' ? ' AND '.self::$where : '';
    $db    = rex_sql::factory();

    // SET MYSQL VARS
    $db->setQuery('SET @from_prio='.(int) $from.',@to_prio='.(int) $to.',@count='.(int) $to.';');

    // REARRANGE REMAINING ROWS ACCORDING TO DIRECTION
    if($from>$to)
    {
      // move up (decrease prio)
      return $db->setQuery('UPDATE `'.$table.'`
                            SET `'.$field.'` = IF(`'.$field.'`=@from_prio, @to_prio, (SELECT @count:=@count+1))
                            WHERE `'.$field.'`>=@to_prio AND `'.$field.'`<=@from_prio '.$where.'
                            ORDER BY `'.$field.'` ASC;');
    }
    else
    {
      // move down (increase prio)
      return $db->setQuery('UPDATE `'.$table.'`
                            SET `'.$field.'` = IF(`'.$field.'`=@from_prio, @to_prio, (SELECT @count:=@count-1))
                            WHERE `'.$field.'`<=@to_prio AND `'.$field.'`>=@from_prio '.$where.'
                            ORDER BY `'.$field.'` DESC;');
    }

  } // END changeRowPrio

} // END class
