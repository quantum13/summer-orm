<?php

namespace SummerOrm\Fields;

abstract class Base
{
    protected $val = null;

    public function __construct($params = [])
    {
        if (isset($params['default'])) {
            $this->setValue($params['default']);
        }
    }

    public abstract function setValue($val);

    public abstract function getValue();
}