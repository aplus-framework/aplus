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

/**
 * Class NewApp.
 *
 * @package aplus
 */
class NewApp extends NewCommand
{
    protected string $name = 'new-app';
    protected string $description = 'Creates a new App Project.';
    protected string $usage = 'new-app [options] [directory]';

    public function run() : void
    {
        $this->create('app', 'App Project');
    }
}
