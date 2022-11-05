<?php

declare(strict_types=1);
/**
 * A new PHP page
 *
 * Date: 11/5/2022
 *
 * @author  Charles Brookover
 * @license MIT
 * @version 0.0.1
 */

namespace Landfill\Config;

use Landfill\Config\Interfaces\LoaderInterface;

abstract class Loader implements LoaderInterface
{
    public function __construct(protected string $context) { }

    abstract public function parseFile(): array;

}