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

use Framework\Autoload\Preloader;
use Framework\HTTP\Request;
use PHPUnit\Framework\TestCase;

/**
 * Class PreloadTest.
 */
final class PreloadTest extends TestCase
{
    public function testPreload() : void
    {
        self::assertFalse(\class_exists(Preloader::class, false));
        self::assertFalse(\class_exists(Request::class, false));
        require __DIR__ . '/../src/preload.php';
        self::assertTrue(\class_exists(Preloader::class, false));
        self::assertTrue(\class_exists(Request::class, false));
    }
}
