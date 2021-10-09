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
 * Class NewOne.
 *
 * @package aplus
 */
class NewOne extends NewCommand
{
    protected string $name = 'new-one';
    protected string $description = 'Creates a new One Project.';
    protected string $usage = 'new-one [options] [directory]';

    public function run() : void
    {
        $this->create('one', 'One Project');
    }
}
