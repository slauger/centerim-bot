<?php

class CenterBot_Module_Default implements CenterBot_Module
{
	public function execute()
	{
		$instance = CenterBot::getInstance();
		$text     = $instance->_actionRaw;
		if (execute('which elizatalk') != '') {
			echo execute('echo ' . escapeshellarg($text) . ' | elizatalk'); 
		}
	}
}

?>
