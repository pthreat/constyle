<?php

	/**
	 * A class for colorizing strings in an ANSI capable console
	 */

	namespace stange\util\console\ansi{

		class Colorize{

			private	$string			=	NULL;
			private	$foreground		=	NULL;
			private	$background		=	NULL;

			/**
			 * @var $colors Array Different colors for console output
			 */

			private $colors = Array(
											'black'			=>	30,
											'red'				=>	31,
											'green'			=>	32,
											'brown'			=>	33,
											'yellow'			=>	33,
											'blue'			=>	34,
											'purple'			=>	35,
											'cyan'			=>	36,
											'white'			=>	37,
											'gray'			=>	30,
											'magenta'		=>	45
			);

			private	$bold			=	FALSE;
			private	$inverted	=	FALSE;
			private	$blink		=	FALSE;
			private	$dim			=	FALSE;
			private	$underline	=	FALSE;
			private	$hidden		=	FALSE;

			public function __construct($string){

				$this->setString($string);

			}

			public function setBold($bold){

				$this->bold	=	(boolean)$bold;
				return $this;

			}

			public function setString($string){

				$this->string	=	sprintf('%s',$string);
				return $this;

			}

			public function getString(){

				return $this->string;

			}

			private function checkColor($color){

				if(array_key_exists($color,$this->colors)){

					return;

				}

				throw new \InvalidArgumentException("Invalid color \"$color\"");

			}

			public function getColor($color){

				$this->checkColor($color);
				return $this->colors[$color];

			}

			public function setForeground($color){

				$this->checkColor($color);
				$this->foreground	=	$color;
				return $this;

			}

			public function getForeground(){

				return $this->foreground;

			}

			public function setBackground($color){

				$this->checkColor($color);
				$this->background	=	$color;
				return $this;

			}

			public function getBackground(){

				return $this->background;

			}

			public function clear(){

				return print("\033[2J\033[;H");

			}

			public function render($fgVariant=FALSE,$bgVariant=FALSE){

				$fgVariant	=	(int)(boolean)$fgVariant;
				$bgVariant	=	(int)(boolean)$bgVariant;

				$fg			=	$this->foreground	?	"\033[$fgVariant;{$this->getColor($this->foreground)}m"	:	'';
				$bg			=	$this->background	?	"\033[{$this->getColor($this->background)}m"					:	'';

				return  $fg || $bg ? "$fg$bg{$this->string}\e[0m"	:	$this->string;

			}

		}	

	}

