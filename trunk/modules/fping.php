<?php

class CenterBot_Module_Fping implements CenterBot_Module
{
	public function execute()
	{
		if (execute('which fping') != '') {
			echo execute('fping ' . escapeshellarg(CenterBot::getInstance()->_actionText));
		}
	}
}

$bot->registerModule('fping', new CenterBot_Module_Fping());

?>
