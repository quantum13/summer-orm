<?php

namespace SummerOrm;

use PHPUnit_Framework_TestCase;
use SummerOrm\Fields\String;

class StringTest extends PHPUnit_Framework_TestCase
{

    public function testSetters()
    {
        $string_field = new String(['max_length' => 10]);

        $string_field->setValue('sdsd');
        $this->assertTrue(is_string($string_field->getValue()));
        $this->assertEquals($string_field->getValue(), 'sdsd');

        $string_field->setValue('10');
        $this->assertTrue(is_string($string_field->getValue()));

        $string_field->setValue('123456789012345');
        $this->assertEquals($string_field->getValue(), '1234567890');

    }
}