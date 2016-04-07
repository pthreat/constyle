<?php

	namespace stange\consutil\ansi{

		class Colorize{

			private	$string		=	NULL;
			private	$foreground	=	NULL;
			private	$background	=	NULL;

			/**
			 * @var $colors Array Different colors for console output
			 */

			private $ansiColors = Array(
													'black'			=>	30,
													'blue'			=>	34,
													'brown'			=>	33,
													'green'			=>	32,
													'cyan'			=>	36,
													'red'				=>	31,
													'purple'			=>	35,
													'brown'			=>	33,
													'gray'			=>	30,
													'yellow'			=>	33,
													'white'			=>	37,
													'magenta'		=>	45
			);

			public function __construct($string,$foreground,$background=NULL){

				$this->setString($string);
				$this->setForeground($foreground);

				if($background !== NULL){

					$this->setBackground($background);

				}

			}

			public function setString($string){

				$this->string	=	sprintf('%s',$string);
				return $this;

			}

			public function getString(){

				return $this->string;

			}

			private function checkColor($color){

				if(array_key_exists($foreground,$this->colors)){

					return;

				}

				throw new \InvalidArgumentException("Invalid color \"$color\"");

			}

			public function setForeground($color){

				$this->checkColor($color);
				$this->foreground	=	$color;
				return $this;

			}

			public function getForeground(){

				return $this->foreground;

			}

			public function setBackground($color){

				$this->checkColor($color);
				$this->background	=	$color;
				return $this;

			}

			public function getBackground(){

				return $this->background;

			}

			public function clear(){

				return print("\033[2J\033[;H");

			}

			public function getColor($name){

				$name	=	trim($name);

				if(!in_array($name,array_keys(self::$ansiColors))){

					throw new \InvalidArgumentException("Unknown color \"$name\"");

				}

				return self::$ansiColors[$name];

			}

			public function render(){

				return sprintf('%s%s',$this->getColor($color),$string);

			}

		}	

	}

