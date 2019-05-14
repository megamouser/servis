<?php
namespace Core\Engine\Components;

class Main
{
    protected $dependencies = [];

    public function bind($key, $value)
    {
        $this->dependencies[$key] = $value;
    }

    public function get($key)
    {
        if(!array_key_exists($key, $this->dependencies))
        {
            throw new Exception("No $key is bound in the container");
        }

        return $this->dependencies['key'];
    }
}