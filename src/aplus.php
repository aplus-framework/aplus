#!/usr/bin/env php
<?php
if (is_file(__DIR__ . '/../../../autoload.php')) {
    require __DIR__ . '/../../../autoload.php';
} else {
    require __DIR__ . '/../vendor/autoload.php';
}

use Aplus\Commands\Index;
use Aplus\Commands\NewApp;
use Framework\CLI\Console;

$console = new Console();
$console->addCommand(Index::class);
$console->addCommand(NewApp::class);
$console->run();
