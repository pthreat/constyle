<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling text in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use \stange\constyle\ansi\Base;
		use \stange\constyle\ansi\Color;
		use \stange\constyle\Util;

		class	Text extends Base{

			private	$bold				=	FALSE;
			private	$inverted		=	FALSE;
			private	$blink			=	FALSE;
			private	$dim				=	FALSE;
			private	$underline		=	FALSE;

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

			protected function __render(){

				$style	=	Array();

				$style[]	=	$this->bold	?	1	:	0;

				$color	=	$this->getColor()->getArray();

				if($color){

					$style	=	array_merge($style,$color);

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

				if(!$style){

					return $this->getContent();

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

