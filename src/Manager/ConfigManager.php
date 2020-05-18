<?php

namespace TestTask\Manager;

use TestTask\Exception\FileNotFoundException;
use TestTask\Exception\InvalidConfigException;

/**
 * Class ConfigManager
 * @package TestTask\Manager
 */
class ConfigManager
{
    const CONFIG_FILE = 'config/config.yml';

    protected $config;

    public function __construct()
    {
        if (!file_exists(self::CONFIG_FILE)) {
            throw new FileNotFoundException('Unable to find' . self::CONFIG_FILE . ' file!');
        }

        $this->config = yaml_parse_file(self::CONFIG_FILE);
    }

    /**
     * @return array
     */
    public function getDatabaseConfig(): array
    {
        if (!$this->isDatabaseConfigValid()) {
            throw new InvalidConfigException('Invalid database config');
        }

        return $this->config['database'];
    }

    /**
     * @return mixed
     */
    public function getRedisConfig()
    {
        if (!$this->isRedisConfigValid()) {
            throw new InvalidConfigException('Invalid redis config');
        }

        return $this->config['redis'];
    }

    /**
     * @return bool
     */
    protected function isDatabaseConfigValid()
    {
        return
            array_key_exists('database', $this->config) &&
            array_key_exists('host', $this->config['database']) &&
            array_key_exists('port', $this->config['database']) &&
            array_key_exists('dbname', $this->config['database']) &&
            array_key_exists('user', $this->config['database']) &&
            array_key_exists('password', $this->config['database']);
    }

    /**
     * @return bool
     */
    protected function isRedisConfigValid()
    {
        return
            array_key_exists('redis', $this->config) &&
            array_key_exists('host', $this->config['redis']) &&
            array_key_exists('port', $this->config['redis']) &&
            array_key_exists('scheme', $this->config['redis']);
    }
}