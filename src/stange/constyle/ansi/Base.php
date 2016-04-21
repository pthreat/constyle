<?php

	namespace stange\constyle\ansi{

		use \stange\constyle\ansi\Block;
		use \stange\constyle\ansi\Padding;
		use \stange\constyle\ansi\Color;

		abstract class Base{
			
			private	$padding			=	NULL;
			private	$display			=	NULL;
			private	$content			=	NULL;
			private	$length			=	NULL;
			private	$charMap			=	NULL;
			private	$block			=	NULL;
			private	$color			=	NULL;

			public function __construct($content=''){

				$this->setContent($content);
				
			}

			private function &__getColorInstance(){

				$this->color	=	$this->color === NULL ? new Color($this->content) : $this->color;

				return $this->color;

			}

			public function setForeground($color){

				$colorObj	=	$this->__getColorInstance();
				$colorObj->setForeground($color);
				return $this;

			}

			public function getForeground(){

				$color	=	$this->__getColorInstance();

				return $color->getForeground();

			}

			public function setBackground($color){

				$colorObj	=	$this->__getColorInstance();
				$colorObj->setBackground($color);
				return $this;

			}

			public function getBackground(){

				$color	=	$this->__getColorInstance();
				return $color->getBackground();

			}

			public function getColor(){

				$color	=	$this->__getColorInstance();
				return $color;

			}

			public function setContent($content){

				$this->content			=	$content;
				$this->contentLength	=	strlen($content);
				return $this;

			}

			public function getContent(){

				return $this->content;

			}

			public function setPadding(Padding $padding){

				$this->padding	=	$padding;
				return $this;

			}

			public function getPadding(){

				return $this->padding;

			}

			public function setDisplay($display){

				$display		=	strtolower(trim($display));

				$displays	=	Array(
											'inline','block','flex','inline-block','inline-flex',
											'inline-table','list-item','run-in','table','table-caption',
											'table-column-group','table-header-group','table-footer-group',
											'table-row-group','table-cell','table-column','table-row',
											'none','initial','inherit'
				);

				if(!in_array($display,$displays)){

					throw new \InvalidArgumentException("Invalid display property ->$display<-");

				}

				$this->display	=	$display;

				return $this->block	=	new Block($this->content);

			}

			public function getDisplay(){

				return $this->display;

			}

			abstract protected function __render();

			private function setContentLength($length){

				return $this->length	=	$length;
				
			}

			public function render(){

				if($this->padding){

					$this->padding->setContent($this->content);
					$render	=	$this->padding->render();
					$this->setContent($render);

				}

				$render	=	$this->__render();

				if($this->display	== 'block'){

					$this->block->setContentLength(strlen($this->content));
					$this->block->setContent($render);
					return $this->block->render();

				}

				return $this->__render();

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
