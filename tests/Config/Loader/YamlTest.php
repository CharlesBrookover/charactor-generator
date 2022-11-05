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

namespace Landfill\Tests\Config\Loader;

use Landfill\Config\Exception\InvalidFileException;
use Landfill\Config\Exception\InvalidTypeException;
use Landfill\Config\Loader\Yaml;
use PHPUnit\Framework\TestCase;

class YamlTest extends TestCase
{

    private string $yamlFile = TEST_PATH . '/data/config/config.yaml';
    private string $badYamlFile = TEST_PATH . '/data/config/badYaml.yaml';

    public function testParseFile()
    {
        $parser = new Yaml($this->yamlFile);

        $this->assertIsObject($parser);
        $this->assertInstanceOf(Yaml::class, $parser);

        $data = $parser->parseFile();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('paths', $data);
        $this->assertArrayHasKey('databases', $data);
    }

    public function testExceptions() {
        $this->expectException(InvalidFileException::class);
        $p = new Yaml($this->badYamlFile);
        $p->parseFile();

    }
}
