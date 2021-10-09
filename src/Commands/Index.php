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

use Aplus;
use Framework\CLI\CLI;

/**
 * Class Index.
 *
 * @package aplus
 */
class Index extends \Framework\CLI\Commands\Index
{
    public function run() : void
    {
        $this->showHeader();
        $this->showDate();
        $this->showInfo();
        if ($this->console->getOption('g')) {
            $this->greet();
        }
        $this->listCommands();
    }

    protected function showInfo() : void
    {
        $distro = \PHP_OS_FAMILY;
        if ($distro === 'Linux' && \is_file('/etc/lsb-release')) {
            $contents = \file_get_contents('/etc/lsb-release');
            if ($contents) {
                $lsb = (array) \parse_ini_string($contents);
                if (isset($lsb['DISTRIB_ID'], $lsb['DISTRIB_RELEASE'])) {
                    $distro = $lsb['DISTRIB_ID'] . ' ' . $lsb['DISTRIB_RELEASE'];
                }
            }
        }
        CLI::write(
            Aplus::DESCRIPTION
            . ' on ' . $distro
            . ' with PHP ' . \PHP_VERSION
        );
        CLI::newLine();
    }
}
