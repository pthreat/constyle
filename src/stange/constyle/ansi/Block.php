<?php

	/**
	 * @author Federico Stange <jpfstange@gmail.com>
	 * A class for styling strings in an ANSI capable console
	 */

	namespace stange\constyle\ansi{

		use stange\constyle\ansi\Base;
		use stange\constyle\ansi\Text;
		use stange\constyle\ansi\Border;
		use stange\constyle\ansi\Margin;

		class	Block extends Base{

			private	$width		=	NULL;
			private	$height		=	NULL;

			private	$float		=	NULL;

			private	$margin		=	NULL;
			private	$border		=	NULL;

			public function setBorder(Border $border){

				$this->border	=	$border;
				return $this;

			}

			public function getBorder(){

				return $this->border;

			}

			public function setMargin(Margin $margin){

				$this->margin	=	$margin;
				return $this;

			}

			public function getMargin(){

				return $this->margin;

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

				if($this->getForeground() && $this->getContent() instanceof Text){

					$render	=	$this->getContent()->setForeground($this->getForeground());

				}

				if($this->getBorder()){

					$render	=	$this->getBorder()->setContent($render)->render();

				}

				if($this->getMargin()){

					$render	=	$this->getMargin()->setContent($render)->render();

				}

				return $render;

			}

		}	

	}

