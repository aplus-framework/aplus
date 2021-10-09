<?php
/*
 * This file is part of Aplus Command Line Tool.
 *
 * (c) Natan Felles <natanfelles@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
if (is_file(__DIR__ . '/../../autoload/src/Preloader.php')) {
    require __DIR__ . '/../../autoload/src/Preloader.php';
} else {
    require __DIR__ . '/../vendor/aplus/autoload/src/Preloader.php';
}

use Framework\Autoload\Preloader;

(new Preloader())->load();
