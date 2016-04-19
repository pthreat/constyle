<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling text in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\constyle\ansi\Base;
		use \stange\constyle\Util;
		use \stange\util\conversion\Color	as	ColorConversion;

		class	Text extends Base{

			private	$fgColor			=	NULL;

			private	$bold				=	FALSE;
			private	$inverted		=	FALSE;
			private	$blink			=	FALSE;
			private	$dim				=	FALSE;
			private	$underline		=	FALSE;

			/* 

			text/Factory

			public function setCSS($css){

				$parse	=	(new CSSParser($css))->parse()->getAllSelectors();

				foreach($parse as $rules){

					$rules	=	$rules->getRules();

					foreach($rules as $rule){

						$value	=	strtolower($rule->getValue());
						$rule		=	strtolower($rule->getRule());

						switch($rule){

							case 'color':

								$this->setForeground($value);

							break;

							case 'padding':
							case 'padding-top':
							case 'padding-bottom':
							case 'padding-right':
							case 'padding-left':

								$this->setPadding($value,$this->__substractOrientation($rule));

							break;

							case 'margin':
							case 'margin-top':
							case 'margin-bottom':
							case 'margin-right':
							case 'margin-left':

								$this->setMargin($value,$this->__substractOrientation($rule));

							break;

							case 'border':
							case 'border-top':
							case 'border-right':
							case 'border-bottom':
							case 'border-left':
							case 'border-width':
							case 'border-color':
								$this->setBorder($value);
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
			*/

			private function setDecoration($value){

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

			public function isInverted(){

				return $this->inverted;

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

			protected function __render(){

				$style	=	Array();

				$style[]	=	$this->bold	?	1	:	0;

				if($this->fgColor){

					$style[]	=	38;
					$style[]	=	5;
					$style[]	=	$this->getColor($this->fgColor);

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
				$style	=	sprintf("\e[%sm%s\e[0m",$style,$this->getContent());

				return $style;

			}

			public function __toString(){

				try{

					return $this->__render();

				}catch(\Exception $e){

					return '';

				}

			}

		}	

	}

