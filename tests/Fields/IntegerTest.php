<?php


class IntegerTest extends PHPUnit_Framework_TestCase
{

    public function testSetters()
    {
        $string_field = new \SummerOrm\Fields\Integer();

        $string_field->setValue(10);
        $this->assertTrue(is_int($string_field->getValue()));

        $string_field->setValue('101');
        $this->assertTrue(is_int($string_field->getValue()));


    }
}