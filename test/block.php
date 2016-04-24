<?php

	require "vendor/autoload.php";

	use \stange\util\console\Arguments;
	use \stange\constyle\ansi\Block;
	use \stange\constyle\ansi\Margin;
	use \stange\constyle\ansi\Border;
	use \stange\constyle\ansi\Text;
	use \stange\constyle\ansi\Padding;

	$arguments	=	new Arguments();

	$block		=	new Block(new Text($arguments->find('text','t') ? $arguments->find('t','text')->getValue()	:	'Test text'));

	if($arguments->find('foreground','f')){

		$block->setForeground($arguments->find('foreground','f')->getValue());

	}

	if($arguments->find('background','b')){

		$block->setBackground($arguments->find('background','b')->getValue());

	}

	if($arguments->find('margin','m')){

		$block->setMargin(
			(new Margin())->setWidth(
				$arguments->find('margin','m')->getValue()
			)
		);

	}

	if($arguments->find('border','r')){

		$border	=	(new Border())->setWidth($arguments->find('border','r')->getValue());

		if($arguments->find('bct','border-color-top')){

			$border->setColor($arguments->find('bct','border-color-top')->getValue(),'top');

		}

		if($arguments->find('bcb','border-color-bottom')){

			$border->setColor($arguments->find('bcb','border-color-bottom')->getValue(),'bottom');

		}

		if($arguments->find('bcr','border-color-right')){

			$border->setColor($arguments->find('bcr','border-color-right')->getValue(),'right');

		}

		if($arguments->find('bcl','border-color-left')){

			$border->setColor($arguments->find('bcl','border-color-left')->getValue(),'left');

		}

		$block->setBorder($border);

	}

	if($arguments->find('padding','p')){

		$padding	=	(new Padding())->setWidth($arguments->find('padding','p')->getValue());
		$block->setPadding($padding);

	}

	echo $block->render()."\n";
