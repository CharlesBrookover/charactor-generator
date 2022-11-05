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

namespace Landfill\Config\Loader;

use Landfill\Config\Exception\InvalidFileException;
use Landfill\Config\Loader;

class Php extends Loader
{
    public function parseFile()
    : array
    {
        $contents = include $this->context;

        if (gettype($contents) !== 'array') {
            throw new InvalidFileException($this->context . ' returned invalid array');
        }
        return $contents;
    }

}