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
use Landfill\Config\Exception\InvalidTypeException;
use Landfill\Config\Loader;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml as YamlParser;

class Yaml extends Loader
{

    /**
     * @throws \Landfill\Config\Exception\InvalidFileException
     * @throws \Landfill\Config\Exception\InvalidTypeException
     */
    public function parseFile()
    : array
    {
        try {
            $parsed = YamlParser::parseFile($this->context, YamlParser::PARSE_EXCEPTION_ON_INVALID_TYPE);
        } catch (ParseException $e) {
            throw new InvalidFileException($e->getMessage());
        }

        if (!is_array($parsed)) {
            throw new InvalidTypeException('Unable to parse YAML file: ' . $this->context);
        }

        return $parsed;
    }
}