<?php declare(strict_types=1);
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Tests\Commands;

use Framework\CLI\Console;

/**
 * Class TestCase.
 */
abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Console $console;
    /**
     * @var class-string<\Framework\CLI\Command>
     */
    protected string $command;

    protected function setUp() : void
    {
        $this->console = new Console();
        $this->console->addCommand($this->command);
    }
}
