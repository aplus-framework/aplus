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

use Aplus;
use Framework\CLI\CLI;

/**
 * Class Index.
 *
 * @package aplus
 */
class Index extends \Framework\CLI\Commands\Index
{
    protected array $options = [
        '-g' => 'Shows greeting.',
    ];

    public function run() : void
    {
        $this->showHeader();
        $this->showDate();
        $this->showInfo();
        $showGreet = $this->console->getOption('g');
        if ($showGreet) {
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

    protected function greet() : void
    {
        $hour = \date('H');
        $timing = 'evening';
        if ($hour > 4 && $hour < 12) {
            $timing = 'morning';
        } elseif ($hour > 4 && $hour < 18) {
            $timing = 'afternoon';
        }
        $greeting = 'Good ' . $timing . ', ' . $this->getUser() . '!';
        CLI::write($greeting);
        CLI::newLine();
    }

    protected function getUser() : string
    {
        $username = \posix_getlogin();
        if ($username === false) {
            return 'friend';
        }
        $info = \posix_getpwnam($username);
        if ( ! $info) {
            return $username;
        }
        $gecos = $info['gecos'] ?? '';
        if ( ! $gecos) {
            return $username;
        }
        $length = \strpos($gecos, ',') ?: \strlen($gecos);
        return \substr($gecos, 0, $length);
    }
}
