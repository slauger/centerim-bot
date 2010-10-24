<?php

class CenterBot_Module_Traceroute implements CenterBot_Module
{
	public function execute()
	{
		if (execute('which traceroute') != '') {
			echo execute('traceroute ' . escapeshellarg(CenterBot::getInstance()->_actionText));
		} else {
			echo 'Error: system comand (traceroute) not found';
		}
	}
}

$bot->registerModule('trace', new CenterBot_Module_Traceroute());
$bot->registerModule('traceroute', new CenterBot_Module_Traceroute());
$bot->registerModule('tracert', new CenterBot_Module_Traceroute());

?>
