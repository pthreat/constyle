<?php

	require "class/util/console/ansi/Colorize.class.php";

	$t	=	new \stange\util\console\ansi\Colorize('test','cyan','red');
	echo $t->render('light')."\n";
