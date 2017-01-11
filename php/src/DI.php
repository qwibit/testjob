<?php

namespace src;

class DI
{
    /**
     * @var array 
     */
    private $container = [];

    /**
     * @param string $key
     * @param mixed $value
     * @return $this
     */
    public function set($key, $value)
    {
        $this->container[$key] = $value;

        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get($key)
    {
        return $this->container[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return isset($this->container[$key]);
    }
}
