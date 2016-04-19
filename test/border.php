<?php

	require "vendor/autoload.php";

	use stange\constyle\ansi\Border;

	$border	=	new Border('test');
	$border->setWidth(1);
	$border->setColor('red');
	echo $border->render();
