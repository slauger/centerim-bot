<?php

class CenterBot_Module_Ping implements CenterBot_Module
{
	public function execute()
	{
		echo execute('ping -c 3 ' . escapeshellarg(CenterBot::getInstance()->_actionText));
	}
}

$bot->registerModule('ping', new CenterBot_Module_Ping());
$bot->registerModule('icmp', new CenterBot_Module_Ping());

?>
