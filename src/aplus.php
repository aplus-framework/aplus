#!/usr/bin/env php
<?php
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (is_file(__DIR__ . '/../../../autoload.php')) {
    require __DIR__ . '/../../../autoload.php';
} else {
    require __DIR__ . '/../vendor/autoload.php';
}

use Aplus\Commands\Index;
use Aplus\Commands\NewApp;
use Aplus\Commands\NewOne;
use Framework\CLI\Console;

$console = new Console();
$console->addCommand(Index::class);
$console->addCommand(NewApp::class);
$console->addCommand(NewOne::class);
$console->run();
