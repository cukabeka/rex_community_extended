<?php

class rex_xform_prio extends rex_xform_abstract
{

	function enterObject()
	{
		// $this->getElement(0) name of xform element
		// $this->getElement(1) db fieldname of xform element
		// $this->getElement(2) visible title of xform element
		// $this->getElement(3) db fieldname of value to show additionally in prio select
		// $this->getElement(4) position of "add with highest prio" option in prio select (top/bottom)

		$func = rex_request("func","string","");

		// sanitize prios on form load
		if ($this->params['send'] == 0)
		{
			$SPM = new sql_prio_manager($this->params['main_table'],$this->getElement(1),'',true);
			unset($SPM);
		}

		// get entries (with sanitized prios) ordered by prio
		$db = rex_sql::factory();
		$res = $db->getArray('SELECT * FROM '.$this->params['main_table'].' ORDER BY '.$this->getElement(1).' ASC');


		// build prio select
		$select = new rex_select();
		$select->setSize(1);
		$select->setName($this->getFieldName());
		$select->setId($this->getFieldId());


		// add option with prio 1 for empty tables
		if (!count($res))
		{
			$select->addOption('1 (-------)', 1);
			$select->setSelected(1);
		}

		// add existing options
		else
		{
			foreach ($res as $val)
			{
				if ($func == 'edit' && $val['id'] == $this->params['main_id'])
				{
					$select->setSelected($val[$this->getElement(1)]);
				}
				// build name
				$name = $val[$this->getElement(1)];
				// if additional name column exists, add value
				if (isset($val[$this->getElement(3)]))
				{
					$name .= ' ('.$val[$this->getElement(3)].')';
				}
				$select->addOption($name, $val[$this->getElement(1)]);
			}


			// add last option (highest priority + 1)
			if ($func == 'add')
			{
				$highest_prio = count($res) + 1;
				$select->addOption($highest_prio.' (-------)', $highest_prio);

				// select last option
				if ('top' == $this->getElement(4))
				{
					$select->setSelected($highest_prio);
				}
			}
		}


		$this->params["form_output"][$this->getId()] = '
			<p class="formtext formlabel-'.$this->getName().'" id="'.$this->getHTMLId().'">
			<label for="' . $this->getFieldId() . '" >' . rex_translate($this->getElement(2)) . '</label>
			'.$select->get().'
			</p>';


		// form load
		if ($this->params['send'] == 0)
		{
			if ($func == 'edit')
			{
				// save old prio for prio manager call
				rex_set_session('table_manager_prio_class', $this->getValue());
			}
		}

		// form save
		else{
			$this->params['value_pool']['sql'][$this->getElement(1)] = $this->getValue();

			// increment all prios higher than the new one by 1
			if ($func == 'add')
			{
				$db->setQuery('UPDATE '.$this->params['main_table'].' 
					SET '.$this->getElement(1).'='.$this->getElement(1).'+1  
					WHERE '.$this->getElement(1).'>='.$this->getValue());
			}

			// check if prio changed and run prio manager if necessary
			if ($func == 'edit')
			{
				if (rex_session('table_manager_prio_class') != $this->getValue())
				{
					$SPM = new sql_prio_manager($this->params['main_table'],$this->getElement(1));
					$SPM->changeRowPrio(rex_session('table_manager_prio_class'),$this->getValue());
					unset($SPM);
				}
				rex_unset_session('table_manager_prio_class');
			}
		}

	}

	function getDescription()
	{
		return '';
	}

	function getDefinitions()
	{
		return array(
			'type' => 'value',
			'name' => 'prio',
			'values' => array(
					array( 'type' => 'name',	'label' => 'Feld' ),
					array( 'type' => 'text',	'label' => 'Bezeichnung'),
					array( 'type' => 'text',	'label' => 'Tabellenspalte (dieser Tabelle) um deren Wert das Prio-Select ergänzt wird'),
					array( 'type' => 'select',	'label' => 'vorausgewählte Prio für neue Einträge', 'default' => '', 'definition' => '1=bottom,Anzahl Datensätze + 1=top' )
				),
			'description' => 'Prio Management',
			'dbtype' => 'int',
			'famous' => false
		);
	}
}

?>