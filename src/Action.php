<?php

namespace Kirillbdev\LaraRepository;


class Action
{
    private $_name;
    private $_params;
    private $_priority;

    public function __construct($name, $params, $priority)
    {
        $this->_name = $name;
        $this->_params = $params;
        $this->_priority = $priority;
    }

    public function getName()
    {
        return $this->_name;
    }

    public function getParams()
    {
        return $this->_params;
    }

    public function getPriority()
    {
        return $this->_priority;
    }
}