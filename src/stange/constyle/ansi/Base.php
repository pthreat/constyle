<?php

	namespace stange\constyle\ansi{

		use \stange\constyle\ansi\Padding;
		use \stange\constyle\ansi\Border;
		use \stange\constyle\ansi\Margin;

		abstract class Base{
			
			private	$padding	=	NULL;
			private	$display	=	NULL;
			private	$border	=	NULL;
			private	$margin	=	NULL;
			private	$content	=	NULL;
			private	$charMap	=	NULL;

			private	$height	=	NULL;
			private	$width	=	NULL;

			final public function __construct($content=''){

				$this->setContent($content);

			}

			public function setContent($content){

				$this->content	=	$content;
				return $this;

			}

			public function getContent(){

				return $this->content;

			}

			public function setBorder(Border $border){

				$this->border	=	$border;
				return $this;

			}

			public function getBorder(){

				return $this->border;

			}

			public function setPadding(Padding $padding){

				$this->padding	=	$padding;
				return $this;

			}

			public function getPadding(){

				return $this->padding;

			}

			public function setMargin(Margin $margin){

				$this->margin	=	$margin;
				return $this;

			}

			public function getMargin(){

				return $this->margin;

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

				return $this;

			}

			public function getDisplay(){

				return $this->display;

			}

			abstract protected function __render();

			public function render(){

				$render	=	$this->__render();

				if($this->padding){

					$this->padding->setContent($render);
					$render	=	$this->padding->render();

				}

				if($this->display=='block'){

					$box	=	new Box($render);

					if($this->margin){

						$box->setMargin($this->margin);

					}

					if($this->border){

						$box->setBorder($this->border);

					}

					if($this->height){

						$box->setHeight($this->height);

					}

					if($this->width){

						$box->setWidth($this->width);

					}

					return $box->render();

				}

				return $render;

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
