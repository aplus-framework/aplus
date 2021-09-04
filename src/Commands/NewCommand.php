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
 * Class NewCommand.
 *
 * @package aplus
 */
abstract class NewCommand extends Command
{
    protected function create(string $package, string $name) : void
    {
        $directory = $this->getDirectory();
        $package = 'aplus/' . $package;
        $source = __DIR__ . '/../../../../' . $package;
        if ( ! \is_dir($source)) {
            $source = __DIR__ . '/../../vendor/' . $package;
        }
        $source = \realpath($source);
        if ($source === false) {
            CLI::error('Package ' . $package . ' not found');
            return;
        }
        $source = \strtr($source, [' ' => '\ ']);
        $dir = \strtr($directory, [' ' => '\ ']);
        \shell_exec("cp -r {$source}/* {$dir}");
        CLI::write(
            $name . ' structure created at "' . $directory . '"',
            CLI::FG_GREEN
        );
    }

    protected function getDirectory() : string
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
        $realpath = \realpath($directory);
        if ($realpath === false) {
            CLI::error(
                \sprintf('Was not possible get the realpath of "%s"', $directory)
            );
        }
        return $realpath; // @phpstan-ignore-line
    }

    protected function promptDirectory() : string
    {
        $directory = CLI::prompt('Directory');
        $directory = \trim($directory);
        if ($directory === '') {
            CLI::error('Directory path cannot be empty. Try again.', null);
            return $this->promptDirectory();
        }
        if ( ! \str_starts_with($directory, '/')) {
            $directory = \getcwd() . '/' . $directory;
        }
        if (\file_exists($directory)) {
            CLI::error('Directory already exists. Try Again.', null);
            return $this->promptDirectory();
        }
        return $directory;
    }
}
