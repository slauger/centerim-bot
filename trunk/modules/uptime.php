<?php

class CenterBot_Module_Uptime implements CenterBot_Module
{
	public function execute()
	{
		echo execute('uptime');
	}
}

$bot->registerModule('uptime', new CenterBot_Module_Uptime());

?>
