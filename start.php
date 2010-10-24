<?php
/**
 * PHP CenterBot for CenterIM
 */

require_once 'class.php';
require_once 'interface.php';
require_once 'functions.php';

// Starte Klasse
$bot = CenterBot::getInstance();

// Lade alle vorhandenen Module
$modules = scandir(dirname(__FILE__).'/modules');
unset($modules[0], $modules[1]);

foreach ($modules as $module) {
	include_once 'modules/'.$module;
}

// Registriere Administratoren
$bot->registerSuperadmin('206092388', 'icq');

// Fuehre aktuelles Kommando aus
$bot->finish();

?>
