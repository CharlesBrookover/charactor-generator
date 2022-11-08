<?php

declare(strict_types=1);
/**
 * Routes for the application
 *
 * Date: 11/5/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */
/**
 * @var \Slim\App $app
 */

use Landfill\Controller\Main;

$app->get('/', Main::class . ':home');
$app->post('/signin', Main::class . ':signin')
    ->setName('signin');