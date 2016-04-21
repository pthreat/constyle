<?php

	namespace stange\constyle\ansi{

		use \stange\constyle\Util;
		use \stange\constyle\ansi\Colorize;
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
				$len		=	strlen($this->getContent());

				$border	=	'';

				for($i=0;$i<$len;$i++){

					$border	=	sprintf('%s%s',$border,$charMap['border'][$style]['line'][$orientation]);
					
				}

				$cornerLeft		=	$charMap['border'][$style]['corner'][$orientation]['left'];
				$cornerRight	=	$charMap['border'][$style]['corner'][$orientation]['right'];

				$border			=	"$cornerLeft$border$cornerRight";

				return (new Colorize($border,$this->color[$orientation]))->render();

			}

			private function __borderLeftRight($pad){

				require	"charmap.php";

				$string				=	$this->getContent();
				$styleRight			=	$this->style['right'];

				$borderRightChar	=	$charMap['border'][$styleRight]['side']['right'];
				$borderLeftChar	=	$charMap['border'][$styleRight]['side']['right'];

				if($styleRight){
					
					$replace	=	$this->color['right'] ? (new Colorize($borderRightChar,$this->color['right']))->render()	: 	$borderRightChar;
					$string	=	preg_replace('#^#',$replace,$string);

				}

				$styleLeft			=	$this->style['left'];

				if($styleLeft){

					$replace	=	$this->color['left'] ? (new Colorize($borderRightChar,$this->color['left']))->render()	: 	$borderLeftChar;
					$string	=	preg_replace('#$#',$replace,$string);

				}

				return "\n$string\n";

			}

			protected function __render(){

				if(!($this->width['top']||$this->width['right']||$this->width['bottom']||$this->width['left'])){

					return $this->string;

				}

				$top		=	$this->__generateBorderTopBottom('top');
				$bottom	=	$this->__generateBorderTopBottom('bottom');

				return sprintf('%s%s%s',$top,$this->__borderLeftRight(strlen($top)),$bottom);

			}

		}

	}
