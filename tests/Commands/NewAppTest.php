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

use Aplus\Commands\NewApp;
use Framework\CLI\Streams\Stdout;

/**
 * Class NewAppTest.
 */
final class NewAppTest extends TestCase
{
    protected string $command = NewApp::class;

    public function testNewApp() : void
    {
        $dir = \sys_get_temp_dir() . '/aplus-app';
        if (\is_dir($dir)) {
            \rmdir($dir);
        }
        Stdout::init();
        $this->console->exec('new-app ' . $dir);
        self::assertStringContainsString(
            'App Project structure created at "' . $dir . '"',
            Stdout::getContents()
        );
    }
}
