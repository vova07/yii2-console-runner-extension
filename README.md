# Console Runner

[![Latest Version](https://img.shields.io/github/tag/vova07/yii2-console-runner-extension.svg?style=flat-square&label=release)](https://github.com/vova07/yii2-console-runner-extension/releases)
[![Software License](https://img.shields.io/badge/license-BSD-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/vova07/yii2-console-runner-extension/master.svg?style=flat-square)](https://travis-ci.org/vova07/yii2-console-runner-extension)
[![Coverage Status](https://img.shields.io/scrutinizer/coverage/g/vova07/yii2-console-runner-extension.svg?style=flat-square)](https://scrutinizer-ci.com/g/vova07/yii2-console-runner-extension/code-structure)
[![Quality Score](https://img.shields.io/scrutinizer/g/vova07/yii2-console-runner-extension.svg?style=flat-square)](https://scrutinizer-ci.com/g/vova07/yii2-console-runner-extension)
[![Total Downloads](https://img.shields.io/packagist/dt/vova07/yii2-console-runner-extension.svg?style=flat-square)](https://packagist.org/packages/vova07/yii2-console-runner-extension)

An extension for running console commands on background in Yii framework.

## Installation

Add the following to `require` section of your `composer.json`:

```
"vova07/yii2-console-runner-extension": "*"
```

Then do `composer install`.

## Usage

##### Imported class:

```php
use vova07\console\ConsoleRunner;
$cr = new ConsoleRunner(['file' => '@my/path/to/yii']);
$cr->run('controller/action param1 param2 ...');
```

##### Application component:

```php
// config.php
...
components [
    'consoleRunner' => [
        'class' => 'vova07\console\ConsoleRunner',
        'file' => '@my/path/to/yii' // or an absolute path to console file
    ]
]
...

// some-file.php
Yii::$app->consoleRunner->run('controller/action param1 param2 ...');
```

### Running Tests
```bash
$ phpunit
```
