<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;
	use \stange\constyle\ansi\Padding;

	$text	=	isset($_SERVER['argv'][1])	?	$_SERVER['argv'][1]			:	'test';
	$pad	=	isset($_SERVER['argv'][2])	?	(int)$_SERVER['argv'][2]	:	1;

	echo (new Text($text))
	->setPadding((new Padding())->setWidth($pad))
	->render();
