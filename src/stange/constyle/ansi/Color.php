<?php

	namespace stange\constyle\ansi{

		use \stange\util\conversion\Color	as	ColorConversion;

		class Color{

			private	$foreground	=	NULL;
			private	$background	=	NULL;
			private	$string		=	NULL;

			public function __construct($string,$fg=NULL,$bg=NULL){

				if($fg!==NULL){

					$this->setForeground($fg);

				}

				if($bg!==NULL){

					$this->setBackground($bg);

				}

				$this->setContent($string);

			}

			public function setContent($string){

				$this->content	=	$string;
				return $this;

			}

			public function getContent(){

				return $this->content;

			}

			public function setForeground($color){

				if($color==='none'){

					$this->foreground	=	NULL;
					return $this;

				}

				$this->foreground	=	$this->getColor($color);

				return $this;

			}

			public function getForeground(){

				return $this->foreground;

			}

			public function setBackground($color){

				if($color==='none'){

					$this->background	=	NULL;
					return $this;

				}

				$this->background	=	$this->getColor($color);

				return $this;

			}

			public function getBackground(){

				return $this->background;

			}

			public function setString($string){

				$this->string	=	sprintf('%s',$string);
				return $this;

			}

			public function getString(){

				return $this->string;

			}

			public function getArray(){

				$style	=	Array();

				if($this->foreground){

					$style[]	=	38;
					$style[]	=	5;
					$style[]	=	$this->foreground;

				}

				return $style;

			}

			public function getColor($color){

				$cConvert	=	new ColorConversion($color);
				return $cConvert->toANSI();

			}

			public function render(){

				return sprintf("\e[%sm%s\e[0m",implode(';',$this->getArray()),$this->getContent());

			}

			public function __toString(){

				return $this->render();

			}

		}

	}
