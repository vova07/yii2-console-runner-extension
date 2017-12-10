<?php

namespace vova07\console;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * ConsoleRunner - a component for running console commands on background.
 *
 * Usage:
 * ```
 * ...
 * $cr = new ConsoleRunner(['file' => '@my/path/to/yii']);
 * $cr->run('controller/action param1 param2 ...');
 * ...
 * ```
 * or use it like an application component:
 * ```
 * // config.php
 * ...
 * components [
 *     'consoleRunner' => [
 *         'class' => 'vova07\console\ConsoleRunner',
 *         'file' => '@my/path/to/yii' // or an absolute path to console file
 *     ]
 * ]
 * ...
 *
 * // some-file.php
 * Yii::$app->consoleRunner->run('controller/action param1 param2 ...');
 * ```
 */
class ConsoleRunner extends Component
{
    /**
     * @var string Console application file that will be executed.
     * Usually it can be `yii` file.
     */
    public $file;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->file === null) {
            throw new InvalidConfigException('The "file" property must be set.');
        }
    }

    /**
     * Running console command on background
     *
     * @param string $cmd Argument that will be passed to console application
     * @return boolean
     */
    public function run($cmd)
    {
        $cmd = PHP_BINARY . ' ' . Yii::getAlias($this->file) . ' ' . $cmd;
        if ($this->isWindows() === true) {
            pclose(popen('start /b ' . $cmd, 'r'));
        } else {
            pclose(popen($cmd . ' > /dev/null 2>&1 &', 'r'));
        }
        return true;
    }

    /**
     * Check operating system
     *
     * @return boolean true if it's Windows OS
     */
    protected function isWindows()
    {
        if (PHP_OS == 'WINNT' || PHP_OS == 'WIN32') {
            return true;
        } else {
            return false;
        }
    }
}
