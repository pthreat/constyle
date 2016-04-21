<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;
	use \stange\constyle\ansi\Padding;

	$text	=	(new Text('This is a test'))
	->setForeground('red')
	->setPadding((new Padding())->setWidth(1));

	echo $text->render();
