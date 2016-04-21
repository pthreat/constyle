<?php

	require "vendor/autoload.php";

	use \stange\constyle\ansi\Block;
	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;
	use \stange\constyle\ansi\Padding;

	$block	=	(new Block('This is a test'))
	->setForeground('red')
	->setBackground('white')
	->setMargin((new Margin())->setWidth(1))
	->setBorder((new Border())->setWidth(1)->setColor('red'));

	echo $block->render()."\n";
