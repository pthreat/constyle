<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;
	use \stange\constyle\ansi\Padding;

	$pad	=	isset($_SERVER['argv'][1])	?	(int)$_SERVER['argv'][1]	:	1;

	$text	=	(new Text('Padding test'))
	->setPadding((new Padding())->setWidth($pad));

	echo $text->render();
