<?php

class CenterBot_Module_Calculate implements CenterBot_Module
{
	public function calculate($mathString)
	{
		$mathString = trim($mathString);
		$mathString = ereg_replace('[^0-9\+-\*\/\(\) ]', '', $mathString);
		$compute = create_function('', 'return (' . $mathString . ');');
		return 0 + $compute();		
	}
	
	public function execute()
	{
		$instance = CenterBot::getInstance();
		if ($instance->_actionText != '') {
			echo 'result: ' .  $this->calculate($instance->_actionText);
		} else {
			echo 'syntax: calc <expression>';
		}
	}
}

$bot->registerModule('calc', new CenterBot_Module_Calculate());

?>
