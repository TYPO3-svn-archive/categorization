<?php

class tx_categorization_lib {


	/**
	 * Hook to add stuff to where statement created in enableFields
	 *
	 * @param	string		Parameters sent by enableFields
	 * @param	string		Parent object
	 * @return	string		AND sql-clause
	 * @see enableFields()
	 */
	function addEnableColumns ( $params, $pObj ) {

		$allowedTables = $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['categorization/lib/class.tx_categorization_lib.php']['allowedTables'];
		
		if ( TYPO3_MODE != 'FE' || !in_array($params['table'], $allowedTables ) ) { return false; }

#$selectedCategories = t3lib_div::_GP('cat');
#print '<pre>';
#print_r($params);
#print_r($GLOBALS['TSFE']->gr_list);
#print_r($GLOBALS['TSFE']->page);
#print($GLOBALS['TSFE']->page['tx_categorization_categories']);
#print_r($GLOBALS['TSFE']->rootLine);
#exit;		

		$treeObj = t3lib_div::makeInstance('tx_categorization_pi1');
		#print $treeObj->piVars['cat'];

			// 
		if ( intval($treeObj->piVars['cat']) ) {
			$pageCategories = t3lib_div::trimExplode(',', $treeObj->piVars['cat']);
		}
		else {
			$i = 0;
			foreach ( $GLOBALS['TSFE']->rootLine as $page ) {
				if ( $i > $GLOBALS['TSFE']->page['tx_categorization_recursive'] || count($pageCategories) > 0 ) {
					break;
				}
					
				$select_deselect_categories = $page['tx_categorization_select_deselect_categories'];
				if ( $select_deselect_categories != 0 ) {
					$pageCategories = t3lib_div::trimExplode(',', $page['tx_categorization_categories'], 1);
				}
			
				$i++;
			}
		}

		if ( count($pageCategories) > 0 ) {
			$sql = $this->getMultipleCategoriesWhereClause($params['table'].'.tx_categorization_categories', $params['table'], $pageCategories, $select_deselect_categories );
		}
		else $sql = '';
		
		return $sql;

	}

	/**
	 * Creating where-clause for selected categories to elements in enableFields function
	 *
	 * @param	string		Field with group list
	 * @param	string		Table name
	 * @return	string		AND sql-clause
	 * @see enableFields()
	 */
	function getMultipleCategoriesWhereClause($field, $table, $pageCategories, $select_deselect_categories )	{
		
		$orChecks=array();

		foreach($pageCategories as $value)	{
			$orChecks[] = $GLOBALS['TYPO3_DB']->listQuery($field, $value, $table);
		}

		$mode = 'AND';
		if ( $select_deselect_categories == 1 ) {
			$andOr = 'OR';
		}
		elseif ( $select_deselect_categories == 2 ) {
			$andOr = 'AND';
		}
		elseif ( $select_deselect_categories == 3 ) {
			$andOr = 'AND'; 
			$mode = 'AND NOT';
		}
		elseif ( $select_deselect_categories == 4 ) {
			$andOr = 'OR'; 
			$mode = 'AND NOT';
		}

		return ' '.$mode.' ('.implode(' '.$andOr.' ',$orChecks).')';
		
	}

	
}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/lib/class.tx_categorization_lib.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/lib/class.tx_categorization_lib.php']);
}

?>