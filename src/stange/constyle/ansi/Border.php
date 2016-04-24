<?php

	namespace stange\constyle\ansi{

		use \stange\constyle\Util;
		use \stange\constyle\ansi\Color;
		use \stange\constyle\ansi\Base;

		class Border extends Base{

			private	$width		=	Array('top'=>0,'right'=>0,'bottom'=>0,'left'=>0);
			private	$color		=	Array('top'=>'','right'=>'','bottom'=>'','left'=>'');
			private	$style		=	Array('top'=>'solid','right'=>'solid','bottom'=>'solid','left'=>'solid');
			private	$charMap		=	NULL;

			public function setColor($color,$orientation=NULL){

				if($orientation !== NULL){

					Util::validateOrientation($orientation,'color');

				}

				if($orientation === NULL){

					$this->color	=	Array(
													'top'		=>	$color,
													'right'	=>	$color,
													'bottom'	=>	$color,
													'left'	=>	$color

					);

					return $this;

				}

				$this->color[$orientation]	=	$color;

				return $this;

			}

			public function setWidth($width,$orientation=NULL){

				if($orientation !== NULL){

					Util::validateOrientation($orientation,'width');

				}

				$width	=	(int)$width;

				if(is_null($orientation)){

					$this->width	=	Array(
													'top'		=>	$width,
													'right'	=>	$width,
													'bottom'	=>	$width,
													'left'	=>	$width

					);

					return $this;

				}

				$this->width[$orientation]	=	$width;

				return $this;
				
			}

			public function getWidth($orientation=NULL){

				if($orientation===NULL){

					return $this->width;

				}

				return $this->width[Util::validateOrientation($orientation)];

			}

			public function validateBorderStyle($style){

				$styles	=	Array('hidden','dotted','dashed','solid','double','groove','ridge','inset','outset','initial','inherit');

				if(!in_array($style,$styles)){
					
					throw new \InvalidArgumentException("Invalid border style specified");

				}
		
				return TRUE;

			}

			public function setStyle($style,$orientation=NULL){

				if($style=='none'){

					return $this;

				}

				if($orientation !== NULL){

					Util::validateOrientation($orientation,'style');

				}

				$this->validateBorderStyle($style);

				if($orientation === NULL){

					$this->style	=	Array(
													'top'		=>	$style,
													'right'	=>	$style,
													'bottom'	=>	$style,
													'left'	=>	$style

					);

					return $this;

				}

				$this->style[$orientation]	=	$style;

				return $this;

			}

			public function getStyle($orientation=NULL){

				if($orientation === NULL){

					return $this->style;

				}

				return $this->style[Util::validateOrientation($orientation,'style')];

			}

			private function __generateBorderTopBottom($orientation){

				require "charmap.php";

				$style	=	empty($this->style[$orientation])	?	'solid'	:	$this->style[$orientation];
				$content	=	$this->getContent();
				$len		=	$content instanceof Base	?	$content->getContentLength()	:	strlen($content);

				$border	=	'';

				for($i=0;$i<$len;$i++){

					$border	=	sprintf('%s%s',$border,$charMap['border'][$style]['line'][$orientation]);
					
				}

				$cornerLeft		=	$charMap['border'][$style]['corner'][$orientation]['left'];
				$cornerRight	=	$charMap['border'][$style]['corner'][$orientation]['right'];

				$border			=	"$cornerLeft$border$cornerRight";

				return $border;

			}

			private function __borderLeftRight($pad){

				require	"charmap.php";

				$string		=	$this->getContent();
				$styleLeft	=	$this->style['left'];

				if($styleLeft){

					$borderLeftChar	=	$charMap['border'][$styleLeft]['side']['left'];
					$replace	=	$this->color['left'] ? (new Color($borderLeftChar,$this->color['left']))->render()	: 	$borderLeftChar;
					$string	=	str_pad($string,$pad,' ');
					$string	=	preg_replace('#$#m',$replace,$string);

				}

				$styleRight	=	$this->style['right'];

				if($styleRight){
					
					$borderRightChar	=	$charMap['border'][$styleRight]['side']['right'];
					$replace	=	$this->color['right'] ? (new Color($borderRightChar,$this->color['right']))->render()	: 	$borderRightChar;
					$string	=	preg_replace('#^#m',$replace,$string);

				}

				return "\n$string\n";

			}

			protected function __render(){

				if(!($this->width['top']||$this->width['right']||$this->width['bottom']||$this->width['left'])){

					return $this->string;

				}

				$top		=	$this->__generateBorderTopBottom('top');
				$length	=	strlen($top);
				$bottom	=	$this->__generateBorderTopBottom('bottom');

				$top		=	$this->color['top']		?	(new Color($top,$this->color['top']))->render()			:	$top;
				$bottom	=	$this->color['bottom']	?	(new Color($bottom,$this->color['bottom']))->render()	:	$bottom;

				return sprintf('%s%s%s',$top,$this->__borderLeftRight($length),$bottom);

			}

		}

	}
