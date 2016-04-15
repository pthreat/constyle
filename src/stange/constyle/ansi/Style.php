<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\util\conversion\Color	as	ColorConversion;
		use \Sabberworm\CSS\Parser				as	CSSParser;

		class	Style{

			private	$string			=	NULL;
			private	$fgColor			=	NULL;
			private	$bgColor			=	NULL;

			private	$bold				=	FALSE;
			private	$inverted		=	FALSE;
			private	$blink			=	FALSE;
			private	$dim				=	FALSE;
			private	$underline		=	FALSE;
			private	$hidden			=	FALSE;
			private	$css				=	'';
			private	$margin			=	Array('top'=>0,'right'=>0,'bottom'=>0,'left'=>0);
			private	$padding			=	Array('top'=>0,'right'=>0,'bottom'=>0,'left'=>0);

			private	$marginChar		=	"\t";
			private	$paddingChar	=	' ';

			public function __construct($string,$css=NULL){

				$this->setString($string);

				if(!is_null($css)){

					$this->setCSS($css);

				}

			}

			public function setPadding($amount,$direction=NULL){

				if($direction !== NULL){

					$this->__validateOrientation($direction,'padding');

				}

				$amount	=	(int)$amount;

				if(is_null($direction)){

					$this->padding	=	Array(
													'top'		=>	$amount,
													'right'	=>	$amount,
													'bottom'	=>	$amount,
													'left'	=>	$amount

					);

					return $this;

				}

				$this->margin[$direction]	=	$value;

				return $this;

			}

			public function getPadding($orientation=NULL){

				if($direction === NULL){

					return $this->padding;

				}

				$this->__validateOrientation($orientation,'padding');

				return $this->padding[$orientation];

			}

			public function setMargin($value,$direction=NULL){

				if($direction !== NULL){

					$this->__validateOrientation($direction,'margin');

				}

				$value	=	(int)$value;

				if(is_null($direction)){

					$this->margin	=	Array(
													'top'		=>	$value,
													'right'	=>	$value,
													'bottom'	=>	$value,
													'left'	=>	$value

					);

					return $this;

				}

				$this->margin[$direction]	=	$value;

				return $this;

			}

			public function getMargin($direction=NULL){

				if($direction === NULL){

					return $this->margin;

				}

				$this->__validateOrientation($direction,'margin');

				return $this->margin[$direction];

			}

			private function __validateOrientation($orientation,$what){

				$orientation	=	strtolower($orientation);

				if(!in_array($orientation,Array('top','right','bottom','left'))){

					$msg	=	"Incorrect $what specified ->$orientation<-. $what must be one of: top, right, bottom, left";
					throw new \InvalidArgumentException($msg);

				}

				return TRUE;

			}

			private function __substractOrientation($orientation){

				$test	=	strpos($orientation,'-');

				if($test===FALSE){

					return NULL;

				}

				return substr($orientation,$test+1);

			}

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
				$style	=	$this->__parseMargin($style);

				return $style;

			}

			private function __parseMargin($style){

				$margin	=	$this->margin;

				if(!($margin['top']&&$margin['right']&&$margin['bottom']&&$margin['left'])){

					return $style;

				}

				foreach($margin as $orientation=>$value){

					switch($orientation){

						case 'top':
							$style	=	sprintf('%s%s',str_repeat($this->marginChar,$value),$style);
						break;

						case 'right':
							$style	=	sprintf('%s%s',str_repeat("\t",$value),$style);
						break;

						case 'bottom':
							$style	=	sprintf('%s%s',str_repeat("\n",$value),$style);
						break;

						case 'left':
							$style	=	sprintf('%s%s',str_repeat("\t",$value),$style);
						break;

					}

				}

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

