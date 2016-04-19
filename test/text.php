<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;

	$text	=	(new Text('This is a test'))
	->setForeground('red')
	->setDisplay('block')
	->setMargin((new Margin())->setWidth(1))
	->setBorder((new Border())->setWidth(1));


	echo $text->render();
