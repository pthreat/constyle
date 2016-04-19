<?php

	namespace stange\constyle{

		class Util{

			public static function getCharMap($name){
				
			}

			public static function substractOrientation($orientation){

				$test	=	strpos($orientation,'-');

				if($test===FALSE){

					return NULL;

				}

				return substr($orientation,$test+1);

			}

			public static function validateOrientation($orientation,$what){

				$orientation	=	strtolower($orientation);

				if(!self::isOrientation($orientation)){

					$msg	=	"Incorrect $what specified ->$orientation<-. $what must be one of: top, right, bottom, left";
					throw new \InvalidArgumentException($msg);

				}

				return $orientation;

			}

			public static function isOrientation($str){

				return in_array($str,Array('top','right','bottom','left'));

			}

		}

	}
