<?php

	require "vendor/autoload.php";

	ini_set('display_errors','On');
	error_reporting(E_ALL);

	use \stange\constyle\ansi\Colorize	as	ConsStyle;

	$t	=	new ConsStyle('Red and bold');

	echo $t->setForeground('red')
	->setBold(TRUE)
	->render()."\n";

	$t	=	new ConsStyle('Green bold + Underline');

	echo $t->setForeground('green')
	->setBold(TRUE)
	->setUnderline(TRUE)
	->render()."\n";

	$t	=	new ConsStyle('Green fg + Red bg');

	echo $t->setBold(TRUE)
	->setForeground('green')
	->setBackground('red')
	->render()."\n";

	$t	=	new ConsStyle('Black fg + White bg');

	echo $t->setBlink(TRUE)
	->setBold(TRUE)
	->setUnderline(TRUE)
	->setForeground('black')
	->setBackground('red')
	->render()."\n";
