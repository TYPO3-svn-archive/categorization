<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Rik Willems <http://www.actiview.nl>
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
*
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/**
 * [CLASS/FUNCTION INDEX of SCRIPT]
 *
 * Hint: use extdeveval to insert/update function index above.
 */

require_once(PATH_tslib.'class.tslib_pibase.php');

require_once(t3lib_extMgm::extPath('categorization') . 'lib/class.tx_categorization_catmenu.php');
require_once(t3lib_extMgm::extPath('pagebrowse') . 'pi1/class.tx_pagebrowse_pi1.php');

/**
 * Plugin 'Categorization tree' for the 'categorization' extension.
 *
 * @author	Rik Willems <http://www.actiview.nl>
 * @package	TYPO3
 * @subpackage	tx_categorization
 */
class tx_categorization_pi1 extends tslib_pibase {
	var $prefixId      = 'tx_categorization_pi1';		// Same as class name
	var $scriptRelPath = 'pi1/class.tx_categorization_pi1.php';	// Path to this script relative to the extension dir.
	var $extKey        = 'categorization';	// The extension key.
	var $pi_checkCHash = true;
	
	/**
	 * The main method of the PlugIn
	 *
	 * @param	string		$content: The PlugIn content
	 * @param	array		$conf: The PlugIn configuration
	 * @return	The content that is displayed on the website
	 */
	function main($content, $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();
		
		/*
		$content='
			<strong>This is a few paragraphs:</strong><br />
			<p>This is line 1</p>
			<p>This is line 2</p>
	
			<h3>This is a form:</h3>
			<form action="'.$this->pi_getPageLink($GLOBALS['TSFE']->id).'" method="POST">
				<input type="text" name="'.$this->prefixId.'[input_field]" value="'.htmlspecialchars($this->piVars['input_field']).'">
				<input type="submit" name="'.$this->prefixId.'[submit_button]" value="'.htmlspecialchars($this->pi_getLL('submit_button_label')).'">
			</form>
			<br />
			<p>You can click here to '.$this->pi_linkToPage('get to this page again',$GLOBALS['TSFE']->id).'</p>
		';
		*/
		
		#print_r($this->cObj->data);
		
		$code = $this->cObj->data['select_key'];

		switch ( $code ) {
			case 'PAGEBROWSER':
				$content = $this->getPagebrowser();
				break;
			default:
				$content = $this->getCategoryMenu();
				break;
		}
				
		return $this->pi_wrapInBaseClass($content);
	}
	
	
	function getCategoryMenu() {

		$treeViewObj = t3lib_div::makeInstance('tx_categorization_catmenu');
		$treeViewObj->pObj = $this;
		$treeViewObj->table = 'tx_dam_cat';
		$treeViewObj->init('', '');
		$treeViewObj->backPath = TYPO3_mainDir;
		$treeViewObj->thisScript = '';
		$treeViewObj->parentField = 'parent_id';
		$treeViewObj->expandAll = 1;
		$treeViewObj->expandFirst = 1;
		$treeViewObj->fieldArray = array('uid','title','description'); // those fields will be filled to the array $treeViewObj->tree
		$treeViewObj->ext_IconMode = '1'; // no context menu on icons
		$treeViewObj->title = 'Select a category:';
		$treeViewObj->getTree(0);
		#$treeViewObj->tt_news_obj = &$this;

		$return = $treeViewObj->getBrowsableTree();
		#$content = $treeViewObj->printTree();
		
		return $return;
		
	}
	
	function getPagebrowser() {
	
		$pagebrowserObj = t3lib_div::makeInstance('tx_pagebrowse_pi1');
		$pagebrowserObj->cObj = $this->cObj;
		$this->conf['pagebrowser.']['numberOfPages'] = 100;
		$return = $pagebrowserObj->main($content, $this->conf['pagebrowser.']);
		
		return $return;
		
	
	}
	
}



if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/pi1/class.tx_categorization_pi1.php'])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/pi1/class.tx_categorization_pi1.php']);
}

?>