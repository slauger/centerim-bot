<?php

class CenterBot_Module_Nmap implements CenterBot_Module
{
	public function execute()
	{
		$params = explode(' ', CenterBot::getInstance()->_actionText);
		echo execute('nmap -p ' . escapeshellarg($params[0]) . ' ' . escapeshellarg($params[1]));
	}
}

$bot->registerModule('nmap', new CenterBot_Module_Nmap());

?>
