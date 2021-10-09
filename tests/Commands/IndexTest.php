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

use Aplus;
use Framework\CLI\Streams\Stdout;

/**
 * Class IndexTest.
 */
final class IndexTest extends TestCase
{
    protected string $command = Aplus\Commands\Index::class;

    public function testIndex() : void
    {
        Stdout::init();
        $this->console->exec('index');
        self::assertStringContainsString(Aplus::DESCRIPTION, Stdout::getContents());
    }
}
