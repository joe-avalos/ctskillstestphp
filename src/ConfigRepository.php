<?php

namespace Coalition;

use ArrayObject;

class ConfigRepository extends ArrayObject
{
    public function __construct($config = [])
    {
       parent::__construct($config);
    }

    /**
     * Determine whether the config array contains the given key
     *
     * @param string $key
     * @return bool
     */
    public function has($key)
    {
        return array_key_exists($key, $this);
    }

    /**
     * Set a value on the config array
     *
     * @param string $key
     * @param mixed  $value
     * @return \Coalition\ConfigRepository
     */
    public function set($key, $value)
    {
        $this[$key] = $value;
        return $this;
    }

    /**
     * Get an item from the config array
     *
     * If the key does not exist the default
     * value should be returned
     *
     * @param string     $key
     * @param null|mixed $default
     * @return mixed
     */
    public function get($key, $default = null)
    {
        if ($this->has($key)) return $this[$key];
        return $default;
    }

    /**
     * Remove an item from the config array
     *
     * @param string $key
     * @return \Coalition\ConfigRepository
     */
    public function remove($key)
    {
        if ($this->has($key)) unset($this[$key]);
        return $this;
    }

    /**
     * Load config items from a file or an array of files
     *
     * The file name should be the config key and the value
     * should be the return value from the file
     *
     * @param array|string The full path to the files $files
     * @return void
     */
    public function load($files)
    {
        if (!is_array($files)) $files = [$files];
        foreach ($files as $file){
            $contents = include $file;
            $this->set(basename($file,'.php'),$contents);
        }
    }
}
