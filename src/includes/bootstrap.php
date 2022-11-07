<?php

declare(strict_types=1);
/**
 * Bootstrap
 *
 * Date: 11/5/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

use Landfill\Config\Config;
use Slim\Views\Twig;

$containerDefinitions = [
    Config::class => Di\Create(Config::class)
        ->constructor(PROJECT_ROOT . '/config/config.yaml'),
    Twig::class   => function (Config $config) {
        return Twig::create(PROJECT_ROOT . $config->get('paths.templates', '/'),
                            ['cache' => PROJECT_ROOT . '/tmp/cache/', 'debug' => true]);
    },

    ##### Aliases
    'config'      => DI\get(Config::class),
    'view'        => DI\get(Twig::class),
];


