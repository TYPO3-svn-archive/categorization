<?php
if (!defined ('TYPO3_MODE')) {
 	die ('Access denied.');
}

t3lib_extMgm::addUserTSConfig('
	options.saveDocNew.tx_dam_cat=1
');


t3lib_extMgm::addPItoST43($_EXTKEY, 'pi1/class.tx_categorization_pi1.php', '_pi1', 'list_type', 1);

$GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['categorization/lib/class.tx_categorization_lib.php']['allowedTables'][] = 'tt_news';

$TYPO3_CONF_VARS['FE']['addRootLineFields'] .= ',tx_categorization_categories,tx_categorization_select_deselect_categories,tx_categorization_recursive';

$TYPO3_CONF_VARS['SC_OPTIONS']['t3lib/class.t3lib_page.php']['addEnableColumns'][] = 'EXT:categorization/lib/class.tx_categorization_lib.php:tx_categorization_lib->addEnableColumns';

?>