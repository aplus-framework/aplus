<?php
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests;

use Aplus;
use Framework\CLI\Streams\Stdout;
use PHPUnit\Framework\TestCase;

/**
 * Class AplusTest.
 */
final class AplusTest extends TestCase
{
    public function testAplus() : void
    {
        Stdout::init();
        self::assertSame('', Stdout::getContents());
        require __DIR__ . '/../src/aplus.php';
        self::assertNotSame('', Stdout::getContents());
        self::assertStringContainsString(Aplus::DESCRIPTION, Stdout::getContents());
    }
}
