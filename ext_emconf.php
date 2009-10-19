<?php

########################################################################
# Extension Manager/Repository config file for ext: "categorization"
#
# Auto generated 16-10-2009 13:54
#
# Manual updates:
# Only the data in the array - anything else is removed by next write.
# "version" and "dependencies" must not be touched!
########################################################################

$EM_CONF[$_EXTKEY] = array(
	'title' => 'Categorization for all record',
	'description' => 'Categorize all your records and display these based on a selected category.',
	'category' => '',
	'author' => 'Rik Willems',
	'author_email' => 'http://www.actiview.nl',
	'shy' => '',
	'dependencies' => 'dam',
	'conflicts' => '',
	'priority' => '',
	'module' => '',
	'state' => 'alpha',
	'internal' => '',
	'uploadfolder' => 1,
	'createDirs' => '',
	'modify_tables' => '',
	'clearCacheOnLoad' => 0,
	'lockType' => '',
	'author_company' => '',
	'version' => '0.0.0',
	'constraints' => array(
		'depends' => array(
			'dam' => '1.1.1-',
		),
		'conflicts' => array(
		),
		'suggests' => array(
		),
	),
	'_md5_values_when_last_written' => 'a:13:{s:9:"ChangeLog";s:4:"9929";s:10:"README.txt";s:4:"ee2d";s:12:"ext_icon.gif";s:4:"1bdc";s:17:"ext_localconf.php";s:4:"2022";s:14:"ext_tables.php";s:4:"285b";s:14:"ext_tables.sql";s:4:"5560";s:16:"locallang_db.xml";s:4:"5303";s:17:"locallang_tca.xml";s:4:"2ec1";s:7:"tca.php";s:4:"eb44";s:35:"pi1/class.tx_categorization_pi1.php";s:4:"5e67";s:19:"doc/wizard_form.dat";s:4:"3c16";s:20:"doc/wizard_form.html";s:4:"5c2d";s:35:"lib/class.tx_categorization_lib.php";s:4:"b834";}',
	'suggests' => array(
	),
);

?>