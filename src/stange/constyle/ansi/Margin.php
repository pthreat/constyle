<?php

	namespace stange\constyle\ansi{

		use stange\constyle\Util;
		use stange\constyle\ansi\Base;

		class Margin extends Base{

			private	$width	=	Array('top'=>0,'right'=>0,'bottom'=>0,'left'=>0);

			public function setWidth($value,$orientation=NULL){

				$value	=	(int)$value;

				if($orientation === NULL){

					$this->width	=	Array(
													'top'		=>	$value,
													'right'	=>	$value,
													'bottom'	=>	$value,
													'left'	=>	$value

					);

					return $this;

				}

				$this->width[Util::validateDirection($orientation)]	=	$value;

				return $this;

			}

			public function getWidth($orientation=NULL){

				return $orientation === NULL	?	$this->width	:	$this->width[Util::validateOrientation($orientation)];

			}

			public function __render(){

				$width	=	$this->width;

				if(!($width['top']&&$width['right']&&$width['bottom']&&$width['left'])){

					return $this->content;

				}

				return implode('',Array(
												str_repeat("\n",$width['top']),
												str_repeat("\t",$width['left']),
												$this->getContent(),
												str_repeat("\t",$width['right']),
												str_repeat("\n",$width['bottom'])
										)
				);

			}

		}

	}

