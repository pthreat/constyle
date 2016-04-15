<?php

	ini_set('display_errors','On');
	error_reporting(E_ALL);

	define('_DS',DIRECTORY_SEPARATOR);

	$autoLoad	=	sprintf('%s%s..%svendor%sautoload.php',realpath(__DIR__),_DS,_DS,_DS,_DS);

	if(!(file_exists($autoLoad)&&is_readable($autoLoad))){

		echo "Please run: composer dump-autoload before running this script\n";
		exit(1);

	}

	require $autoLoad;

	use \stange\constyle\ansi\Style	as	ConsStyle;

	$css	=	'{color:#afcd31;text-decoration:underline;background-color:navy;font-weight:bold;margin-left:2px;}';
	$t	=	new ConsStyle("CSS Example $css",$css);
	echo $t->render()."\n";

	$t	=	new ConsStyle('Red NO bold');

	echo $t->setForeground('red')
	->render()."\n";

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

	echo $t->setBold(TRUE)
	->setUnderline(TRUE)
	->setForeground('black')
	->setBackground('white')
	->render()."\n";


	$t	=	new ConsStyle('#cccccc fg + #ac32fb bg *BLINKING*');

	echo $t->setBlink(TRUE)
	->setForeground('#cccccc')
	->setBackground('#ac32fb')
	->render()."\n";
