<?php
if (!defined ('TYPO3_MODE')) {
	die ('Access denied.');
}


$tempColumns = array (
	'tx_categorization_categories' => array (		
		'exclude' => 1,		
		'label' => 'LLL:EXT:categorization/locallang_db.xml:tx_categorization_categories',		
		'config' => array (
			#'type' => 'select',
			'type' => 'passthrough',
			'form_type' => 'user',
			'userFunc' => 'EXT:dam/lib/class.tx_dam_tcefunc.php:&tx_dam_tceFunc->getSingleField_selectTree',
			'treeViewBrowseable' => true,
			'treeViewClass' => 'EXT:dam/components/class.tx_dam_selectionCategory.php:&tx_dam_selectionCategory', // don't work here: $GLOBALS['TYPO3_CONF_VARS']['EXTCONF']['dam']['selectionClasses']['txdamCat']
			
			'foreign_table' => 'tx_dam_cat',
			'MM' => 'tx_categorization_mm_cat',
				// The MM_opposite_field was mentioned in the article below.
				// It ssems that it doesn't matter what you put in, but it is required to make the backend form work.
				// http://buzz.typo3.org/teams/core/article/bidirection-mm-relations/
			'MM_opposite_field' => 'usage_mm', 
			'MM_match_fields' => array(
				'tablenames' => 'tt_news',
			),
			
			'size' => 8,
			'autoSizeMax' => 20,
			'minitems' => 0,
			'maxitems' => 25,
			'default' => '',
		)
	),
);

$tabEntry = '--div--;LLL:EXT:categorization/locallang_db.xml:tx_categorization,';

t3lib_div::loadTCA('tt_news');
t3lib_extMgm::addTCAcolumns('tt_news',$tempColumns,1);
t3lib_extMgm::addToAllTCAtypes('tt_news', $tabEntry . 'tx_categorization_categories,--div--;LLL:EXT:cms/locallang_tca.xml:pages.tabs.access,');

	// Remove tt_news normal category system.
$TCA['tt_news']['columns']['category'] = array();



$tempColumns2 = array (
	'tx_categorization_select_deselect_categories' => array (		
		'exclude' => 1,		
		'label' => 'LLL:EXT:categorization/locallang_tca.xml:select_deselect_categories',		
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('LLL:EXT:categorization/locallang_tca.xml:category_selection_showAll', '0'),
				array('LLL:EXT:categorization/locallang_tca.xml:category_selection_showSelected', '1'),
				array('LLL:EXT:categorization/locallang_tca.xml:category_selection_showSelectedAND', '2'),
				array('LLL:EXT:categorization/locallang_tca.xml:category_selection_DontShowSelected', '3'),
				array('LLL:EXT:categorization/locallang_tca.xml:category_selection_DontShowSelectedOR', '4'),
			),
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'default' => '',
		)
	),
	'tx_categorization_recursive' => array (		
		'exclude' => 1,		
		'label' => 'LLL:EXT:lang/locallang_general.php:LGL.recursive',		
		'config' => array (
			'type' => 'select',
			'items' => array (
				array('', '0'),
				array('LLL:EXT:cms/locallang_ttc.php:recursive.I.1', '1'),
				array('LLL:EXT:cms/locallang_ttc.php:recursive.I.2', '2'),
				array('LLL:EXT:cms/locallang_ttc.php:recursive.I.3', '3'),
				array('LLL:EXT:cms/locallang_ttc.php:recursive.I.4', '4'),
				array('LLL:EXT:cms/locallang_ttc.php:recursive.I.5', '250'),
			),
			'size' => 1,
			'minitems' => 0,
			'maxitems' => 1,
			'default' => '',
		)
	),
);

$tempColumns['tx_categorization_categories']['config']['MM_match_fields']['tablenames'] = 'pages';
t3lib_div::loadTCA('pages');
t3lib_extMgm::addTCAcolumns('pages',$tempColumns,1);
t3lib_extMgm::addTCAcolumns('pages',$tempColumns2,1);
t3lib_extMgm::addToAllTCAtypes('pages', $tabEntry . 'tx_categorization_categories,tx_categorization_select_deselect_categories,tx_categorization_recursive,');




t3lib_div::loadTCA('tt_content');
#$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,select_key,pages,recursive';
$TCA['tt_content']['types']['list']['subtypes_excludelist'][$_EXTKEY.'_pi1']='layout,pages,recursive';


t3lib_extMgm::addPlugin(array('LLL:EXT:categorization/locallang_db.xml:tt_content.list_type_pi1',$_EXTKEY . '_pi1'),'list_type');


?>