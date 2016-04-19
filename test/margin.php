<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Margin;

	$margin	=	new Margin('test');
	$margin->setMargin(1);
	echo $margin->render();
