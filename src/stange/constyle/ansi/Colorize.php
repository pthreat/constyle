<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for adding color to strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\constyle\Util;
		use \stange\util\conversion\Color	as	ColorConversion;

		class	Colorize{

			private	$string	=	NULL;
			private	$fgColor	=	NULL;
			private	$bgColor	=	NULL;

			public function __construct($string,$fg=NULL,$bg=NULL){

				$this->setString($string);

				if($fg!==NULL){

					$this->setForeground($fg);

				}

				if($bg!==NULL){

					$this->setBackground($bg);

				}

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

			public function render(){

				$style	=	Array();

				if($this->fgColor){

					$style[]	=	38;
					$style[]	=	5;
					$style[]	=	$this->getColor($this->fgColor);

				}

				if($this->bgColor){

					$style[]	=	48;
					$style[]	=	5;
					$style[]	=	$this->getColor($this->bgColor);

				}

				$style	=	implode(';',$style);
				$style	=	sprintf("\e[%sm%s\e[0m",$style,$this->string);

				return $style;

			}

			public function __toString(){

				try{

					return $this->render();

				}catch(\Exception $e){

					return '';

				}

			}

		}	

	}

