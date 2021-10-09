<?php
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Commands;

use Aplus\Commands\NewOne;
use Framework\CLI\Streams\Stdout;

/**
 * Class NewOneTest.
 */
final class NewOneTest extends TestCase
{
    protected string $command = NewOne::class;

    public function testNewApp() : void
    {
        $dir = \sys_get_temp_dir() . '/aplus-one';
        if (\is_dir($dir)) {
            \rmdir($dir);
        }
        Stdout::init();
        $this->console->exec('new-one ' . $dir);
        self::assertStringContainsString(
            'One Project structure created at "' . $dir . '"',
            Stdout::getContents()
        );
    }
}
