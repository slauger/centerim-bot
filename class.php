<?php
/**
 * CenterBot PHP Backend
 */

class CenterBot
{
	protected static $_instance = null;

	/**
	 * Kostanten fuer den Auth Level
	 */
	const AUTH_IGNORE     = 0;
	const AUTH_USER       = 1;
	const AUTH_ADMIN      = 2;
	const AUTH_SUPERADMIN = 3;

	/**
	 * Geladene Module als Array
	 */
	public $_modules         = array();
	
	/**
	 * Als Superadmin authentifizierte Benutzer
	 */
	public $_superadmins     = array();
	
	/**
	 * Als Admin authentifizierte Benuter
	 */
	public $_admins          = array(); 
	
	/**
	 * Gebannte (Ignorierte) Benutzer
	 */
	public $_ignore          = array();
	/**
	 * Der komplette Text, der gesendet wurde.
	 * Also etwa "say Hallo Welt"
	 */
	public $_actionRaw        = null;
	
	/**
	 * Die Argumente, ohne das Kommando
	 */
	public $_actionText       = null;
	
	/**
	 * Das aktuelle Kommando (erstes Wort)
	 */
	public $_actionCommand   = null;

	/**
	 * Das aktuelle Event von CenterIM:
	 * msg, sms, url, online, offline, auth
	 * contacts oder notification
	 */
	public $_eventType       = null;
	
	/**
	 * Das Netwerk aus dem das aktuelle
	 * Kommando verschickt wurde.
	 */
	public $_eventNetwork    = null;
	
	/**
	 * Nickname des Kontakts
	 */
	public $_contactNick     = null;
	
	/**
	 * UIN des Kontakts
	 */
	public $_contactUIN      = null;
	
	/**
	 * Komplette Userinfo des Kontakts
	 * Achtung, ungeparst als String!
	 */
	public $_contactInfo     = null;
	
	/**
	 * Singleton, damit die Module auf alle
	 * benoetigten Variablen zugreifen koennen
	 */
	public static function getInstance()
	{
		if (self::$_instance === null) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	public function __construct()
	{
		$this->_actionRaw       = getenv('EVENT_TEXT');
		$args                   = explode(' ', $this->_actionRaw, 2);
		$this->_actionCommand   = $args[0];
		$this->_actionText      = $args[1];
		$this->eventType        = getenv('EVENT_TYPE');
		$this->eventNetwork     = getenv('EVENT_NETWORK');
		$this->contactUIN	= getenv('CONTACT_UIN');
		$this->contactNick	= getenv('CONTACT_NICK');
		$this->contactInfo	= getenv('CONTACT_INFODIR');
	}
	
	public function registerAdmin($uin, $network)
	{
		$this->_admins[] = array(
			'uin'		=> $uin,
			'network'	=> $network
		);
	}

	public function registerSuperadmin($uin, $network)
	{
		$this->_superadmins[] = array(
			'uin'           => $uin,
                        'network'       => $network
		);
	}

	public function registerIgnore($uin, $network)
        {
                $this->_ignore[] = array(
                        'uin'           => $uin,
                        'network'       => $network
                );
        }

	public function checkUser()
	{
		foreach ($this->_superadmins as $user)
		{
			if ($user['uin'] == $this->contactUIN && $user['network'] == $this->eventNetwork) {
				return self::AUTH_SUPERADMIN;
			}
		}
                foreach ($this->_admins as $id => $user)
                {
                        if ($user['uin'] == $this->contactUIN && $user['network'] == $this->eventNetwork) {
                                return self::AUTH_ADMIN;
                        }
                }
                foreach ($this->_ignore as $id => $user)
                {
                        if ($user['uin'] == $this->contactUIN && $user['network'] == $this->eventNetwork) {
                                return self::AUTH_USER;
                        }
                }
		return self::AUTH_IGNORE;
	}
	
	public function registerModule($action, CenterBot_Module $instance)
	{
		$this->_modules[$action][] = $instance;
	}

	public function executeCommand($action)
	{
		if (isset($this->_modules[$action])) {
			foreach ($this->_modules[$action] as $module) {
				$module->execute();
			}
		} else {
			// Wenn kein passendes Modul gefunden wird
			if (class_exists('CenterBot_Module_Default')) {
				$this->_modules['default'] = new CenterBot_Module_Default();
				$this->_modules['default']->execute();
			}
		}
	}
	
	public function finish()
	{
		$this->executeCommand($this->_actionCommand);
	}
}

?>
