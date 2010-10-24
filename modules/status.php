<?php

class CenterBot_Module_Status implements CenterBot_Module
{
	public function execute()
	{
		$instance  = CenterBot::getInstance();
		$userlevel = $instance->checkUser();
		switch ($userlevel)
		{
			case CenterBot::AUTH_SUPERADMIN:
				echo "Du bist als Superadmin authentifiziert";
			break;
			case CenterBot::AUTH_ADMIN:
				echo "Du bist als Admin authentifiziert";
			break;
			case CenterBot::AUTH_USER:
				echo "Du bist als Standardbenutzer authentifiziert";
			break;
			case CenterBot::AUTH_IGNORE:
				echo "Dein Account wurde geblockt";
			break;
		} 
	}
}

$bot->registerModule('status', new CenterBot_Module_Status());

?>
