<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Color;

	$text		=	isset($_SERVER['argv'][1])	?	$_SERVER['argv'][1]	:	'test string';
	$fg		=	isset($_SERVER['argv'][2])	?	$_SERVER['argv'][2]	:	'red';
	$bg		=	isset($_SERVER['argv'][3])	?	$_SERVER['argv'][2]	:	'white';

	$color	=	new Color($text,$fg,$bg);
	echo $color."\n";
