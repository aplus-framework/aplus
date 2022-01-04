#!/usr/bin/env php
<?php
if (is_file(__DIR__ . '/../../../autoload.php')) {
    require __DIR__ . '/../../../autoload.php';
} elseif (is_file(__DIR__ . '/../../../autoload.php')) {
    require __DIR__ . '/../vendor/autoload.php';
} else {
    die ("Unable to find autoloader");
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
