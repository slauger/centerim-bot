<?php

class CenterBot_Module_Help implements CenterBot_Module
{
	public function execute()
	{
		$instance = CenterBot::getInstance();
		foreach ($instance->_modules as $key => $value) {
			$modules[] = $key;
		}
		$modules  = implode(', ', $modules);
		echo "Registed Actions: {$modules}\n";
		echo "Default Action: " . (class_exists('CenterBot_Module_Default') ? 'Enabled' : 'Disabled');
	}
}

$bot->registerModule('help', new CenterBot_Module_Help());

?>
