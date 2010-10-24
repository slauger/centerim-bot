<?php

function execute($command)
{
	return trim(shell_exec($command));

}

?>
