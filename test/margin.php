<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;
	$width	=	isset($_SERVER['argv'][1])	?	$_SERVER['argv'][1]	:	1;
	$margin	=	new Margin('test');
	$margin->setWidth($width);
	echo $margin->render();
