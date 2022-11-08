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

namespace Landfill\Controller;

use Landfill\ControllerBase;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Main extends ControllerBase
{
    public function home(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    : ResponseInterface {
        return $this->view->render($response, 'main/home.twig');
    }

}