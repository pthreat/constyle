# ConStyle

Have you ever wanted CSS for your ANSI terminal?


Constyle is a library that uses sabberworm's CSS parser and adds corresponding CSS styles
to a piece of text. 

The idea is to support more features as required.

This project uses composer, so, to add this library to your project via composer simply add:

```
{
	"require": {
						"stange/constyle": "*",
	},
	"minimum-stability": "dev",
}
```

To use the library, simply:

use \stange\constyle\ansi\Style as ConsStyle;

```php
$css = '{color:#afcd31;text-decoration:underline;background-color:navy;font-weight:bold}';
$c   = new ConsStyle("CSS Example $css",$css);
echo $c->render()."\n";
```


