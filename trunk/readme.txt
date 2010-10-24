Module fuer den Bot
==================
Das prinzipielle Muster fuer Module ist recht einfach gestrickt.
Jede Modul Klasse muss das Interface CenterBot_Module 
implementieren. Daraus ergibt sich das zumindest die Methode 
execute() definiert sein muss.

class CenterBot_Module_Calculate implements CenterBot_Module{
	public function execute() {
	}
}

Auf die CenterBot Klasse kann mittels Singleton zugegeriffen
werden.

$instance = CenterBot::getInstance();

So ist es moeglich auf alle in der CenterBot Klasse definierten
Klassenvariablen zuzugreifen. Spaeter gibt es hier noch 
ordentliche Getter und Setter (CenterBot::getRawData() usw.).

Momentan muss einfach direkt auf die public Klassenvariablen
zugegriffen werden.

Regestrierung von Actions
==================
Alle Klassen im Verzeichnis /modules/ werden automatisch
includiert, aber nicht direkt in den Bot geladen.

Hierzu ist es noetig die Methode CenterBot::registerModule()
aufzurufen.

$bot->registerModule('calc', new CenterBot_Module_Calculate());

Mehrfachbelegung von Actions
==================
Alle Actions koennen mehrfach regestriert werden. Die Klassen
werden dann in der Reihenfolge in der Sie definiert werden nach
einander aufgerufen.

$bot->registerModule('calc', new CenterBot_Module_Calculate());
$bot->registerModule('calc', new CenterBot_Module_AdminBCC());

In diesem Beispiel wuerde der User zunaechst seine Rechenaufgabe
geloest bekommen. Danach wird das Modul AdminBCC aufgerufen, diese
Modul koennte den Admin etwa informieren das der Bot von diesem User
gerade benutzt wurde.

Ein kleines Beispiel Modul
==================
class CenterBot_Module_Example implements CenterBot_Module{
	public function execute() {
		echo 'Du hast gesagt: ' . CenterBot::getInstance->_actionText;
	}
}
$bot->registerModule('echo', new CenterBot_Module_Example());

