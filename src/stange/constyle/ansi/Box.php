<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use stange\constyle\ansi\Base;
		use stange\constyle\ansi\Border;
		use stange\constyle\ansi\Padding;
		use stange\constyle\ansi\Margin;

		class	Box extends Base{

			private	$fgColor		=	NULL;
			private	$bgColor		=	NULL;

			private	$width		=	NULL;
			private	$height		=	NULL;
			private	$float		=	NULL;

			public function setBackgroundColor($color){

				$this->bgColor	=	$this->getColor($color);
				return $this;

			}

			public function getBackgroundColor(){

				return $this->bgColor;

			}

			public function setWidth($width){

				$this->width	=	(int)$width;
				return $this;

			}

			public function getWidth(){

				return $this->width;

			}

			public function setHeight($height){

				$this->height	=	(int)$height;
				return $this;

			}

			public function getHeight(){

				return $this->height;

			}

			protected function __render(){

				$render	=	$this->getContent();

				if($this->getMargin()){

					$render	=	$this->getMargin()->setContent($render)->render();

				}

				if($this->getPadding()){

					$render	=	$this->getPadding()->setContent($render)->render();

				}

				if($this->getBorder()){

					$render	=	$this->getBorder()->setContent($render)->render();

				}

				return $render;

			}

		}	

	}

