<?php

class CenterBot_Module_Date implements CenterBot_Module
{
	public function execute()
	{
		echo date('r');
	}
}

$bot->registerModule('date', new CenterBot_Module_Date());
$bot->registerModule('time', new CenterBot_Module_Date());
$bot->registerModule('datetime', new CenterBot_Module_Date());

?>
