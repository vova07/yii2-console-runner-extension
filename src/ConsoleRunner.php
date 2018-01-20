<?php

namespace vova07\console;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

/**
 * ConsoleRunner - a component for running console commands in background.
 *
 * Usage:
 * ```
 * ...
 * $cr = new ConsoleRunner([
 *     'file' => '@my/path/to/yii',
 *     'phpBinaryPath' => '/my/path/to/php', // This is an optional param you may use to override the default `php` binary path.
 * ]);
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
 *         'file' => '@my/path/to/yii', // Or an absolute path to console file.
 *         'phpBinaryPath' => '/my/path/to/php', // This is an optional param you may use to override the default `php` binary path.
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
     * Usually it can be `yii` file.
     *
     * @var string Console application file that will be executed.
     */
    public $file;

    /**
     * @var string The PHP binary path.
     */
    public $phpBinaryPath = PHP_BINDIR . '/php';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->file === null) {
            throw new InvalidConfigException('The "file" property must be set.');
        } else {
            $this->file = Yii::getAlias($this->file);
        }
    }

    /**
     * Running console command on background.
     *
     * @param string $cmd Argument that will be passed to console application.
     *
     * @return boolean
     */
    public function run($cmd)
    {
        $cmd = "{$this->phpBinaryPath} {$this->file} $cmd";
        $cmd = $this->isWindows() === true
            ? $cmd = "start /b {$cmd}"
            : $cmd = "{$cmd} > /dev/null 2>&1 &";

        pclose(popen($cmd, 'r'));

        return true;
    }

    /**
     * Check operating system.
     *
     * @return boolean `true` if it's Windows OS.
     */
    protected function isWindows()
    {
        return PHP_OS == 'WINNT' || PHP_OS == 'WIN32';
    }
}
