<?php

class CenterBot_Module_Version implements CenterBot_Module
{
	public function execute()
	{
		echo "Powered by CenterBot v0.1 (Based on CenterIM) by linux-dev.de Networks";
	}
}

$bot->registerModule('version', new CenterBot_Module_Version());

?>
