<?php
/***************************************************************
*  Copyright notice
*
*  (c) 2009 Rik Willems <http://www.actiview.nl>
*  (c) 2005-2007 Rupert Germann <rupi@gmx.li>
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
*  A copy is found in the textfile GPL.txt and important notices to the license
*  from the author is found in LICENSE.txt distributed with these scripts.
*
*
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/

require_once(PATH_t3lib.'class.t3lib_treeview.php');

/**
 * Library to extend the default TYPO3 treeview. Based on: class.tx_ttnews_catmenu.php
 *
 * @author	Rik Willems <http://www.actiview.nl>
 * @author Rupert Germann <rupi@gmx.li>
 * @package	TYPO3
 * @subpackage	tx_categorization
 */
class tx_categorization_catmenu extends t3lib_treeview {


	/**
	 * wraps the record titles in the tree with links or not depending on if they are in the TCEforms_nonSelectableItemsArray.
	 *
	 * @param	string		$title: the title
	 * @param	array		$v: an array with uid and title of the current item.
	 * @return	string		the wrapped title
	 */
	function wrapTitle($title,$v)	{
		$conf = &$this->pObj->conf;
		$config = &$this->pObj->config;
		$catSelLinkParams = $GLOBALS['TSFE']->id;

		if ( $v['uid'] > 0 ) {
			$piVars = &$this->pObj->piVars;
			$pTmp = $GLOBALS['TSFE']->ATagParams;

			$link = $this->pObj->pi_linkTP_keepPIvars($title, array('cat' => $v['uid']), 1, 0, $catSelLinkParams);

			$GLOBALS['TSFE']->ATagParams = $pTmp;
			return $link ;

		} else { // catmenu Header
			return $this->pObj->pi_linkTP_keepPIvars($title, array(), 1, 1, $catSelLinkParams);
		}
	}

}

if (defined('TYPO3_MODE') && $TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/lib/class.tx_categorization_catmenu.php'])    {
    include_once($TYPO3_CONF_VARS[TYPO3_MODE]['XCLASS']['ext/categorization/lib/class.tx_categorization_catmenu.php']);
}

?>