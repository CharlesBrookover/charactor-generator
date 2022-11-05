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

use SplFileInfo;

class Config implements \ArrayAccess
{

    protected array $config = [];

    public function __construct(mixed $context = null, string $prefix = null) {
        switch (gettype($context)) {
            case 'NULL':
            break;
            case 'array':
                $this->config = $prefix ? [$prefix => $context] : $context;
            break;
            case 'string':
                $this->load($context, $prefix);
                break;
            default:
                throw new \InvalidArgumentException('Invalid context for configuration');
        }
    }

    public function load(string $path, string $prefix = null, bool $override = true): Config {
        $file = new SplFileInfo($path);

        $className = ucfirst(strtolower($file->getExtension()));
        $classPath = __NAMESPACE__ . '\\Loader\\' . $className;

        /** @var \Landfill\Config\Interfaces\LoaderInterface $loader */
        $loader = new $classPath($file->getRealPath());

        $newConfig = $loader->parseFile();
        if ($prefix) {
            $newConfig = [$prefix => $newConfig];
        }

        if ($override) {
            $this->config = array_replace_recursive($this->config, $newConfig);
        } else {
            $this->config = array_replace_recursive($newConfig, $this->config);
        }

        return $this;
    }

    public function get(string $key, mixed $default = null): mixed  {
        return  $this->traverseArray($key) ?? $default;
    }

    public function set(string $key, mixed $value): bool {
        $config = &$this->config;

        foreach (explode('.', $key) as $k) {
            $config = &$config[$k];
        }

        $config = $value;

        return true;
    }

    public function has(string $key): bool {
        $config = $this->traverseArray($key);
        return isset($config);
    }

    public function unset(string $key): bool {
        if (!$this->has($key)) {
            return false;
        }

        return $this->set($key, null);
    }

    public function offsetExists(mixed $offset)
    : bool {
        return isset($this->config[$offset]);
    }

    public function offsetGet(mixed $offset)
    : mixed {
        return $this->config[$offset];
    }

    public function offsetSet(mixed $offset, mixed $value)
    : void {
        $this->config[$offset] = $value;
    }

    public function offsetUnset(mixed $offset)
    : void {
        unset($this->config[$offset]);
    }

    protected function traverseArray(string $key): mixed {
        $config = $this->config;

        foreach (explode('.', $key) as $k) {
            if (! isset($config[$k])) {
                return null;
            }
            $config = $config[$k];
        }

        return $config;
    }

}