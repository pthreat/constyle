<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\util\conversion\Color	as	ColorConversion;
		use \Sabberworm\CSS\Parser				as	CSSParser;

		class	Style{

			private	$string		=	NULL;
			private	$fgColor		=	NULL;
			private	$bgColor		=	NULL;

			private	$bold			=	FALSE;
			private	$inverted	=	FALSE;
			private	$blink		=	FALSE;
			private	$dim			=	FALSE;
			private	$underline	=	FALSE;
			private	$hidden		=	FALSE;
			private	$css			=	'';

			public function __construct($string,$css=NULL){

				$this->setString($string);

				if(!is_null($css)){

					$this->setCSS($css);

				}

			}

			public function setCSS($css){

				$parse	=	(new CSSParser($css))->parse()->getAllSelectors();

				foreach($parse as $rules){

					$rules	=	$rules->getRules();

					foreach($rules as $rule){

						$value	=	strtolower($rule->getValue());

						switch(strtolower($rule->getRule())){

							case 'color':

								$this->setForeground($value);

							break;

							case 'background-color':

								$this->setBackground($value);

							break;

							case 'font-weight':

								if($value=='bold'){

									$this->setBold(TRUE);

								}

							break;

							case 'text-decoration':

								$this->setTextDecoration($value);

							break;

							case 'display':

								if($value=='none'){

									$this->setString('');

								}

							break;

						}

					}

				}

			}

			private function setTextDecoration($value){

				switch($value){

					case 'blink':

						$this->setBlink(TRUE);

					break;

					case 'underline':

						$this->setUnderline(TRUE);

					break;

				}

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

					$style[]	=	38;
					$style[]	=	5;
					$style[]	=	$this->getColor($this->fgColor);

				}

				if($this->bgColor){

					$style[]	=	48;
					$style[]	=	5;
					$style[]	=	$this->getColor($this->bgColor);

				}

				if($this->underline){

					$style[]	=	4;

				}

				if($this->inverted){

					$style[]	=	7;

				}

				if($this->blink){

					$style[]	=	5;

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

