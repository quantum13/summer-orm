<?php

namespace SummerOrm\Fields;

class Integer extends Base
{
    public function setValue($val)
    {
        $this->val = (int)$val;
    }

    public function getValue()
    {
        return $this->val;
    }
}