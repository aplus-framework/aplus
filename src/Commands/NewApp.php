<?php declare(strict_types=1);
/*
 * This file is part of Aplus.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aplus\Commands;

use Framework\CLI\CLI;
use Framework\CLI\Command;

/**
 * Class NewApp.
 *
 * @package aplus
 */
class NewApp extends Command
{
    protected string $name = 'new-app';
    protected string $description = 'Creates a new App Project.';
    protected string $usage = 'new-app [options] [directory]';

    public function run() : void
    {
        $directory = $this->console->getArgument(0);
        if ($directory === null) {
            $directory = $this->promptDirectory();
        }
        if ( ! \str_starts_with($directory, '/')) {
            $directory = \getcwd() . '/' . $directory;
        }
        if (\file_exists($directory)) {
            CLI::error(
                \sprintf('The path "%s" already exists', $directory)
            );
        }
        if ( ! \mkdir($directory, 0755, true) && ! \is_dir($directory)) {
            CLI::error(
                \sprintf('Directory "%s" could not be created', $directory)
            );
        }
        $directory = \realpath($directory);
        if ($directory === false) {
            CLI::error(
                \sprintf('Was not possible get the realpath of "%s"', $directory)
            );
            return;
        }
        $source = __DIR__ . '/../../vendor/aplus/app';
        if (\is_dir(__DIR__ . '/../../../../aplus/app')) {
            $source = __DIR__ . '/../../../../aplus/app';
        }
        $source = \realpath($source);
        if ($source === false) {
            CLI::error('Directory aplus/app not found');
            return;
        }
        $source = \strtr($source, [' ' => '\ ']);
        $directory = \strtr($directory, [' ' => '\ ']);
        \shell_exec("cp -r {$source}/* {$directory}");
        CLI::write('App Project structure created at ' . $directory);
    }

    protected function promptDirectory() : string
    {
        $directory = CLI::prompt('Directory');
        $directory = \trim($directory);
        if ($directory === '') {
            CLI::write('Directory path cannot be empty. Try again.');
            return $this->promptDirectory();
        }
        return $directory;
    }
}
