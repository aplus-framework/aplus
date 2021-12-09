<?php declare(strict_types=1);
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Aplus\Commands;

use Framework\CLI\CLI;
use Framework\CLI\Command;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

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
        $source = $this->getComposerSource($package);
        if ( ! $source) {
            $source = $this->getComposerSource($package, true);
            if ( ! $source) {
                $source = $this->getDistroSource($package);
            }
        }
        if ( ! $source) {
            CLI::error('Package aplus/' . $package . ' not found');
            return;
        }
        $this->copyDir($source, $directory);
        CLI::write(
            $name . ' structure created at "' . $directory . '"',
            CLI::FG_GREEN
        );
    }

    protected function getComposerSource(string $package, bool $global = false) : false | string
    {
        $source = $global
            ? __DIR__ . '/../../../../../'
            : __DIR__ . '/../../';
        $source .= 'vendor/aplus/' . $package;
        if (\is_dir($source)) {
            return \realpath($source);
        }
        return false;
    }

    protected function getDistroSource(string $package) : false | string
    {
        $source = __DIR__ . '/../../../../packages/' . $package;
        if (\is_dir($source)) {
            return \realpath($source);
        }
        return false;
    }

    protected function copyDir(string $source, string $directory) : void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::SELF_FIRST
        );
        foreach ($iterator as $item) {
            if ($item->isDir()) {
                $dir = $directory . \DIRECTORY_SEPARATOR . $iterator->getSubPathname();
                if ( ! \mkdir($dir, 0755, true) && ! \is_dir($dir)) {
                    CLI::error(
                        \sprintf('Directory "%s" could not be created', $dir)
                    );
                }
                continue;
            }
            \copy((string) $item, $directory . \DIRECTORY_SEPARATOR . $iterator->getSubPathname());
        }
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
