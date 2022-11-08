<?php

declare(strict_types=1);

/**
 * A new PHP page
 *
 * Date: 11/4/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;
use Slim\Views\TwigMiddleware;

defined('PROJECT_ROOT') or define('PROJECT_ROOT', realpath(dirname(__FILE__) . '/../'));

// Composer Autoload
require_once PROJECT_ROOT . '/vendor/autoload.php';
// Bootstrap
require_once PROJECT_ROOT . '/src/includes/bootstrap.php';

// Dependency Injection
$builder = new ContainerBuilder();
/** @var array $containerDefinitions */
$builder->addDefinitions($containerDefinitions);

// Slim App
$app = Bridge::create($builder->build());

// Middleware
$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->add(TwigMiddleware::createFromContainer($app));
$app->addErrorMiddleware(true, true, true);

// Routes
require_once PROJECT_ROOT . '/src/includes/routes.php';

// Run it all
$app->run();