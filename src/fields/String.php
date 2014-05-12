<?php

namespace SummerOrm\Fields;

use SummerOrm\Config;

class String extends Base
{
    private $max_length = 20;

    public function __construct($params = [])
    {
        parent::__construct($params);
        if (isset($params['max_length'])) {
            $this->max_length = (int)$params['max_length'];
        }
    }

    public function setValue($val)
    {
        $this->val = mb_substr($val, 0, $this->max_length, Config::getCharset());
    }

    public function getValue()
    {
        return $this->val;
    }
}