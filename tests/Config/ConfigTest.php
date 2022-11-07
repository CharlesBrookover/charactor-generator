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

namespace Landfill\Tests\Config;

use InvalidArgumentException;
use Landfill\Config\Config;
use PHPUnit\Framework\TestCase;
use stdClass;

class ConfigTest extends TestCase
{
    private Config $config;
    private string $yamlFile    = TEST_PATH . '/data/config/config.yaml';
    private array  $arrayConfig = [
        'array'  => [
            'path'  => '/path',
            'asset' => '/asset',
        ],
        'images' => [
            'main'   => 'main.png',
            'button' => 'button.png',
        ],
    ];

    public static function setUpBeforeClass()
    : void
    {
        parent::setUpBeforeClass(); // TODO: Change the autogenerated stub


    }

    protected function setUp()
    : void
    {
        parent::setUp();

        $this->config = new Config($this->arrayConfig);
    }

    public function testConstruct()
    {
        $yamlConfig = new Config($this->yamlFile);
        $this->assertIsObject($yamlConfig);
        $this->assertInstanceOf(Config::class, $yamlConfig);

        $arrayConfig = new Config($this->arrayConfig);
        $this->assertIsObject($arrayConfig);
        $this->assertInstanceOf(Config::class, $arrayConfig);

        $nullConfig = new Config();
        $this->assertIsObject($nullConfig);
        $this->assertInstanceOf(Config::class, $nullConfig);

        $this->expectException(InvalidArgumentException::class);
        $c = new Config(new stdClass());
    }

    public function testLoad()
    {
        $nullConfig = new Config();
        $config     = $nullConfig->load($this->yamlFile);
        $this->assertIsObject($config);
        $this->assertInstanceOf(Config::class, $config);

        $config = $nullConfig->load($this->yamlFile, 'prefix');
        $this->assertIsObject($config);
        $this->assertInstanceOf(Config::class, $config);

        $config = $nullConfig->load($this->yamlFile, null, false);
        $this->assertIsObject($config);
        $this->assertInstanceOf(Config::class, $config);
    }

    public function testHas()
    {
        $this->assertTrue($this->config->has('array'));
        $this->assertTrue($this->config->has('images.button'));

        $this->assertFalse($this->config->has('rainclouds'));
    }

    public function testGet()
    {
        $this->assertIsArray($this->config->get('array'));
        $this->assertSame($this->config->get('array.path'), $this->arrayConfig['array']['path']);

        $this->assertNull($this->config->get('rainclouds'));
        $this->assertSame($this->config->get('rainclouds', 'dark'), 'dark');
    }

    public function testSet()
    {
        $this->assertTrue($this->config->set('array.path', '/path/1'));
        $this->assertSame($this->config->get('array.path'), '/path/1');

        $this->assertTrue($this->config->set('new', 'value'));
        $this->assertTrue($this->config->has('new'));
        $this->assertSAme($this->config->get('new'), 'value');
    }

    public function testUnset()
    {
        $this->assertTrue($this->config->unset('images.main'));
        $this->assertFalse($this->config->has('images.main'));
    }

    public function testOffsetGet()
    {
        $this->assertIsArray($this->config->offsetGet('array'));
    }

    public function testOffsetSet()
    {
        $this->config->offsetSet('new', 'value');
        $this->assertTrue($this->config->has('new'));
        $this->assertSame($this->config->offsetGet('new'), 'value');
    }

    public function testOffsetUnset()
    {
        $this->config->offsetUnset('array');
        $this->assertFalse($this->config->has('array'));
    }


    public function testOffsetExists()
    {
        $this->assertTrue($this->config->offsetExists('array'));
    }


}
