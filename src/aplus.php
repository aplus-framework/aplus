#!/usr/bin/env php
<?php
require __DIR__ . '/../vendor/autoload.php';

use Aplus\Commands\Index;
use Framework\CLI\Console;

$console = new Console();
$console->addCommand(Index::class);
$console->run();
