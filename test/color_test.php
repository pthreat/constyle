<?php

	require "class/util/console/ansi/Colorize.class.php";

	ini_set('display_errors','On');
	error_reporting(E_ALL);

	$t	=	new \stange\util\console\ansi\Colorize('Red and bold');

	echo $t->setForeground('red')
	->setBold(TRUE)
	->render()."\n";

	$t	=	new \stange\util\console\ansi\Colorize('Green bold + Underline');

	echo $t->setForeground('green')
	->setBold(TRUE)
	->setUnderline(TRUE)
	->render()."\n";

	$t	=	new \stange\util\console\ansi\Colorize('Green fg + Red bg');

	echo $t->setBold(TRUE)
	->setForeground('green')
	->setBackground('red')
	->render()."\n";
