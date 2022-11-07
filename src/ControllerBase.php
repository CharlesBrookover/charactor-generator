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

namespace Landfill;

use Landfill\Config\Config;
use Psr\Container\ContainerInterface;
use Slim\Views\Twig;

class ControllerBase
{
    protected Twig $view;
    protected Config $config;

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(protected ContainerInterface $container) {
        $this->view = $this->container->get('view');
        $this->config = $this->container->get('config');
    }

}