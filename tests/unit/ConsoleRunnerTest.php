<?php

namespace vova07\console;

use PHPUnit\Framework\TestCase;

final class ConsoleRunnerTest extends TestCase
{
    /**
     * Output file path.
     */
    const OUTPUT_FILE = __DIR__ . '/../output.txt';

    /**
     * Main entry file path.
     */
    const ENTRY_FILE = __DIR__ . '/../yii.php';

    /**
     * @var ConsoleRunner
     */
    private $runner;

    /**
     * {@inheritdoc}
     */
    protected function setUp()
    {
        parent::setUp();

        $this->runner = new ConsoleRunner(['file' => self::ENTRY_FILE]);
    }

    /**
     * {@inheritdoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->removeOutputFile();
    }

    /**
     * @test
     */
    public function shouldBeAbleToRunMigrations()
    {
        $expected = time();

        $this->runner->run(self::OUTPUT_FILE . ' ' . $expected);

        sleep(1);

        $output = (int) file_get_contents(self::OUTPUT_FILE);

        self::assertSame($expected, $output);
    }

    /**
     * Clear the content of output file.
     */
    private function removeOutputFile()
    {
        unlink(self::OUTPUT_FILE);
    }
}
