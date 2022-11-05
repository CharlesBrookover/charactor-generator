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
use Landfill\Config\Loader\Php;
use PHPUnit\Framework\TestCase;

class PhpTest extends TestCase
{
    private string $phpFile = TEST_PATH . '/data/config/config.php';
    private string $badFile = TEST_PATH . '/data/config/badConfig.php';
    private string $missingFile = TEST_PATH . '/data/config/missing.php';

    public function testParseFile()
    {
        $parser = new Php($this->phpFile);

        $this->assertIsObject($parser);
        $this->assertInstanceOf(Php::class, $parser);

        $data = $parser->parseFile();
        $this->assertIsArray($data);
        $this->assertArrayHasKey('paths', $data);
        $this->assertArrayHasKey('databases', $data);
    }

    public function testException() {
        $this->expectException(InvalidFileException::class);
        $p = new Php($this->badFile);
        $p->parseFile();

    }
}
