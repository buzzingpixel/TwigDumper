# Twig Dumper

A Twig Dumper that uses the Symfony VarDumper component.

## Installation

`composer require --dev buzzingpixel/twig-dumper`

When instantiating your Twig instance, add `BuzzingPixel\TwigDumper\TwigDumper` extension to Twig via the `addExtension()` method. Like so:

```php
<?php
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use BuzzingPixel\TwigDumper\TwigDumper;

$twig = new Environment(new FilesystemLoader('/path/to/templates'), [
    'debug' => true,
    'cache' => '/path/to/cache',
    'strict_variables' => true,
]);

$twig->addExtension(new TwigDumper());
```

## Usage

Node that Twig must be in debug mode in order for this extension to work.

```twig
{# Dump variables or other values #}
{{ dump(myVar, anotherVar, 123, 'etc.') }}

{# Dump the twig context #}
{{ dump() }}
```

## License

Copyright 2019 BuzzingPixel, LLC

Licensed under the Apache License, Version 2.0 (the "License"); you may not use this file except in compliance with the License. You may obtain a copy of the License at http://www.apache.org/licenses/LICENSE-2.0.

Unless required by applicable law or agreed to in writing, software distributed under the License is distributed on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the License for the specific language governing permissions and limitations under the License.
