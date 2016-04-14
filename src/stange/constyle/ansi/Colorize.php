<?php

	/**
	 * A class for colorizing strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\util\conversion\Color	as	ColorConversion;

		class Colorize{

			private	$string		=	NULL;
			private	$fgColor		=	NULL;
			private	$bgColor		=	NULL;

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

			public function isBold(){

				return $this->bold;

			}

			public function setInverted($inverted){

				$this->inverted	=	(boolean)$inverted;
				return $this;

			}

			public function setBlink($blink){

				$this->blink	=	(boolean)$blink;
				return $this;

			}

			public function isBlinking(){

				return $this->blink;

			}

			public function setUnderline($underline){

				$this->underline	=	(boolean)$underline;
				return $this;

			}

			public function isUnderlined(){

				return $this->underline;

			}

			public function setHidden($hidden){

				$this->hidden	=	(boolean)$hidden;
				return $this;

			}

			public function isHidden(){

				return $this->hidden;

			}

			public function isInverted(){

				return $this->inverted;

			}

			public function setString($string){

				$this->string	=	sprintf('%s',$string);
				return $this;

			}

			public function getString(){

				return $this->string;

			}

			public function getColor($color){

				$cConvert	=	new ColorConversion($color);
				return $cConvert->toANSI();

			}

			public function setForeground($color){

				$this->fgColor	=	$this->getColor($color);
				return $this;

			}

			public function getForeground(){

				return $this->fgColor;

			}

			public function setBackground($color){

				$this->bgColor	=	$this->getColor($color);
				return $this;

			}

			public function getBackground(){

				return $this->bgColor;

			}

			public function clear(){

				return print("\e[2J\e[;H");

			}

			public function render(){

				$style	=	Array();

				$style[]	=	$this->bold	?	1	:	0;

				if($this->fgColor){

					$style[]	=	$this->getColor($this->fgColor);

				}

				if($this->blink){

					$style[]	=	5;

				}

				if($this->inverted){

					$style[]	=	7;

				}

				if($this->bgColor){

					$style[]	=	$this->getColor($this->bgColor);

				}

				if($this->underline){

					$style[]	=	4;

				}

				$style	=	implode(';',$style);

				$style	=	sprintf("\e[%sm%s\e[0m",$style,$this->string);

				return $style;

			}

		}	

	}

